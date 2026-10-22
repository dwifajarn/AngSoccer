@extends('layouts.user')

@section('title', 'Booking ' . $field->name . ' - AngSoccer')

@section('main')
    <div class="flex flex-col lg:grid lg:grid-cols-12 gap-xl">
        <!-- Left Column: Booking Form -->
        <div class="lg:col-span-8 space-y-xl">
            <!-- Field Preview Header -->
            <section class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm border border-outline-variant/30">
                <div class="h-64 sm:h-72 relative group overflow-hidden">
                    <img alt="{{ $field->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $field->image_url }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/40 to-black/10"></div>
                    <div class="absolute bottom-md left-md right-md text-white">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="px-2.5 py-0.5 bg-secondary text-white text-xs font-bold rounded-md shadow-sm">
                                {{ $field->type }}
                            </span>
                            <span class="px-2.5 py-0.5 bg-white/20 backdrop-blur-md text-white text-xs font-semibold rounded-md border border-white/20">
                                {{ $field->surface }}
                            </span>
                            <span class="flex items-center gap-1 text-xs text-yellow-400 font-bold ml-auto bg-black/40 px-2 py-0.5 rounded-md backdrop-blur-sm">
                                <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                {{ number_format($field->rating, 1) }}
                            </span>
                        </div>
                        <h1 class="font-headline-lg text-2xl sm:text-3xl text-white font-extrabold tracking-tight">{{ $field->name }}</h1>
                        <p class="font-body-md text-sm text-white/90 flex items-center gap-xs mt-1">
                            <span class="material-symbols-outlined text-[18px] text-secondary-fixed">location_on</span>
                            {{ $field->location }}
                        </p>
                    </div>
                </div>
                @if($field->facilities)
                    <div class="px-lg py-md bg-surface-container-low/60 border-t border-outline-variant/20 flex flex-wrap gap-2 items-center text-xs text-on-surface-variant">
                        <span class="font-bold flex items-center gap-1 text-secondary">
                            <span class="material-symbols-outlined text-[16px]">sports_soccer</span> Fasilitas:
                        </span>
                        <span>{{ $field->facilities }}</span>
                    </div>
                @endif
            </section>

            <!-- Form Card -->
            <form action="{{ route('booking.store') }}" method="POST" id="bookingForm" class="bg-surface-container-lowest rounded-2xl p-lg sm:p-xl shadow-sm border border-outline-variant/30 space-y-xl">
                @csrf
                <input type="hidden" name="lapangan_id" value="{{ $field->id }}">

                <!-- Date Picker -->
                <div class="space-y-sm">
                    <div class="flex items-center justify-between">
                        <h3 class="font-headline-md text-base sm:text-lg text-primary flex items-center gap-sm font-bold">
                            <span class="material-symbols-outlined text-secondary">calendar_today</span>
                            Pilih Tanggal Booking
                        </h3>
                        <span class="text-xs text-on-surface-variant font-medium">Jadwal real-time</span>
                    </div>
                    <div class="relative">
                        <input type="date" name="date" id="bookingDate" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" class="w-full px-md py-sm sm:py-3 bg-surface-container-lowest border border-outline-variant rounded-xl focus:ring-2 focus:ring-secondary/50 focus:border-secondary focus:outline-none font-body-md text-on-surface font-semibold shadow-sm transition-all" required>
                    </div>
                </div>

                <!-- Time Slots Grid Section -->
                <div class="space-y-md">
                    <!-- Section Title & Visual Legend -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-sm">
                        <h3 class="font-headline-md text-base sm:text-lg text-primary flex items-center gap-sm font-bold">
                            <span class="material-symbols-outlined text-secondary">schedule</span>
                            Pilih Waktu Mulai
                        </h3>
                        
                        <!-- Visual Legend -->
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1.5 p-2 bg-surface-container-low/80 rounded-xl border border-outline-variant/30 text-xs">
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-green-500 ring-2 ring-green-200"></span>
                                <span class="text-on-surface-variant font-medium">Tersedia</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-red-500 ring-2 ring-red-200"></span>
                                <span class="text-on-surface-variant font-medium">Terisi</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-gray-400 ring-2 ring-gray-200"></span>
                                <span class="text-on-surface-variant font-medium">Lewat</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-secondary ring-2 ring-secondary/30"></span>
                                <span class="text-on-surface-variant font-medium">Terpilih</span>
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
                            <label class="time-slot-card relative flex flex-col items-center justify-between p-2 rounded-xl border text-center transition-all duration-200 select-none group border-green-200 bg-green-50/50 hover:border-green-500 hover:shadow-sm cursor-pointer" data-slot="{{ $timeSlot }}" data-hour="{{ $hour }}">
                                <input type="radio" name="time" value="{{ $timeSlot }}" class="sr-only" required>
                                
                                <div class="w-full text-center">
                                    <span class="slot-time block font-bold text-sm sm:text-base text-gray-900 leading-tight">{{ $timeSlot }}</span>
                                    <span class="slot-range block text-[10px] text-gray-500 mt-0.5 leading-tight font-medium">{{ $timeSlot }} - {{ $endSlotStr }}</span>
                                </div>
                                
                                <span class="slot-badge mt-1.5 sm:mt-2 inline-flex items-center px-1.5 py-0.5 rounded-full text-[9px] sm:text-[10px] font-semibold tracking-wide transition-colors bg-green-100 text-green-700">
                                    Tersedia
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Duration Selection -->
                <div class="space-y-sm">
                    <h3 class="font-headline-md text-base sm:text-lg text-primary flex items-center gap-sm font-bold">
                        <span class="material-symbols-outlined text-secondary">history</span>
                        Durasi Pemesanan
                    </h3>
                    <select name="duration" id="bookingDuration" class="w-full px-md py-sm sm:py-3 bg-surface-container-lowest border border-outline-variant rounded-xl focus:ring-2 focus:ring-secondary/50 focus:border-secondary focus:outline-none font-body-md text-on-surface font-semibold shadow-sm transition-all" required>
                        <option value="1">1 Jam</option>
                        <option value="2">2 Jam</option>
                        <option value="3">3 Jam</option>
                        <option value="4">4 Jam</option>
                    </select>

                    <!-- Overlap Warning Message -->
                    <div id="overlapWarning" class="hidden p-md bg-red-50 border border-red-200 text-red-700 rounded-xl text-body-md font-medium flex items-start gap-sm mt-sm shadow-sm transition-all">
                        <span class="material-symbols-outlined text-red-600 text-[22px] shrink-0 mt-0.5">warning</span>
                        <div class="flex-1">
                            <h4 class="font-bold text-red-800 text-sm" id="overlapWarningTitle">Waktu Tidak Tersedia</h4>
                            <p class="text-xs text-red-600 mt-0.5" id="overlapWarningText">
                                Durasi pemesanan melebihi batas slot kosong (bertabrakan dengan pesanan lain). Silakan kurangi durasi atau pilih waktu lain.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="space-y-sm">
                    <h3 class="font-headline-md text-base sm:text-lg text-primary flex items-center gap-sm font-bold">
                        <span class="material-symbols-outlined text-secondary">edit_note</span>
                        Catatan Tambahan (Opsional)
                    </h3>
                    <textarea name="notes" class="w-full bg-surface-container-lowest border border-outline-variant rounded-xl p-md font-body-md focus:ring-2 focus:ring-secondary/50 focus:border-secondary outline-none transition-all" placeholder="Contoh: Butuh wasit tambahan, sewa rompi tim, atau kebutuhan khusus lainnya..." rows="3"></textarea>
                </div>
            </form>
        </div>

        <!-- Right Column: Sticky Summary Card -->
        <div class="lg:col-span-4">
            <div class="sticky top-24 space-y-lg">
                <div class="bg-surface-container-lowest rounded-2xl p-lg sm:p-xl shadow-md border border-outline-variant/30 flex flex-col gap-lg">
                    <div class="border-b border-outline-variant/30 pb-sm flex justify-between items-center">
                        <h2 class="font-headline-md text-lg text-secondary font-bold">Ringkasan Pesanan</h2>
                        <span class="px-2 py-0.5 bg-secondary/10 text-secondary rounded text-xs font-bold">{{ $field->type }}</span>
                    </div>

                    <div class="space-y-md">
                        <div class="flex justify-between items-start">
                            <div class="flex flex-col">
                                <span class="text-caption font-caption text-on-surface-variant uppercase tracking-wider">Lapangan</span>
                                <span class="font-label-md text-label-md text-on-surface font-bold">{{ $field->name }}</span>
                                <span class="text-xs text-on-surface-variant">{{ $field->surface }}</span>
                            </div>
                            <span class="material-symbols-outlined text-secondary text-3xl">stadium</span>
                        </div>

                        <div class="flex justify-between items-center py-sm border-y border-outline-variant/15">
                            <div class="flex items-center gap-sm">
                                <span class="material-symbols-outlined text-[20px] text-on-surface-variant">calendar_month</span>
                                <span class="font-body-md text-body-md font-semibold text-on-surface" id="summaryDate">-</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-sm">
                                <span class="material-symbols-outlined text-[20px] text-on-surface-variant">schedule</span>
                                <span class="font-body-md text-body-md font-semibold text-on-surface" id="summaryTime">-</span>
                            </div>
                            <div class="flex items-center gap-sm">
                                <span class="material-symbols-outlined text-[20px] text-on-surface-variant">history</span>
                                <span class="font-body-md text-body-md font-semibold text-secondary" id="summaryDuration">1 Jam</span>
                            </div>
                        </div>
                    </div>

                    <!-- Price Box -->
                    <div class="bg-secondary-container/20 rounded-xl p-md border border-secondary/20 space-y-xs">
                        <div class="flex justify-between items-center text-xs text-on-surface-variant">
                            <span>Tarif per jam</span>
                            <span>Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-sm border-t border-secondary/20">
                            <span class="font-label-md text-label-md font-bold text-on-surface">Total Bayar</span>
                            <span class="font-headline-md text-xl sm:text-2xl text-secondary font-extrabold" id="summaryPrice">Rp -</span>
                        </div>
                    </div>

                    <button type="button" id="submitBookingBtn" class="w-full bg-secondary text-white py-3.5 rounded-xl font-headline-md text-base shadow-lg shadow-secondary/25 hover:bg-secondary/90 hover:-translate-y-0.5 active:scale-95 transition-all flex items-center justify-center gap-sm group font-bold" onclick="submitBookingForm()">
                        Konfirmasi Booking
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>

                    <p class="text-caption font-caption text-on-surface-variant text-center text-xs leading-relaxed">
                        *Dengan mengklik tombol, Anda menyetujui <a class="text-secondary underline" href="#">Syarat &amp; Ketentuan</a> kami.
                    </p>
                </div>

                <!-- Trust Indicators -->
                <div class="grid grid-cols-2 gap-sm">
                    <div class="bg-surface-container-low p-sm rounded-xl flex items-center gap-xs border border-outline-variant/20">
                        <span class="material-symbols-outlined text-secondary text-[20px]" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                        <span class="text-caption font-caption text-xs font-medium">Pembayaran Aman</span>
                    </div>
                    <div class="bg-surface-container-low p-sm rounded-xl flex items-center gap-xs border border-outline-variant/20">
                        <span class="material-symbols-outlined text-secondary text-[20px]" style="font-variation-settings: 'FILL' 1;">electric_bolt</span>
                        <span class="text-caption font-caption text-xs font-medium">Instan Konfirmasi</span>
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
        card.classList.remove(
            'border-green-200', 'bg-green-50/50', 'hover:border-green-500', 'hover:shadow-sm',
            'border-red-200', 'bg-red-50', 'text-red-400',
            'bg-gray-100', 'border-gray-200', 'text-gray-400',
            'bg-secondary', 'text-white', 'border-secondary', 'ring-2', 'ring-secondary/30', 'scale-105', 'shadow-md',
            'cursor-pointer', 'cursor-not-allowed', 'opacity-75', 'opacity-60', 'pointer-events-none'
        );

        const timeEl = card.querySelector('.slot-time');
        const rangeEl = card.querySelector('.slot-range');
        const badgeEl = card.querySelector('.slot-badge');

        timeEl.classList.remove('text-gray-900', 'text-red-400', 'text-gray-400', 'text-white');
        rangeEl.classList.remove('text-gray-500', 'text-red-300', 'text-gray-400', 'text-white/80');
        badgeEl.className = 'slot-badge mt-1.5 sm:mt-2 inline-flex items-center px-1.5 py-0.5 rounded-full text-[9px] sm:text-[10px] font-semibold tracking-wide transition-colors';

        if (state === 'terpilih') {
            slot.disabled = false;
            card.classList.add('bg-secondary', 'text-white', 'border-secondary', 'ring-2', 'ring-secondary/30', 'scale-105', 'shadow-md', 'cursor-pointer');
            timeEl.classList.add('text-white');
            rangeEl.classList.add('text-white/80');
            badgeEl.classList.add('bg-white/20', 'text-white');
            badgeEl.textContent = 'Terpilih';
        } else if (state === 'terisi') {
            slot.disabled = true;
            card.classList.add('border-red-200', 'bg-red-50', 'cursor-not-allowed', 'opacity-75', 'pointer-events-none');
            timeEl.classList.add('text-red-400');
            rangeEl.classList.add('text-red-300');
            badgeEl.classList.add('bg-red-100', 'text-red-600');
            badgeEl.textContent = 'Penuh';
        } else if (state === 'lewat') {
            slot.disabled = true;
            card.classList.add('bg-gray-100', 'border-gray-200', 'cursor-not-allowed', 'opacity-60', 'pointer-events-none');
            timeEl.classList.add('text-gray-400');
            rangeEl.classList.add('text-gray-400');
            badgeEl.classList.add('bg-gray-200', 'text-gray-500');
            badgeEl.textContent = 'Lewat';
        } else { // tersedia
            slot.disabled = false;
            card.classList.add('border-green-200', 'bg-green-50/50', 'hover:border-green-500', 'hover:shadow-sm', 'cursor-pointer');
            timeEl.classList.add('text-gray-900');
            rangeEl.classList.add('text-gray-500');
            badgeEl.classList.add('bg-green-100', 'text-green-700');
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
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
            }
            return true;
        }

        const dateVal = bookingDate.value;
        const durationVal = parseInt(bookingDuration.value, 10);
        const startHour = parseInt(selectedTime.value, 10);
        const endHour = startHour + durationVal;

        // Check operating hours limit (max 23:00)
        if (endHour > 23) {
            warningTitle.textContent = 'Melebihi Jam Operasional';
            warningText.textContent = `Durasi pemesanan (${durationVal} Jam) melebihi jam operasional lapangan (Maksimal pukul 23:00 WIB). Silakan kurangi durasi atau pilih waktu mulai lebih awal.`;
            warning.classList.remove('hidden');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
            }
            return false;
        }

        // Check if any slot in the range [startHour, endHour) is already booked
        let overlappingHour = null;
        for (let h = startHour; h < endHour; h++) {
            if (isSlotBooked(dateVal, h)) {
                overlappingHour = h;
                break;
            }
        }

        if (overlappingHour !== null) {
            const conflictStart = String(overlappingHour).padStart(2, '0') + ':00';
            const conflictEnd = String(overlappingHour + 1).padStart(2, '0') + ':00';
            warningTitle.textContent = 'Jadwal Bentrok';
            warningText.textContent = `Durasi pemesanan (${durationVal} Jam) bertabrakan dengan pesanan lain pada slot ${conflictStart} - ${conflictEnd}. Silakan kurangi durasi atau pilih waktu mulai lain.`;
            warning.classList.remove('hidden');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
            }
            return false;
        }

        // Valid selection
        warning.classList.add('hidden');
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
        }
        return true;
    }

    function updateSummary() {
        // Date
        const dateVal = bookingDate.value;
        if (dateVal) {
            const dateObj = new Date(dateVal + 'T00:00:00');
            const options = { weekday: 'long', day: 'numeric', month: 'short', year: 'numeric' };
            summaryDate.textContent = dateObj.toLocaleDateString('id-ID', options);
        }

        // Duration
        const durationVal = parseInt(bookingDuration.value, 10);
        summaryDuration.textContent = durationVal + ' Jam';

        // Time
        const selectedTime = document.querySelector('#timeSlotsContainer input[type="radio"]:checked');
        if (selectedTime) {
            const timeVal = selectedTime.value;
            const hour = parseInt(timeVal, 10);
            const endHour = hour + durationVal;
            summaryTime.textContent = timeVal + ' - ' + String(endHour).padStart(2, '0') + ':00 WIB';
        } else {
            summaryTime.textContent = '-';
        }

        // Price
        const totalPrice = pricePerHour * durationVal;
        summaryPrice.textContent = formatRupiah(totalPrice);
    }

    // Real-time synchronization on date change
    async function handleDateChange() {
        const selectedDate = bookingDate.value;
        try {
            const response = await fetch(`/booking-lapangan/${fieldId}/bookings?date=${selectedDate}`);
            if (response.ok) {
                const freshBookings = await response.json();
                existingBookings = existingBookings
                    .filter(b => b.date.substring(0, 10) !== selectedDate)
                    .concat(freshBookings);
            }
        } catch (err) {
            // Non-blocking fallback to embedded data
            console.warn('Real-time sync error, using existing bookings data', err);
        }

        updateAvailableTimeSlots();
        updateSummary();
    }

    // Event listeners
    bookingDate.addEventListener('change', handleDateChange);

    bookingDuration.addEventListener('change', () => {
        validateOverlap();
        updateSummary();
    });

    timeSlots.forEach(slot => {
        slot.addEventListener('change', function() {
            updateAvailableTimeSlots();
            updateSummary();
        });
    });

    // Initialize display
    updateAvailableTimeSlots();
    updateSummary();

    function showToast(message, type = 'error') {
        let toast = document.getElementById('bookingToastAlert');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'bookingToastAlert';
            toast.className = 'fixed top-5 right-5 z-[9999] flex items-start gap-md p-md rounded-xl shadow-xl bg-surface-container-lowest border-l-4 transition-all duration-300 max-w-sm';
            document.body.appendChild(toast);
        }
        
        const isError = type === 'error';
        toast.className = `fixed top-5 right-5 z-[9999] flex items-start gap-md p-md rounded-xl shadow-xl bg-surface-container-lowest border-l-4 ${isError ? 'border-error' : 'border-secondary'} transition-all duration-300 max-w-sm`;
        toast.innerHTML = `
            <span class="material-symbols-outlined ${isError ? 'text-error' : 'text-secondary'} text-[24px]">${isError ? 'warning' : 'check_circle'}</span>
            <div class="flex-1">
                <p class="font-bold text-sm ${isError ? 'text-error' : 'text-on-surface'}">${isError ? 'Peringatan' : 'Berhasil'}</p>
                <p class="text-xs text-on-surface-variant mt-0.5">${message}</p>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-on-surface-variant hover:text-on-surface">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        `;

        setTimeout(() => {
            if (toast && toast.parentElement) {
                toast.classList.add('opacity-0');
                setTimeout(() => toast.remove(), 400);
            }
        }, 4000);
    }

    function submitBookingForm() {
        const form = document.getElementById('bookingForm');
        const selectedTime = document.querySelector('#timeSlotsContainer input[type="radio"]:checked');
        
        if (!selectedTime) {
            showToast('Silakan pilih waktu mulai booking terlebih dahulu.');
            return;
        }

        if (!validateOverlap()) {
            showToast('Waktu booking Anda bertabrakan dengan pesanan lain atau melebihi jam operasional.');
            return;
        }

        if (form.checkValidity()) {
            form.submit();
        } else {
            showToast('Silakan lengkapi pilihan tanggal dan waktu mulai booking Anda.');
        }
    }
</script>
@endpush
