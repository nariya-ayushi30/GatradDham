@extends('admin.layouts.master')

@php
    $isGu = app()->getLocale() === 'gu';
@endphp

@section('title', $isGu ? 'સંપર્ક સંદેશાઓ & પૂછપરછ | શ્રી ગાત્રાળ ધામ એડમિન' : 'Devotee Inquiries | Shree Gatrad Dham Admin')

@section('content')

    <div class="space-y-6">
        
        <!-- Header -->
        <div class="bg-white border-2 border-orange-200 rounded-3xl p-6 shadow-md flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-black text-orange-700 uppercase tracking-widest bg-yellow-200 px-3.5 py-1 rounded-full border border-yellow-400">
                    {{ $isGu ? 'યાત્રી હેલ્પડેસ્ક' : 'DEVOTEE HELPDESK' }}
                </span>
                <h1 class="text-2xl font-black text-slate-900 mt-2">
                    {{ $isGu ? 'સંપર્ક સંદેશાઓ & પૂછપરછ' : 'Devotee Inquiries & Messages' }}
                </h1>
                <p class="text-xs text-slate-600 mt-1">
                    {{ $isGu ? 'વેબસાઇટ સંપર્ક ફોર્મ દ્વારા ભક્તો અને યાત્રાળુઓ દ્વારા મોકલેલ તમામ પૂછપરછ સંદેશાઓ.' : 'All devotee contact inquiries and questions received through website contact forms.' }}
                </p>
            </div>

            <div class="px-4 py-2 rounded-2xl bg-orange-50 border border-orange-200 text-xs font-bold text-orange-800 shrink-0">
                {{ $isGu ? 'કુલ સંદેશાઓ: ' : 'Total Inquiries: ' }}<strong class="text-orange-600">{{ $inquiries->total() }}</strong>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border-2 border-emerald-300 text-xs font-bold text-emerald-800 flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Inquiries Table -->
        <div class="bg-white border-2 border-orange-200 rounded-3xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-orange-50 to-amber-50/50 border-b-2 border-orange-200 text-orange-950 font-black">
                            <th class="py-4 px-5">{{ $isGu ? 'તારીખ & સમય' : 'Date & Time' }}</th>
                            <th class="py-4 px-5">{{ $isGu ? 'યાત્રાળુ / ભક્તનું નામ' : 'Devotee Name' }}</th>
                            <th class="py-4 px-5">{{ $isGu ? 'મોબાઈલ નંબર' : 'Mobile Number' }}</th>
                            <th class="py-4 px-5">{{ $isGu ? 'વિષય' : 'Subject' }}</th>
                            <th class="py-4 px-5">{{ $isGu ? 'સંદેશ / પ્રશ્ન' : 'Message' }}</th>
                            <th class="py-4 px-5 text-right">{{ $isGu ? 'સંપર્ક & એક્શન' : 'Action' }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        @forelse($inquiries as $msg)
                            <tr class="hover:bg-orange-50/40 transition">
                                <td class="py-4 px-5 text-slate-500 whitespace-nowrap">
                                    <div class="font-bold text-slate-800">{{ $msg->created_at->format('d M, Y') }}</div>
                                    <div class="text-[10px] text-slate-400">{{ $msg->created_at->format('h:i A') }}</div>
                                </td>
                                <td class="py-4 px-5">
                                    <div class="font-bold text-slate-900 text-sm flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-xs">
                                            {{ strtoupper(substr($msg->name, 0, 1)) }}
                                        </div>
                                        <span>{{ $msg->name }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-5">
                                    <a href="tel:{{ $msg->phone }}" class="font-mono font-bold text-orange-600 hover:underline">
                                        {{ $msg->phone }}
                                    </a>
                                </td>
                                <td class="py-4 px-5 font-bold text-slate-800">
                                    {{ $msg->subject ?: ($isGu ? 'સામાન્ય પૂછપરછ' : 'General Inquiry') }}
                                </td>
                                <td class="py-4 px-5 max-w-xs text-slate-600 leading-relaxed">
                                    <p class="line-clamp-2">{{ $msg->message }}</p>
                                </td>
                                <td class="py-4 px-5 text-right">
                                    <div class="inline-flex items-center gap-1.5">
                                        <!-- WhatsApp reply button -->
                                        @php
                                            $cleanPhone = preg_replace('/[^0-9]/', '', $msg->phone);
                                            if (strlen($cleanPhone) === 10) {
                                                $cleanPhone = '91' . $cleanPhone;
                                            }
                                        @endphp
                                        <a href="https://api.whatsapp.com/send?phone={{ $cleanPhone }}&text={{ urlencode(($isGu ? 'જય શ્રી ગાત્રાળ માં ' : 'Jai Shree Gatrad Maa ') . $msg->name . ($isGu ? ', આપની ગાત્રાળ ધામ ખાતેની પૂછપરછ સંદર્ભે:' : ', regarding your inquiry at Gatrad Dham:')) }}" 
                                           target="_blank" 
                                           title="{{ $isGu ? 'WhatsApp પર જવાબ આપો' : 'Reply on WhatsApp' }}"
                                           class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white transition inline-flex items-center justify-center border border-emerald-200">
                                            <i class="fa-brands fa-whatsapp text-sm"></i>
                                        </a>

                                        <!-- Delete button -->
                                        <form action="{{ route('admin.contacts.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('{{ $isGu ? 'શું તમે આ સંદેશ ખરેખર ડિલીટ કરવા માંગો છો?' : 'Are you sure you want to delete this message?' }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-8 h-8 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition inline-flex items-center justify-center border border-red-200" title="{{ $isGu ? 'ડિલીટ' : 'Delete' }}">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400 font-bold">
                                    {{ $isGu ? 'હાલમાં કોઈ પૂછપરછ સંદેશાઓ નથી.' : 'No devotee inquiries received yet.' }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $inquiries->links() }}
            </div>
        </div>

    </div>

@endsection