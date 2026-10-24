@extends('admin.layouts.master')

@php
    $isGu = app()->getLocale() === 'gu';
@endphp

@section('title', $isGu ? 'રૂમ બુકિંગ વિનંતીઓ | શ્રી ગાત્રાળ ધામ એડમિન' : 'Room Booking Requests | Shree Gatrad Dham Admin')

@section('content')

<div x-data="{
    editModal: false,
    editForm: {
        id: '',
        booking_code: '',
        guest_name: '',
        phone: '',
        city: '',
        room_type: '',
        rooms_count: 1,
        guests_count: 1,
        check_in: '',
        status: '',
        notes: ''
    },
    openEdit(item) {
        let checkInDate = '';
        if (item.check_in) {
            checkInDate = item.check_in.split('T')[0];
        }
        this.editForm = {
            id: item.id,
            booking_code: item.booking_code || '',
            guest_name: item.guest_name || '',
            phone: item.phone || '',
            city: item.city || '',
            room_type: item.room_type || 'Standard AC Room',
            rooms_count: item.rooms_count || 1,
            guests_count: item.guests_count || 1,
            check_in: checkInDate,
            status: item.status || 'Pending',
            notes: item.notes || ''
        };
        this.editModal = true;
    }
}">

    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-hotel text-orange-600"></i>
                <span>{{ $isGu ? 'યાત્રિક ભવન & ધર્મશાળા રૂમ બુકિંગ વિનંતીઓ' : 'Dharamshala Room Booking Requests' }}</span>
            </h1>
            <p class="text-xs text-slate-500 mt-1 font-semibold">
                {{ $isGu ? 'ભાવિકો દ્વારા કરવામાં આવેલ ઓનલાઇન રૂમ અને હોલ બુકિંગ પૂછપરછનું સંચાલન.' : 'Manage online devotee room and hall booking requests and confirmations.' }}
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs font-bold flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-base"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Bookings Table Card -->
    <div class="bg-white border-2 border-orange-200 rounded-3xl p-6 shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-orange-50 text-orange-950 uppercase font-black text-[10px] border-b-2 border-orange-200">
                    <tr>
                        <th class="p-3">{{ $isGu ? 'બુકિંગ ID' : 'Booking ID' }}</th>
                        <th class="p-3">{{ $isGu ? 'યાત્રિકનું નામ' : 'Guest Name' }}</th>
                        <th class="p-3">{{ $isGu ? 'મોબાઈલ' : 'Mobile' }}</th>
                        <th class="p-3">{{ $isGu ? 'ગામ / શહેર' : 'City / Village' }}</th>
                        <th class="p-3">{{ $isGu ? 'રૂમનો પ્રકાર' : 'Room Type' }}</th>
                        <th class="p-3">{{ $isGu ? 'સભ્યો' : 'Guests' }}</th>
                        <th class="p-3">{{ $isGu ? 'તારીખ' : 'Check-In' }}</th>
                        <th class="p-3 text-center">{{ $isGu ? 'સ્થિતિ' : 'Status' }}</th>
                        <th class="p-3 text-center">{{ $isGu ? 'એક્શન' : 'Action' }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($bookings as $item)
                        <tr class="hover:bg-orange-50/50 transition">
                            <td class="p-3 font-mono font-bold text-orange-600">{{ $item->booking_code }}</td>
                            <td class="p-3 font-bold text-slate-900">{{ $item->guest_name }}</td>
                            <td class="p-3 text-slate-600 font-mono">{{ $item->phone }}</td>
                            <td class="p-3 text-slate-700">{{ $item->city }}</td>
                            <td class="p-3 text-orange-700 font-bold">{{ $item->room_type }}</td>
                            <td class="p-3 text-slate-700 font-semibold">{{ $item->guests_count }} {{ $isGu ? 'સભ્યો' : 'Guests' }}</td>
                            <td class="p-3 text-slate-500">{{ $item->check_in ? $item->check_in->format('d/m/Y') : '' }}</td>
                            <td class="p-3 text-center">
                                @if($item->status == 'Approved')
                                    <span class="px-2.5 py-1 rounded-full text-[10px] bg-emerald-100 text-emerald-800 font-black border border-emerald-300">
                                        {{ $isGu ? 'મંજૂર' : 'Approved' }}
                                    </span>
                                @elseif($item->status == 'Pending')
                                    <span class="px-2.5 py-1 rounded-full text-[10px] bg-yellow-100 text-yellow-900 font-black border border-yellow-300">
                                        {{ $isGu ? 'પેન્ડિંગ' : 'Pending' }}
                                    </span>
                                @elseif($item->status == 'Cancelled')
                                    <span class="px-2.5 py-1 rounded-full text-[10px] bg-red-100 text-red-800 font-black border border-red-300">
                                        {{ $isGu ? 'રદ' : 'Cancelled' }}
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[10px] bg-slate-100 text-slate-700 font-black border border-slate-300">
                                        {{ $isGu ? 'સંપૂર્ણ' : 'Done' }}
                                    </span>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <!-- Edit Button with Icon (Icon Only) -->
                                    <button type="button" @click="openEdit({{ json_encode($item) }})" class="w-7 h-7 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-300 flex items-center justify-center text-xs transition shadow-sm" title="{{ $isGu ? 'એડિટ' : 'Edit' }}">
                                        <i class="fa-solid fa-pen-to-square text-amber-600"></i>
                                    </button>

                                    @if($item->status !== 'Approved')
                                        <form action="{{ route('admin.bookings.status', $item->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="Approved">
                                            <button type="submit" class="px-2.5 py-1 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition text-[10px] font-black shadow-sm">
                                                {{ $isGu ? 'અપ્રૂવ' : 'Approve' }}
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.bookings.destroy', $item->id) }}" method="POST" onsubmit="return confirm('{{ $isGu ? 'શું તમે આ બુકિંગ રેકોર્ડ ડિલીટ કરવા માંગો છો?' : 'Are you sure you want to delete this booking record?' }}')">
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
                            <td colspan="9" class="p-6 text-center text-slate-400 font-bold">
                                {{ $isGu ? 'હજી સુધી કોઈ બુકિંગ વિનંતી નથી.' : 'No room booking requests found yet.' }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $bookings->links() }}
        </div>
    </div>

    <!-- ==================== EDIT BOOKING MODAL ==================== -->
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
                    {{ $isGu ? 'બુકિંગ એડિટ કરો' : 'EDIT BOOKING' }}
                </span>
                <h2 class="text-xl font-black text-slate-900 mt-2">
                    {{ $isGu ? 'રૂમ બુકિંગ વિગતો સુધારો' : 'Edit Booking Details' }}
                </h2>
                <p class="text-xs text-slate-500 font-mono mt-0.5" x-text="'{{ $isGu ? 'બુકિંગ ID: ' : 'Booking ID: ' }}' + editForm.booking_code"></p>
            </div>

            <form :action="'{{ url('admin/bookings') }}/' + editForm.id" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Guest Name & Phone -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            {{ $isGu ? 'યાત્રિકનું નામ*' : 'Guest Name*' }}
                        </label>
                        <input type="text" name="guest_name" x-model="editForm.guest_name" required
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            {{ $isGu ? 'મોબાઈલ નંબર*' : 'Mobile Number*' }}
                        </label>
                        <input type="text" name="phone" x-model="editForm.phone" required
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                    </div>
                </div>

                <!-- City & Room Type -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            {{ $isGu ? 'ગામ / શહેર' : 'City / Village' }}
                        </label>
                        <input type="text" name="city" x-model="editForm.city"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            {{ $isGu ? 'રૂમનો પ્રકાર' : 'Room Type' }}
                        </label>
                        <select name="room_type" x-model="editForm.room_type"
                                class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                            <option value="Standard AC Room">Standard AC Room (એસી રૂમ)</option>
                            <option value="Non-AC Deluxe Room">Non-AC Deluxe Room (નોન-એસી)</option>
                            <option value="Family Suite Room">Family Suite (ફેમિલી સુઈટ)</option>
                            <option value="Dormitory Bed">Dormitory Bed (ડોરમીટરી)</option>
                        </select>
                    </div>
                </div>

                <!-- Rooms Count, Guests Count, Check-in -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            {{ $isGu ? 'રૂમની સંખ્યા' : 'Rooms Count' }}
                        </label>
                        <input type="number" min="1" name="rooms_count" x-model="editForm.rooms_count"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            {{ $isGu ? 'કુલ સભ્યો' : 'Guests Count' }}
                        </label>
                        <input type="number" min="1" name="guests_count" x-model="editForm.guests_count"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            {{ $isGu ? 'ચેક-ઇન તારીખ' : 'Check-in Date' }}
                        </label>
                        <input type="date" name="check_in" x-model="editForm.check_in"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                    </div>
                </div>

                <!-- Status & Notes -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            {{ $isGu ? 'બુકિંગ સ્થિતિ / Status*' : 'Booking Status*' }}
                        </label>
                        <select name="status" x-model="editForm.status" required
                                class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                            <option value="Pending">{{ $isGu ? 'પેન્ડિંગ (Pending)' : 'Pending' }}</option>
                            <option value="Approved">{{ $isGu ? 'મંજૂર (Approved)' : 'Approved' }}</option>
                            <option value="Completed">{{ $isGu ? 'સંપૂર્ણ (Completed)' : 'Completed' }}</option>
                            <option value="Cancelled">{{ $isGu ? 'રદ (Cancelled)' : 'Cancelled' }}</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            {{ $isGu ? 'નોંધ / રીમાર્ક' : 'Notes / Remarks' }}
                        </label>
                        <input type="text" name="notes" x-model="editForm.notes" placeholder="{{ $isGu ? 'વિશેષ નોંધ...' : 'Any special note...' }}"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
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
