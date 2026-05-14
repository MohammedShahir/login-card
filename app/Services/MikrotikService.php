<?php

namespace App\Services;

use App\Models\MikrotikConfig;
use App\Models\AuthLog;
use Illuminate\Support\Facades\Log;
use Exception;

class MikrotikService
{
    protected $connection;
    protected $timeout = 5;

    /**
     * Connect to MikroTik via Socket
     */
    public function connect(MikrotikConfig $config): bool
    {
        $port = $config->api_port ?? 8728;
        
        try {
            $this->connection = @stream_socket_client(
                "tcp://{$config->host_ip}:{$port}",
                $errNo,
                $errStr,
                $this->timeout
            );

            if (!$this->connection) {
                Log::error("MikroTik Connection Failed: {$errStr} ({$errNo})");
                return false;
            }

            stream_set_timeout($this->connection, $this->timeout);

            // Handshake & Login
            return $this->login($config->api_username, $config->api_password);
        } catch (Exception $e) {
            Log::error("MikroTik Connection Exception: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Authenticate Voucher Code (Card Number)
     */
    public function authenticateUser(string $cardNumber, string $macAddress, string $ipAddress): bool
    {
        if (!$this->connection) {
            Log::error("MikroTik: No active connection to authenticate user.");
            return false;
        }

        try {
            // Send command to check if user exists in hotspot users
            $this->write('/ip/hotspot/user/print');
            $this->write("?name={$cardNumber}");
            $this->write('');
            
            $users = $this->read();

            if (empty($users) || !isset($users[0]['name'])) {
                $this->logAuth($macAddress, $ipAddress, $cardNumber, 'Fail');
                return false;
            }

            // Note: In a real-world scenario, you might want to bind the MAC/IP here,
            // or return the CHAP/PAP credentials for the frontend redirect.

            $this->logAuth($macAddress, $ipAddress, $cardNumber, 'Success');
            return true;
        } catch (Exception $e) {
            Log::error("MikroTik Auth Exception: " . $e->getMessage());
            $this->logAuth($macAddress, $ipAddress, $cardNumber, 'Fail');
            return false;
        }
    }

    /**
     * Disconnect from MikroTik
     */
    public function disconnect(): void
    {
        if ($this->connection) {
            fclose($this->connection);
            $this->connection = null;
        }
    }

    /**
     * Write command to MikroTik socket
     */
    protected function write(string $command): void
    {
        $length = strlen($command);
        if ($length < 0x80) {
            fwrite($this->connection, chr($length));
        } elseif ($length < 0x4000) {
            fwrite($this->connection, chr($length >> 8 | 0x80) . chr($length & 0xFF));
        }
        fwrite($this->connection, $command);
    }

    /**
     * Read response from MikroTik socket
     */
    protected function read(): array
    {
        $result = [];
        $current = [];
        
        while (true) {
            $char = fread($this->connection, 1);
            if ($char === false || strlen($char) === 0) break;
            
            $byte = ord($char);
            $length = 0;
            
            if ($byte < 0x80) {
                $length = $byte;
            } elseif ($byte < 0xC0) {
                $length = (($byte & 0x3F) << 8) | ord(fread($this->connection, 1));
            }
            
            if ($length === 0) {
                if (!empty($current)) $result[] = $current;
                break;
            }

            $word = fread($this->connection, $length);
            
            if ($word === '!done') {
                if (!empty($current)) $result[] = $current;
                break;
            } elseif ($word === '!re' || $word === '!trap') {
                if (!empty($current)) {
                    $result[] = $current;
                    $current = [];
                }
            } else {
                if (strpos($word, '=') === 0) {
                    $parts = explode('=', substr($word, 1), 2);
                    if (count($parts) == 2) {
                        $current[$parts[0]] = $parts[1];
                    }
                }
            }
        }
        
        return $result;
    }

    /**
     * Execute API Login Handshake
     */
    protected function login(string $username, string $password): bool
    {
        $this->write('/login');
        $this->write('');
        $response = $this->read();

        if (isset($response[0]['ret'])) {
            $challenge = pack('H*', $response[0]['ret']);
            $md5 = md5(chr(0) . $password . $challenge);
            
            $this->write('/login');
            $this->write('=name=' . $username);
            $this->write('=response=00' . $md5);
            $this->write('');
            
            $response = $this->read();

            if (isset($response[0]['!trap'])) {
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     * Log the authentication attempt to DB
     */
    protected function logAuth(string $macAddress, string $ipAddress, string $cardNumber, string $status): void
    {
        AuthLog::create([
            'mac_address' => $macAddress,
            'ip_address' => $ipAddress,
            'card_number' => $cardNumber,
            'status' => $status,
            'timestamp' => now(),
        ]);
    }
}
