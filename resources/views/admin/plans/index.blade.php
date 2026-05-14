@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-bold">باقات الإنترنت</h2>
        <a href="{{ route('admin.plans.create') }}" class="glass-button bg-brand-purple/20 text-brand-purple hover:bg-brand-purple/30 px-4 py-2.5 rounded-xl text-sm font-medium">إضافة باقة جديدة</a>
    </div>

    @if(session('success'))
        <div class="bg-green-500/20 text-green-400 px-4 py-3 rounded-xl border border-green-500/20 text-sm">{{ session('success') }}</div>
    @endif

    <div class="glass-panel rounded-2xl p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-right text-sm">
                <thead>
                    <tr class="text-white/50 border-b border-white/10">
                        <th class="pb-3 px-4 font-medium">اسم الباقة</th>
                        <th class="pb-3 px-4 font-medium">السعر</th>
                        <th class="pb-3 px-4 font-medium">السعة (GB)</th>
                        <th class="pb-3 px-4 font-medium">المدة (دقائق)</th>
                        <th class="pb-3 px-4 font-medium">السرعة</th>
                        <th class="pb-3 px-4 font-medium">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($plans as $plan)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="py-4 px-4 font-medium text-lg">{{ $plan->title }}</td>
                        <td class="py-4 px-4 font-bold text-brand-cyan text-lg">{{ $plan->price }}</td>
                        <td class="py-4 px-4 text-white/70">{{ $plan->data_limit ?? 'مفتوح' }}</td>
                        <td class="py-4 px-4 text-white/70">{{ $plan->time_limit ?? 'مفتوح' }}</td>
                        <td class="py-4 px-4 text-white/70 font-mono" dir="ltr">{{ $plan->speed_limit ?? 'Unlimited' }}</td>
                        <td class="py-4 px-4">
                            <div class="flex gap-3 items-center">
                                <a href="{{ route('admin.plans.edit', $plan) }}" class="text-brand-purple hover:underline">تعديل</a>
                                <form action="{{ route('admin.plans.destroy', $plan) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من مسح الباقة؟')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:underline">حذف</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-white/40">لا توجد باقات مضافة حتى الآن.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
