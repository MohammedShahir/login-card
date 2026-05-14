@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-bold">إدارة المشرفين</h2>
        <a href="{{ route('admin.users.create') }}" class="glass-button bg-brand-cyan/20 text-brand-cyan hover:bg-brand-cyan/30 px-4 py-2.5 rounded-xl text-sm font-medium">إضافة مشرف جديد</a>
    </div>

    @if(session('success'))
        <div class="bg-green-500/20 text-green-400 px-4 py-3 rounded-xl border border-green-500/20 text-sm">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="bg-red-500/20 text-red-200 px-4 py-3 rounded-xl border border-red-500/20 text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <div class="glass-panel rounded-2xl p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-right text-sm">
                <thead>
                    <tr class="text-white/50 border-b border-white/10">
                        <th class="pb-3 px-4 font-medium">الاسم</th>
                        <th class="pb-3 px-4 font-medium">البريد الإلكتروني</th>
                        <th class="pb-3 px-4 font-medium">تاريخ الإضافة</th>
                        <th class="pb-3 px-4 font-medium">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($users as $user)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="py-4 px-4 font-medium text-base flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-brand-cyan/10 flex items-center justify-center text-brand-cyan font-bold">
                                {{ mb_substr($user->name, 0, 1) }}
                            </div>
                            {{ $user->name }}
                            @if(auth()->id() === $user->id)
                                <span class="text-[10px] bg-brand-pink/20 text-brand-pink px-2 py-0.5 rounded-full mr-2">أنت</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-white/80 font-mono" dir="ltr">{{ $user->email }}</td>
                        <td class="py-4 px-4 text-white/60">{{ $user->created_at->format('Y-m-d') }}</td>
                        <td class="py-4 px-4">
                            <div class="flex gap-3 items-center">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-brand-cyan hover:underline">تعديل</a>
                                @if(auth()->id() !== $user->id)
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المشرف؟')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:underline">حذف</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-white/40">لا يوجد مشرفين.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
