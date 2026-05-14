# 🚀 MikroTik Pro Captive Portal Ecosystem

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.4+-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)
[![Docker](https://img.shields.io/badge/Docker-Enabled-2496ED?style=for-the-badge&logo=docker)](https://www.docker.com)
[![PWA](https://img.shields.io/badge/PWA-Ready-5A0FC8?style=for-the-badge&logo=pwa)](https://web.dev/progressive-web-apps/)

A high-performance, ultra-modern External Captive Portal designed specifically for MikroTik Hotspots. This ecosystem focuses on providing a premium user experience with a **Glassmorphism Dark Theme**, efficient management of internet plans, and a retailer directory for offline users.

---

## ✨ Key Features

### 🎨 Stunning UI/UX (Glassmorphism)
- **Ambient Design:** Smooth animated backgrounds with glass panels and backdrop blur effects.
- **Mobile-First:** Tailored specifically for mobile users on the street or in cafes.
- **Micro-Animations:** Interactive buttons, loading states, and smooth transitions using Alpine.js.

### 🌐 Advanced Connectivity
- **Native Socket API:** Lightweight communication with MikroTik RouterOS via PHP streams for maximum speed.
- **Secure Auth:** Middleware-protected authentication flow ensuring users only access the login page through valid hotspot redirects.
- **Dynamic Redirection:** Automatic handling of MikroTik login parameters (MAC, IP, Link-Login).

### 🛠️ Professional Admin Dashboard
- **Live Statistics:** Real-time overview of active resellers, available plans, and successful authentication logs.
- **CRUD Management:** Full control over your retailers (Resellers) and Internet Plans.
- **MikroTik Config:** Easy-to-use interface to update your RouterOS API credentials and connection settings.

### 📱 PWA & Offline Support
- **Offline Mode:** Users can see the list of nearby resellers and internet prices even without an internet connection.
- **Installable:** Add the portal to the home screen for a native app feel.
- **Service Worker:** Efficient caching for assets and critical pages.

---

## 🛠️ Technology Stack

| Layer | Technology |
| :--- | :--- |
| **Backend** | Laravel 13 (PHP 8.3+) |
| **Database** | MySQL 8.0 |
| **Frontend** | Tailwind CSS 4.0 & Alpine.js |
| **PWA** | Service Workers & Web App Manifest |
| **Integration** | MikroTik RouterOS API (Socket Based) |
| **Environment** | Docker (Nginx, PHP-FPM, MySQL, phpMyAdmin) |

---

## 🔒 Security
- Protected admin routes with Laravel Auth.
- Securely hashed API passwords.
- Middleware-based validation for all hotspot requests to prevent unauthorized access.

---

<p align="center">
  Developed with ❤️ for high-performance MikroTik Hotspot Networks.
</p>
