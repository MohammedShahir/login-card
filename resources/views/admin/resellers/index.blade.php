@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-bold">نقاط البيع والمتاجر</h2>
        <a href="{{ route('admin.resellers.create') }}" class="glass-button bg-brand-cyan/20 text-brand-cyan hover:bg-brand-cyan/30 px-4 py-2.5 rounded-xl text-sm font-medium">إضافة متجر جديد</a>
    </div>

    @if(session('success'))
        <div class="bg-green-500/20 text-green-400 px-4 py-3 rounded-xl border border-green-500/20 text-sm">{{ session('success') }}</div>
    @endif

    <div class="glass-panel rounded-2xl p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-right text-sm">
                <thead>
                    <tr class="text-white/50 border-b border-white/10">
                        <th class="pb-3 px-4 font-medium">الشعار</th>
                        <th class="pb-3 px-4 font-medium">اسم المتجر</th>
                        <th class="pb-3 px-4 font-medium">العنوان</th>
                        <th class="pb-3 px-4 font-medium">الحالة</th>
                        <th class="pb-3 px-4 font-medium">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($resellers as $reseller)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="py-3 px-4">
                            @if($reseller->logo_path)
                                <img src="{{ Storage::url($reseller->logo_path) }}" class="w-10 h-10 rounded-lg object-cover bg-white/5">
                            @else
                                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center text-white/30 text-xs">بدون</div>
                            @endif
                        </td>
                        <td class="py-3 px-4 font-medium">{{ $reseller->name }}</td>
                        <td class="py-3 px-4 text-white/60">{{ $reseller->address ?: '-' }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2.5 py-1 text-xs rounded-md {{ $reseller->is_active ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' }}">
                                {{ $reseller->is_active ? 'نشط' : 'غير نشط' }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex gap-3 items-center">
                                <a href="{{ route('admin.resellers.edit', $reseller) }}" class="text-brand-cyan hover:underline">تعديل</a>
                                <form action="{{ route('admin.resellers.destroy', $reseller) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف بشكل نهائي؟')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:underline">حذف</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-white/40">لا توجد نقاط بيع مضافة حتى الآن.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
