@extends('admin.layouts.master')

@php
    $isGu = app()->getLocale() === 'gu';
@endphp

@section('title', $isGu ? 'દાન રેકોર્ડ્સ | શ્રી ગાત્રાળ ધામ એડમિન' : 'Donation Records | Shree Gatrad Dham Admin')

@section('content')

<div x-data="{
    editModal: false,
    editForm: {
        id: '',
        receipt_no: '',
        donor_name: '',
        phone: '',
        pan: '',
        amount: '',
        cause: '',
        payment_mode: '',
        status: ''
    },
    openEdit(item) {
        this.editForm = {
            id: item.id,
            receipt_no: item.receipt_no || '',
            donor_name: item.donor_name || '',
            phone: item.phone || '',
            pan: item.pan || '',
            amount: item.amount || '',
            cause: item.cause || '',
            payment_mode: item.payment_mode || 'Online',
            status: item.status || 'Completed'
        };
        this.editModal = true;
    }
}">

    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-hand-holding-dollar text-orange-600"></i>
                <span>{{ $isGu ? 'ઓનલાઇન & ઓફલાઇન ઈ-દાન રેકોર્ડ્સ' : 'Online & Offline E-Donation Records' }}</span>
            </h1>
            <p class="text-xs text-slate-500 mt-1 font-semibold">
                {{ $isGu ? 'મંદિર ટ્રસ્ટ ખાતે જમા થયેલ તમામ દાન અને 80G રસીદોની વિગત.' : 'Detailed transaction receipts and devotee donation entries for temple trust.' }}
            </p>
        </div>

        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="px-4 py-2 rounded-2xl bg-white hover:bg-orange-50 text-slate-700 border-2 border-orange-200 text-xs font-black flex items-center gap-2 transition shadow-sm">
                <i class="fa-solid fa-print text-orange-600"></i>
                <span>{{ $isGu ? 'પ્રિન્ટ / PDF' : 'Print / PDF' }}</span>
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs font-bold flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-base"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Donations Table Card -->
    <div class="bg-white border-2 border-orange-200 rounded-3xl p-6 shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-orange-50 text-orange-950 uppercase font-black text-[10px] border-b-2 border-orange-200">
                    <tr>
                        <th class="p-3">{{ $isGu ? 'રસીદ નંબર' : 'Receipt No' }}</th>
                        <th class="p-3">{{ $isGu ? 'દાતાશ્રીનું નામ' : 'Donor Name' }}</th>
                        <th class="p-3">{{ $isGu ? 'મોબાઈલ' : 'Mobile' }}</th>
                        <th class="p-3">PAN</th>
                        <th class="p-3">{{ $isGu ? 'સેવા હેતુ' : 'Purpose / Cause' }}</th>
                        <th class="p-3">{{ $isGu ? 'પેમેન્ટ મોડ' : 'Payment Mode' }}</th>
                        <th class="p-3">{{ $isGu ? 'તારીખ' : 'Date' }}</th>
                        <th class="p-3 text-right">{{ $isGu ? 'રકમ (₹)' : 'Amount (₹)' }}</th>
                        <th class="p-3 text-center">{{ $isGu ? 'સ્થિતિ' : 'Status' }}</th>
                        <th class="p-3 text-center">{{ $isGu ? 'એક્શન' : 'Action' }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($donations as $row)
                        <tr class="hover:bg-orange-50/50 transition">
                            <td class="p-3 font-mono font-bold text-orange-600">{{ $row->receipt_no }}</td>
                            <td class="p-3 font-bold text-slate-900">{{ $row->donor_name }}</td>
                            <td class="p-3 text-slate-600 font-mono">{{ $row->phone }}</td>
                            <td class="p-3 text-slate-500 font-mono">{{ $row->pan ?: '-' }}</td>
                            <td class="p-3 text-slate-800 font-semibold">{{ $row->cause }}</td>
                            <td class="p-3 text-slate-600">
                                <span class="bg-orange-50 border border-orange-200 px-2 py-0.5 rounded-lg text-[10px] font-bold text-orange-800">{{ $row->payment_mode }}</span>
                            </td>
                            <td class="p-3 text-slate-500">{{ $row->created_at ? $row->created_at->format('d/m/Y') : '-' }}</td>
                            <td class="p-3 text-right font-black text-emerald-700 text-sm">₹ {{ number_format($row->amount) }}</td>
                            <td class="p-3 text-center">
                                <span class="px-2.5 py-1 rounded-full text-[10px] bg-emerald-100 text-emerald-800 font-black border border-emerald-300">
                                    {{ $row->status }}
                                </span>
                            </td>
                            <td class="p-3 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button" @click="openEdit({{ json_encode($row) }})" class="w-7 h-7 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-300 flex items-center justify-center text-xs transition shadow-sm" title="{{ $isGu ? 'એડિટ' : 'Edit' }}">
                                        <i class="fa-solid fa-pen-to-square text-amber-600"></i>
                                    </button>
                                    <form action="{{ route('admin.donations.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ $isGu ? 'શું તમે ખરેખર આ દાન રેકોર્ડ ડિલીટ કરવા માંગો છો?' : 'Are you sure you want to delete this donation record?' }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-7 h-7 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 flex items-center justify-center text-xs transition shadow-sm" title="{{ $isGu ? 'ડિલીટ' : 'Delete' }}">
                                            <i class="fa-solid fa-trash-can text-rose-500"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="p-6 text-center text-slate-400 font-bold">
                                {{ $isGu ? 'હજી સુધી કોઈ દાન નોંધાયું નથી.' : 'No donation records found yet.' }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $donations->links() }}
        </div>
    </div>

    <!-- ==================== EDIT DONATION MODAL ==================== -->
    <div x-show="editModal" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto"
         style="display: none;">
        
        <div class="bg-white border-2 border-orange-300 rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl relative my-8" @click.away="editModal = false">
            <button type="button" @click="editModal = false" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700 text-xl">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="mb-5">
                <span class="text-xs font-black text-amber-800 uppercase bg-amber-100 px-3 py-1 rounded-full border border-amber-300">
                    <i class="fa-solid fa-pen-to-square text-amber-600 mr-1"></i>
                    {{ $isGu ? 'દાન એડિટ કરો' : 'EDIT DONATION' }}
                </span>
                <h2 class="text-xl font-black text-slate-900 mt-2">
                    {{ $isGu ? 'દાન રેકોર્ડ વિગતો સુધારો' : 'Edit Donation Details' }}
                </h2>
                <p class="text-xs text-slate-500 font-mono mt-0.5" x-text="'{{ $isGu ? 'રસીદ નં: ' : 'Receipt No: ' }}' + editForm.receipt_no"></p>
            </div>

            <form :action="'{{ url('admin/donations') }}/' + editForm.id" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Donor Name -->
                <div>
                    <label class="block text-xs font-bold text-slate-800 mb-1">
                        {{ $isGu ? 'દાતાશ્રીનું નામ*' : 'Donor Name*' }}
                    </label>
                    <input type="text" name="donor_name" x-model="editForm.donor_name" required
                           class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                </div>

                <!-- Phone & PAN -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            {{ $isGu ? 'મોબાઈલ નંબર' : 'Mobile Number' }}
                        </label>
                        <input type="text" name="phone" x-model="editForm.phone"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            {{ $isGu ? 'PAN નંબર' : 'PAN Number' }}
                        </label>
                        <input type="text" name="pan" x-model="editForm.pan"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm uppercase">
                    </div>
                </div>

                <!-- Amount & Cause -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            {{ $isGu ? 'રકમ (₹)*' : 'Amount (₹)*' }}
                        </label>
                        <input type="number" step="0.01" name="amount" x-model="editForm.amount" required
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-bold focus:outline-none focus:border-orange-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            {{ $isGu ? 'સેવા હેતુ / Purpose' : 'Purpose / Cause' }}
                        </label>
                        <input type="text" name="cause" x-model="editForm.cause"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                    </div>
                </div>

                <!-- Payment Mode & Status -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            {{ $isGu ? 'પેમેન્ટ મોડ' : 'Payment Mode' }}
                        </label>
                        <select name="payment_mode" x-model="editForm.payment_mode"
                                class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                            <option value="Online">Online (UPI / Gateway)</option>
                            <option value="Cash">Cash (રોકડ)</option>
                            <option value="Cheque">Cheque (ચેક)</option>
                            <option value="Bank Transfer">Bank Transfer (NEFT/RTGS)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            {{ $isGu ? 'સ્થિતિ / Status' : 'Status' }}
                        </label>
                        <select name="status" x-model="editForm.status"
                                class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                            <option value="Completed">{{ $isGu ? 'સંપૂર્ણ (Completed)' : 'Completed' }}</option>
                            <option value="Pending">{{ $isGu ? 'પેન્ડિંગ (Pending)' : 'Pending' }}</option>
                            <option value="Failed">{{ $isGu ? 'નિષ્ફળ (Failed)' : 'Failed' }}</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" @click="editModal = false" class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 text-xs font-bold hover:bg-slate-50 transition">
                        {{ $isGu ? 'રદ કરો' : 'Cancel' }}
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-bold text-xs shadow-md transition flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>{{ $isGu ? 'ફેરફાર સાચવો' : 'Save Changes' }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
