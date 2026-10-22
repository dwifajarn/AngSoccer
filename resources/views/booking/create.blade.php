@extends('layouts.user')

@section('title', 'Booking ' . $field->name . ' - AngSoccer')

@section('main')
    <div class="flex flex-col lg:grid lg:grid-cols-12 gap-8">
        <!-- Left Column: Booking Form -->
        <div class="lg:col-span-8 space-y-6">
            <!-- Field Preview Header -->
            <section class="bg-[#131914] border border-white/10 rounded-2xl overflow-hidden shadow-xl">
                <div class="h-64 sm:h-72 relative group overflow-hidden">
                    <img alt="{{ $field->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $field->image_url }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#131914] via-black/50 to-black/20"></div>
                    <div class="absolute bottom-5 left-5 right-5 text-white">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="px-3 py-1 bg-emerald-500 text-black text-xs font-black uppercase tracking-wider rounded-lg shadow-md">
                                {{ $field->type }}
                            </span>
                            <span class="px-2.5 py-0.5 bg-black/60 backdrop-blur-md text-emerald-400 text-xs font-bold rounded-lg border border-emerald-500/30">
                                {{ $field->surface }}
                            </span>
                            <span class="flex items-center gap-1 text-xs text-amber-400 font-bold ml-auto bg-black/60 px-2.5 py-1 rounded-lg backdrop-blur-md border border-white/10">
                                <span class="material-symbols-outlined text-[16px] text-amber-400" style="font-variation-settings: 'FILL' 1;">star</span>
                                {{ number_format($field->rating, 1) }}
                            </span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight font-headline">{{ $field->name }}</h1>
                        <p class="text-xs text-gray-300 flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-[16px] text-emerald-400">location_on</span>
                            {{ $field->location }}
                        </p>
                    </div>
                </div>
                @if($field->facilities)
                    <div class="px-5 py-3 bg-black/30 border-t border-white/10 flex flex-wrap gap-2 items-center text-xs text-gray-400">
                        <span class="font-bold flex items-center gap-1 text-emerald-400">
                            <span class="material-symbols-outlined text-[16px]">sports_soccer</span> Fasilitas:
                        </span>
                        <span>{{ $field->facilities }}</span>
                    </div>
                @endif
            </section>

            <!-- Form Card -->
            <form action="{{ route('booking.store') }}" method="POST" id="bookingForm" class="bg-[#131914] border border-white/10 rounded-2xl p-6 sm:p-8 shadow-xl space-y-6">
                @csrf
                <input type="hidden" name="lapangan_id" value="{{ $field->id }}">

                <!-- Date Picker -->
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-wider font-headline">
                            <span class="material-symbols-outlined text-emerald-400 text-[20px]">calendar_today</span>
                            Pilih Tanggal Booking
                        </h3>
                        <span class="text-[11px] text-emerald-400 font-semibold bg-emerald-500/10 px-2.5 py-0.5 rounded-full border border-emerald-500/20">Jadwal Real-time</span>
                    </div>
                    <div class="relative">
                        <input type="date" name="date" id="bookingDate" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" class="w-full px-4 py-3 bg-black/40 border border-white/10 rounded-xl text-xs text-white focus:outline-none focus:border-emerald-500 font-semibold cursor-pointer shadow-sm transition-all" required>
                    </div>
                </div>

                <!-- Time Slots Grid Section -->
                <div class="space-y-3">
                    <!-- Section Title & Visual Legend -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <h3 class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-wider font-headline">
                            <span class="material-symbols-outlined text-emerald-400 text-[20px]">schedule</span>
                            Pilih Waktu Mulai
                        </h3>
                        
                        <!-- Visual Legend -->
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1.5 p-2 px-3 bg-black/40 rounded-xl border border-white/10 text-[11px]">
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                <span class="text-gray-300 font-medium">Tersedia</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>
                                <span class="text-gray-300 font-medium">Terisi</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-gray-600"></span>
                                <span class="text-gray-300 font-medium">Lewat</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 ring-2 ring-emerald-300"></span>
                                <span class="text-gray-300 font-medium">Terpilih</span>
                            </div>
                        </div>
                    </div>

                    <!-- Modern Interactive Grid -->
                    <div class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-2 sm:gap-2.5" id="timeSlotsContainer">
                        @foreach(['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00'] as $timeSlot)
                            @php
                                $hour = intval($timeSlot);
                                $endHour = $hour + 1;
                                $endSlotStr = sprintf('%02d:00', $endHour);
                            @endphp
                            <label class="time-slot-card relative flex flex-col items-center justify-between p-2 rounded-xl border text-center transition-all duration-200 select-none group border-emerald-500/20 bg-emerald-500/5 hover:border-emerald-500/60 hover:shadow-sm cursor-pointer" data-slot="{{ $timeSlot }}" data-hour="{{ $hour }}">
                                <input type="radio" name="time" value="{{ $timeSlot }}" class="sr-only" required>
                                
                                <div class="w-full text-center">
                                    <span class="slot-time block font-bold text-xs sm:text-sm text-gray-200 leading-tight">{{ $timeSlot }}</span>
                                    <span class="slot-range block text-[9px] text-gray-400 mt-0.5 leading-tight font-medium">{{ $timeSlot }} - {{ $endSlotStr }}</span>
                                </div>
                                
                                <span class="slot-badge mt-1.5 sm:mt-2 inline-flex items-center px-1.5 py-0.5 rounded-full text-[9px] font-semibold tracking-wide transition-colors bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                    Tersedia
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Duration Selection -->
                <div class="space-y-2">
                    <h3 class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-wider font-headline">
                        <span class="material-symbols-outlined text-emerald-400 text-[20px]">history</span>
                        Durasi Pemesanan
                    </h3>
                    <select name="duration" id="bookingDuration" class="w-full px-4 py-3 bg-black/40 border border-white/10 rounded-xl text-xs text-white focus:outline-none focus:border-emerald-500 font-semibold cursor-pointer shadow-sm transition-all" required>
                        <option value="1">1 Jam</option>
                        <option value="2">2 Jam</option>
                        <option value="3">3 Jam</option>
                        <option value="4">4 Jam</option>
                    </select>

                    <!-- Overlap Warning Message -->
                    <div id="overlapWarning" class="hidden p-4 bg-red-500/10 border border-red-500/30 text-red-400 rounded-xl text-xs font-medium flex items-start gap-3 mt-2 shadow-sm transition-all">
                        <span class="material-symbols-outlined text-red-400 text-[20px] shrink-0 mt-0.5">warning</span>
                        <div class="flex-1">
                            <h4 class="font-bold text-red-300 text-xs" id="overlapWarningTitle">Waktu Tidak Tersedia</h4>
                            <p class="text-[11px] text-red-400/90 mt-0.5" id="overlapWarningText">
                                Durasi pemesanan melebihi batas slot kosong (bertabrakan dengan pesanan lain). Silakan kurangi durasi atau pilih waktu lain.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="space-y-2">
                    <h3 class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-wider font-headline">
                        <span class="material-symbols-outlined text-emerald-400 text-[20px]">edit_note</span>
                        Catatan Tambahan (Opsional)
                    </h3>
                    <textarea name="notes" class="w-full bg-black/40 border border-white/10 rounded-xl p-3.5 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-emerald-500 outline-none transition-all" placeholder="Contoh: Butuh wasit tambahan, sewa rompi tim, atau kebutuhan khusus lainnya..." rows="3"></textarea>
                </div>
            </form>
        </div>

        <!-- Right Column: Sticky Summary Card -->
        <div class="lg:col-span-4">
            <div class="sticky top-24 space-y-6">
                <div class="bg-[#131914] border border-white/10 rounded-2xl p-6 shadow-xl flex flex-col gap-5">
                    <div class="border-b border-white/10 pb-3 flex justify-between items-center">
                        <h2 class="text-base font-bold text-white font-headline">Ringkasan Pesanan</h2>
                        <span class="px-2.5 py-0.5 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-full text-xs font-bold">{{ $field->type }}</span>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-start">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Lapangan</span>
                                <span class="text-sm font-bold text-white">{{ $field->name }}</span>
                                <span class="text-xs text-emerald-400">{{ $field->surface }}</span>
                            </div>
                            <span class="material-symbols-outlined text-emerald-400 text-2xl">stadium</span>
                        </div>

                        <div class="flex justify-between items-center py-2.5 border-y border-white/10">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px] text-gray-400">calendar_month</span>
                                <span class="text-xs font-semibold text-gray-200" id="summaryDate">-</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px] text-gray-400">schedule</span>
                                <span class="text-xs font-semibold text-gray-200" id="summaryTime">-</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px] text-gray-400">history</span>
                                <span class="text-xs font-bold text-emerald-400" id="summaryDuration">1 Jam</span>
                            </div>
                        </div>
                    </div>

                    <!-- Price Box -->
                    <div class="bg-black/40 rounded-xl p-4 border border-white/10 space-y-1.5">
                        <div class="flex justify-between items-center text-xs text-gray-400">
                            <span>Tarif per jam</span>
                            <span>Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-2.5 border-t border-white/10">
                            <span class="text-xs font-bold text-gray-300 uppercase tracking-wider">Total Bayar</span>
                            <span class="text-xl font-black text-emerald-400 font-headline" id="summaryPrice">Rp -</span>
                        </div>
                    </div>

                    <button type="button" id="submitBookingBtn" class="w-full bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-black py-3.5 rounded-xl font-extrabold text-xs shadow-lg shadow-emerald-500/20 active:scale-95 transition-all flex items-center justify-center gap-2 group" onclick="submitBookingForm()">
                        <span>Konfirmasi Booking</span>
                        <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>

                    <p class="text-[11px] text-gray-400 text-center leading-relaxed">
                        *Dengan mengklik tombol, Anda menyetujui <a class="text-emerald-400 underline" href="#">Syarat &amp; Ketentuan</a> AngSoccer.
                    </p>
                </div>

                <!-- Trust Indicators -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-[#131914] border border-white/10 p-3.5 rounded-xl flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-emerald-400 text-[20px]" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                        <span class="text-xs font-semibold text-gray-300">Pembayaran Aman</span>
                    </div>
                    <div class="bg-[#131914] border border-white/10 p-3.5 rounded-xl flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-emerald-400 text-[20px]" style="font-variation-settings: 'FILL' 1;">electric_bolt</span>
                        <span class="text-xs font-semibold text-gray-300">Instan Konfirmasi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const pricePerHour = {{ $field->price_per_hour }};
    const fieldId = {{ $field->id }};
    const summaryPrice = document.getElementById('summaryPrice');
    const summaryDuration = document.getElementById('summaryDuration');
    const summaryTime = document.getElementById('summaryTime');
    const summaryDate = document.getElementById('summaryDate');
    const bookingDate = document.getElementById('bookingDate');
    const bookingDuration = document.getElementById('bookingDuration');
    const timeSlots = document.querySelectorAll('#timeSlotsContainer input[type="radio"]');
    const submitBtn = document.getElementById('submitBookingBtn');
    
    // Dynamic bookings cache loaded from server
    let existingBookings = @json($bookings);

    function formatRupiah(number) {
        return 'Rp ' + number.toLocaleString('id-ID');
    }

    function isSlotBooked(date, hour) {
        for (const b of existingBookings) {
            const bookingDateOnly = b.date.substring(0, 10);
            if (bookingDateOnly === date) {
                const parts = b.time.split(' - ');
                if (parts.length === 2) {
                    const startHour = parseInt(parts[0].split(':')[0], 10);
                    const endHour = parseInt(parts[1].split(':')[0], 10);
                    if (hour >= startHour && hour < endHour) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    function getLocalTodayStr() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    function setCardState(card, slot, state) {
        // Reset base classes
        card.className = 'time-slot-card relative flex flex-col items-center justify-between p-2 rounded-xl border text-center transition-all duration-200 select-none group';

        const timeEl = card.querySelector('.slot-time');
        const rangeEl = card.querySelector('.slot-range');
        const badgeEl = card.querySelector('.slot-badge');

        timeEl.className = 'slot-time block font-bold text-xs sm:text-sm leading-tight';
        rangeEl.className = 'slot-range block text-[9px] mt-0.5 leading-tight font-medium';
        badgeEl.className = 'slot-badge mt-1.5 sm:mt-2 inline-flex items-center px-1.5 py-0.5 rounded-full text-[9px] font-semibold tracking-wide transition-colors';

        if (state === 'terpilih') {
            slot.disabled = false;
            card.classList.add('bg-emerald-500', 'border-emerald-400', 'shadow-lg', 'shadow-emerald-500/20', 'scale-105', 'cursor-pointer');
            timeEl.classList.add('text-black', 'font-black');
            rangeEl.classList.add('text-black/80');
            badgeEl.classList.add('bg-black/20', 'text-black', 'font-extrabold');
            badgeEl.textContent = 'Terpilih';
        } else if (state === 'terisi') {
            slot.disabled = true;
            card.classList.add('border-red-500/30', 'bg-red-500/10', 'cursor-not-allowed', 'opacity-60', 'pointer-events-none');
            timeEl.classList.add('text-red-400');
            rangeEl.classList.add('text-red-400/70');
            badgeEl.classList.add('bg-red-500/20', 'text-red-400', 'border', 'border-red-500/30');
            badgeEl.textContent = 'Penuh';
        } else if (state === 'lewat') {
            slot.disabled = true;
            card.classList.add('bg-white/[0.02]', 'border-white/5', 'cursor-not-allowed', 'opacity-40', 'pointer-events-none');
            timeEl.classList.add('text-gray-500');
            rangeEl.classList.add('text-gray-600');
            badgeEl.classList.add('bg-white/5', 'text-gray-500');
            badgeEl.textContent = 'Lewat';
        } else { // tersedia
            slot.disabled = false;
            card.classList.add('border-emerald-500/20', 'bg-emerald-500/5', 'hover:border-emerald-500/60', 'hover:shadow-sm', 'cursor-pointer');
            timeEl.classList.add('text-gray-200');
            rangeEl.classList.add('text-gray-400');
            badgeEl.classList.add('bg-emerald-500/10', 'text-emerald-400', 'border', 'border-emerald-500/20');
            badgeEl.textContent = 'Tersedia';
        }
    }

    function updateAvailableTimeSlots() {
        const selectedDate = bookingDate.value;
        const todayStr = getLocalTodayStr();
        const now = new Date();
        const currentHour = now.getHours();

        timeSlots.forEach(slot => {
            const card = slot.closest('.time-slot-card');
            const slotHour = parseInt(slot.value, 10);
            
            const isPast = (selectedDate < todayStr) || (selectedDate === todayStr && slotHour <= currentHour);
            const isBooked = isSlotBooked(selectedDate, slotHour);

            if (slot.checked && (isPast || isBooked)) {
                slot.checked = false;
            }

            if (slot.checked) {
                setCardState(card, slot, 'terpilih');
            } else if (isBooked) {
                setCardState(card, slot, 'terisi');
            } else if (isPast) {
                setCardState(card, slot, 'lewat');
            } else {
                setCardState(card, slot, 'tersedia');
            }
        });

        validateOverlap();
    }

    function validateOverlap() {
        const selectedTime = document.querySelector('#timeSlotsContainer input[type="radio"]:checked');
        const warning = document.getElementById('overlapWarning');
        const warningTitle = document.getElementById('overlapWarningTitle');
        const warningText = document.getElementById('overlapWarningText');

        if (!selectedTime) {
            warning.classList.add('hidden');
            if (submitBtn) submitBtn.disabled = false;
            return true;
        }

        const startHour = parseInt(selectedTime.value.split(':')[0], 10);
        const duration = parseInt(bookingDuration.value, 10);
        const selectedDate = bookingDate.value;

        // 1. Check closing time limit (operational ends at 23:00)
        if (startHour + duration > 23) {
            warningTitle.textContent = "Melebihi Jam Operasional";
            warningText.textContent = `Lapangan tutup pukul 23:00. Pilihan jam ${selectedTime.value} dengan durasi ${duration} jam melewati batas operasional.`;
            warning.classList.remove('hidden');
            if (submitBtn) submitBtn.disabled = true;
            return false;
        }

        // 2. Check collision with existing bookings
        for (let h = startHour; h < startHour + duration; h++) {
            if (isSlotBooked(selectedDate, h)) {
                const conflictStart = String(h).padStart(2, '0') + ':00';
                const conflictEnd = String(h + 1).padStart(2, '0') + ':00';
                warningTitle.textContent = "Slot Waktu Bertabrakan";
                warningText.textContent = `Durasi ${duration} jam Anda bertabrakan dengan pesanan lain pada pukul ${conflictStart} - ${conflictEnd}. Silakan kurangi durasi atau pilih jam mulai yang berbeda.`;
                warning.classList.remove('hidden');
                if (submitBtn) submitBtn.disabled = true;
                return false;
            }
        }

        warning.classList.add('hidden');
        if (submitBtn) submitBtn.disabled = false;
        return true;
    }

    function updateSummary() {
        const duration = parseInt(bookingDuration.value, 10);
        const total = duration * pricePerHour;
        summaryPrice.textContent = formatRupiah(total);
        summaryDuration.textContent = duration + ' Jam';

        if (bookingDate.value) {
            const dateObj = new Date(bookingDate.value);
            const options = { day: 'numeric', month: 'short', year: 'numeric' };
            summaryDate.textContent = dateObj.toLocaleDateString('id-ID', options);
        } else {
            summaryDate.textContent = '-';
        }

        const selectedTime = document.querySelector('#timeSlotsContainer input[type="radio"]:checked');
        if (selectedTime) {
            const startHour = parseInt(selectedTime.value.split(':')[0], 10);
            const endHour = startHour + duration;
            summaryTime.textContent = selectedTime.value + ' - ' + String(endHour).padStart(2, '0') + ':00';
        } else {
            summaryTime.textContent = '-';
        }

        validateOverlap();
    }

    async function fetchBookingsForDate(dateStr) {
        try {
            const response = await fetch(`/booking-lapangan/${fieldId}/bookings?date=${dateStr}`);
            if (response.ok) {
                const data = await response.json();
                existingBookings = data;
                updateAvailableTimeSlots();
                updateSummary();
            }
        } catch (error) {
            console.error('Gagal mengambil jadwal booking:', error);
        }
    }

    bookingDate.addEventListener('change', function() {
        fetchBookingsForDate(this.value);
    });

    bookingDuration.addEventListener('change', updateSummary);

    timeSlots.forEach(slot => {
        slot.addEventListener('change', function() {
            updateAvailableTimeSlots();
            updateSummary();
        });
    });

    function submitBookingForm() {
        const selectedTime = document.querySelector('#timeSlotsContainer input[type="radio"]:checked');
        if (!selectedTime) {
            alert('Silakan pilih waktu mulai booking terlebih dahulu!');
            return;
        }

        if (!validateOverlap()) {
            return;
        }

        document.getElementById('bookingForm').submit();
    }

    // Initialize on page load
    updateAvailableTimeSlots();
    updateSummary();
</script>
@endpush
