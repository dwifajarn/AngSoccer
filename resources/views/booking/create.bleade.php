@extends('layouts.user')

@section('title', 'Booking Lapangan - AngSoccer')

@section('main')
    <div class="flex flex-col lg:grid lg:grid-cols-12 gap-xl">
        <!-- Left Column: Booking Form -->
        <div class="lg:col-span-8 space-y-xl">
            <!-- Field Preview Header -->
            <section class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-outline-variant/30">
                <div class="h-64 relative group">
                    <img alt="{{ $field->name }}" class="w-full h-full object-cover" src="{{ $field->image_url }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-md left-md text-on-primary">
                        <h1 class="font-headline-lg text-headline-lg text-white font-bold">{{ $field->name }}</h1>
                        <p class="font-body-md text-body-md text-white/90 flex items-center gap-xs mt-1">
                            <span class="material-symbols-outlined text-[20px]">location_on</span>
                            {{ $field->location }}
                        </p>
                    </div>
                </div>
            </section>

            <!-- Form Card -->
            <form action="{{ route('booking.store') }}" method="POST" id="bookingForm" class="bg-surface-container-lowest rounded-xl p-lg shadow-sm border border-outline-variant/30 space-y-xl">
                @csrf
                <input type="hidden" name="lapangan_id" value="{{ $field->id }}">

                <!-- Date Picker -->
                <div class="space-y-md">
                    <h3 class="font-headline-md text-headline-md text-primary flex items-center gap-sm font-bold">
                        <span class="material-symbols-outlined">calendar_today</span>
                        Pilih Tanggal Booking
                    </h3>
                    <input type="date" name="date" id="bookingDate" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" class="w-full px-md py-sm bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary/50 focus:outline-none font-body-md" required>
                </div>

                <!-- Time Slots Selection -->
                <div class="space-y-md">
                    <h3 class="font-headline-md text-headline-md text-primary flex items-center gap-sm font-bold">
                        <span class="material-symbols-outlined">schedule</span>
                        Pilih Waktu Mulai
                    </h3>
                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-sm" id="timeSlotsContainer">
                        @foreach(['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00'] as $timeSlot)
                            <label class="time-slot-label cursor-pointer text-center py-2 px-1 border border-outline-variant rounded-full font-label-md text-label-md hover:border-secondary transition-all block">
                                <input type="radio" name="time" value="{{ $timeSlot }}" class="hidden" required>
                                <span>{{ $timeSlot }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Duration Selection -->
                <div class="space-y-md">
                    <h3 class="font-headline-md text-headline-md text-primary flex items-center gap-sm font-bold">
                        <span class="material-symbols-outlined">history</span>
                        Durasi Pemesanan
                    </h3>
                    <select name="duration" id="bookingDuration" class="w-full px-md py-sm bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary/50 focus:outline-none font-body-md" required>
                        <option value="1">1 Jam</option>
                        <option value="2">2 Jam</option>
                        <option value="3">3 Jam</option>
                        <option value="4">4 Jam</option>
                    </select>
                    <div id="overlapWarning" class="hidden p-md bg-error-container text-error rounded-lg text-caption font-semibold flex items-center gap-xs mt-sm">
                        <span class="material-symbols-outlined text-[18px]">warning</span>
                        Durasi pemesanan melebihi batas slot kosong (bertabrakan dengan pesanan lain). Silakan kurangi durasi atau pilih waktu lain.
                    </div>
                </div>

                <!-- Notes -->
                <div class="space-y-md">
                    <h3 class="font-headline-md text-headline-md text-primary flex items-center gap-sm font-bold">
                        <span class="material-symbols-outlined">edit_note</span>
                        Catatan Tambahan
                    </h3>
                    <textarea name="notes" class="w-full bg-surface-container-low border border-outline-variant/50 rounded-lg p-md font-body-md focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all" placeholder="Contoh: Butuh wasit tambahan, sewa rompi, dll." rows="4"></textarea>
                </div>
            </form>
        </div>

        <!-- Right Column: Sticky Summary Card -->
        <div class="lg:col-span-4">
            <div class="sticky top-24 space-y-lg">
                <div class="bg-surface-container-lowest rounded-xl p-lg shadow-md border border-outline-variant/30 flex flex-col gap-lg">
                    <h2 class="font-headline-md text-headline-md text-secondary border-b border-outline-variant/30 pb-sm font-bold">Ringkasan Pesanan</h2>
                    <div class="space-y-md">
                        <div class="flex justify-between items-start">
                            <div class="flex flex-col">
                                <span class="text-caption font-caption text-on-surface-variant uppercase tracking-wider">Lapangan</span>
                                <span class="font-label-md text-label-md text-on-surface font-bold">{{ $field->name }}</span>
                            </div>
                            <span class="material-symbols-outlined text-secondary">stadium</span>
                        </div>
                        <div class="flex justify-between items-center py-sm border-y border-outline-variant/10">
                            <div class="flex items-center gap-sm">
                                <span class="material-symbols-outlined text-[20px] text-on-surface-variant">calendar_month</span>
                                <span class="font-body-md text-body-md" id="summaryDate">-</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-sm">
                                <span class="material-symbols-outlined text-[20px] text-on-surface-variant">schedule</span>
                                <span class="font-body-md text-body-md" id="summaryTime">-</span>
                            </div>
                            <div class="flex items-center gap-sm">
                                <span class="material-symbols-outlined text-[20px] text-on-surface-variant">history</span>
                                <span class="font-body-md text-body-md" id="summaryDuration">1 Jam</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-secondary-container/30 rounded-lg p-md space-y-xs">
                        <div class="flex justify-between items-center mt-sm pt-sm border-t border-secondary/20">
                            <span class="font-label-md text-label-md font-bold text-on-surface">Total Bayar</span>
                            <span class="font-headline-md text-headline-md text-secondary font-bold" id="summaryPrice">Rp -</span>
                        </div>
                    </div>
                    <button type="button" class="w-full bg-secondary text-on-secondary py-md rounded-xl font-headline-md text-headline-md shadow-lg shadow-secondary/20 hover:bg-secondary/90 hover:-translate-y-1 active:scale-95 transition-all flex items-center justify-center gap-sm group" onclick="submitBookingForm()">
                        Konfirmasi Booking
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                    <p class="text-caption font-caption text-on-surface-variant text-center">
                        *Dengan mengklik tombol, Anda menyetujui <a class="text-secondary underline" href="#">Syarat &amp; Ketentuan</a> kami.
                    </p>
                </div>
                <!-- Trust Indicators -->
                <div class="grid grid-cols-2 gap-sm">
                    <div class="bg-surface-container-low p-sm rounded-lg flex items-center gap-xs">
                        <span class="material-symbols-outlined text-secondary text-[20px]" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                        <span class="text-caption font-caption">Pembayaran Aman</span>
                    </div>
                    <div class="bg-surface-container-low p-sm rounded-lg flex items-center gap-xs">
                        <span class="material-symbols-outlined text-secondary text-[20px]" style="font-variation-settings: 'FILL' 1;">electric_bolt</span>
                        <span class="text-caption font-caption">Instan Konfirmasi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const pricePerHour = {{ $field->price_per_hour }};
    const summaryPrice = document.getElementById('summaryPrice');
    const summaryDuration = document.getElementById('summaryDuration');
    const summaryTime = document.getElementById('summaryTime');
    const summaryDate = document.getElementById('summaryDate');
    const bookingDate = document.getElementById('bookingDate');
    const bookingDuration = document.getElementById('bookingDuration');
    const timeSlots = document.querySelectorAll('#timeSlotsContainer input[type="radio"]');
    const existingBookings = @json($bookings);

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

    function updateAvailableTimeSlots() {
        const selectedDate = bookingDate.value;
        const todayStr = getLocalTodayStr();
        const now = new Date();
        const currentHour = now.getHours();

        timeSlots.forEach(slot => {
            const label = slot.parentElement;
            const slotHour = parseInt(slot.value, 10);
            
            const isPast = (selectedDate === todayStr && slotHour <= currentHour);
            const isBooked = isSlotBooked(selectedDate, slotHour);

            if (isPast || isBooked) {
                slot.disabled = true;
                slot.checked = false;
                
                label.classList.add('bg-surface-container-low', 'text-on-surface-variant/40', 'border-outline-variant/30', 'opacity-50', 'cursor-not-allowed', 'pointer-events-none');
                label.classList.remove('bg-secondary', 'text-white', 'border-secondary', 'hover:border-secondary', 'shadow-sm', 'scale-105');
            } else {
                slot.disabled = false;
                
                label.classList.remove('bg-surface-container-low', 'text-on-surface-variant/40', 'border-outline-variant/30', 'opacity-50', 'cursor-not-allowed', 'pointer-events-none');
                label.classList.add('hover:border-secondary');
            }
        });

        validateOverlap();
    }

    function validateOverlap() {
        const selectedTime = document.querySelector('#timeSlotsContainer input[type="radio"]:checked');
        const warning = document.getElementById('overlapWarning');
        const submitBtn = document.querySelector('button[onclick="submitBookingForm()"]');

        if (!selectedTime) {
            warning.classList.add('hidden');
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
            return true;
        }

        const dateVal = bookingDate.value;
        const durationVal = parseInt(bookingDuration.value, 10);
        const startHour = parseInt(selectedTime.value, 10);
        const endHour = startHour + durationVal;

        let hasOverlap = false;
        for (let h = startHour; h < endHour; h++) {
            if (isSlotBooked(dateVal, h)) {
                hasOverlap = true;
                break;
            }
        }

        if (hasOverlap) {
            warning.classList.remove('hidden');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
            return false;
        } else {
            warning.classList.add('hidden');
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
            return true;
        }
    }

    function updateSummary() {
        // Date
        const dateVal = bookingDate.value;
        if (dateVal) {
            const dateObj = new Date(dateVal);
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
            summaryTime.textContent = timeVal + ' - ' + (endHour < 10 ? '0' + endHour : endHour) + ':00 WIB';
        } else {
            summaryTime.textContent = '-';
        }

        // Price
        const totalPrice = pricePerHour * durationVal;
        summaryPrice.textContent = formatRupiah(totalPrice);
    }

    // Event listeners
    bookingDate.addEventListener('change', () => {
        updateAvailableTimeSlots();
        updateSummary();
    });
    
    bookingDuration.addEventListener('change', () => {
        validateOverlap();
        updateSummary();
    });

    timeSlots.forEach(slot => {
        slot.addEventListener('change', function() {
            document.querySelectorAll('.time-slot-label').forEach(label => {
                // Keep classes off disabled slots
                const input = label.querySelector('input');
                if (!input || !input.disabled) {
                    label.classList.remove('bg-secondary', 'text-white', 'border-secondary', 'shadow-sm', 'scale-105');
                    label.classList.add('hover:border-secondary');
                }
            });

            if (this.checked) {
                const label = this.parentElement;
                label.classList.add('bg-secondary', 'text-white', 'border-secondary', 'shadow-sm', 'scale-105');
                label.classList.remove('hover:border-secondary');
            }
            validateOverlap();
            updateSummary();
        });
    });

    // Initial load
    updateAvailableTimeSlots();
    updateSummary();

    function submitBookingForm() {
        const form = document.getElementById('bookingForm');
        
        if (!validateOverlap()) {
            alert('Waktu booking Anda bentrok dengan booking yang sudah ada.');
            return;
        }

        if (form.checkValidity()) {
            form.submit();
        } else {
            alert('Silakan lengkapi pilihan tanggal dan waktu mulai booking Anda.');
        }
    }
</script>
@endpush
