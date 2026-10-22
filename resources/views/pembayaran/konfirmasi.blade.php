@extends('layouts.user')

@section('title', 'Konfirmasi Pembayaran - AngSoccer')

@section('main')
    <div class="mb-8">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-bold uppercase tracking-wider mb-2">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
            Langkah Terakhir Pemesanan
        </div>
        <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight font-headline">
            Konfirmasi &amp; Pembayaran Lapangan
        </h1>
        <p class="text-xs sm:text-sm text-gray-400 mt-1">
            Pilih metode pembayaran instan via Duitku Payment Gateway atau transfer manual.
        </p>
    </div>

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-xl flex items-center gap-3 text-red-400 text-xs font-medium">
            <span class="material-symbols-outlined text-red-400 text-[20px]">error</span>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left Side: Payment Options -->
        <div class="lg:col-span-8 flex flex-col gap-6">
            
            <!-- OPTION 1: DUITKU PAYMENT GATEWAY (RECOMMENDED) -->
            <div class="bg-gradient-to-br from-[#131914] to-[#162118] border-2 border-emerald-500/40 p-6 sm:p-8 rounded-2xl shadow-2xl relative overflow-hidden">
                <div class="absolute -top-12 -right-12 w-40 h-40 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6 pb-5 border-b border-white/10">
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-emerald-500 text-black text-[10px] font-black uppercase tracking-wider mb-1.5">
                            <span class="material-symbols-outlined text-[14px]">bolt</span>
                            Rekomendasi (Verifikasi Instan)
                        </div>
                        <h2 class="text-xl font-black text-white font-headline">
                            Duitku Payment Gateway
                        </h2>
                        <p class="text-xs text-gray-400 mt-0.5">Slot otomatis aktif tanpa perlu upload bukti transfer fisik.</p>
                    </div>
                    <span class="text-xs font-bold text-emerald-400 bg-emerald-500/10 border border-emerald-500/30 px-3 py-1.5 rounded-xl w-fit">
                        Online Real-time
                    </span>
                </div>

                <!-- Duitku Pay Form -->
                <form action="{{ route('duitku.checkout', $booking->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block mb-2">Pilih Jalur Pembayaran Duitku:</label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-xs">
                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-emerald-500/40 bg-emerald-500/10 cursor-pointer hover:border-emerald-500 transition-colors">
                                <input type="radio" name="duitku_channel" value="SP" checked class="text-emerald-500 focus:ring-0">
                                <div class="flex flex-col">
                                    <span class="font-bold text-white leading-tight">QRIS</span>
                                    <span class="text-[9px] text-emerald-400">Semua M-Banking</span>
                                </div>
                            </label>
                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-white/10 bg-black/40 cursor-pointer hover:border-emerald-500/40 transition-colors">
                                <input type="radio" name="duitku_channel" value="BC" class="text-emerald-500 focus:ring-0">
                                <div class="flex flex-col">
                                    <span class="font-bold text-white leading-tight">BCA VA</span>
                                    <span class="text-[9px] text-gray-400">Virtual Account</span>
                                </div>
                            </label>
                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-white/10 bg-black/40 cursor-pointer hover:border-emerald-500/40 transition-colors">
                                <input type="radio" name="duitku_channel" value="M2" class="text-emerald-500 focus:ring-0">
                                <div class="flex flex-col">
                                    <span class="font-bold text-white leading-tight">Mandiri VA</span>
                                    <span class="text-[9px] text-gray-400">Virtual Account</span>
                                </div>
                            </label>
                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-white/10 bg-black/40 cursor-pointer hover:border-emerald-500/40 transition-colors">
                                <input type="radio" name="duitku_channel" value="BR" class="text-emerald-500 focus:ring-0">
                                <div class="flex flex-col">
                                    <span class="font-bold text-white leading-tight">BRI VA</span>
                                    <span class="text-[9px] text-gray-400">Virtual Account</span>
                                </div>
                            </label>
                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-white/10 bg-black/40 cursor-pointer hover:border-emerald-500/40 transition-colors">
                                <input type="radio" name="duitku_channel" value="I1" class="text-emerald-500 focus:ring-0">
                                <div class="flex flex-col">
                                    <span class="font-bold text-white leading-tight">BNI VA</span>
                                    <span class="text-[9px] text-gray-400">Virtual Account</span>
                                </div>
                            </label>
                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-white/10 bg-black/40 cursor-pointer hover:border-emerald-500/40 transition-colors">
                                <input type="radio" name="duitku_channel" value="DA" class="text-emerald-500 focus:ring-0">
                                <div class="flex flex-col">
                                    <span class="font-bold text-white leading-tight">DANA</span>
                                    <span class="text-[9px] text-gray-400">E-Wallet</span>
                                </div>
                            </label>
                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-white/10 bg-black/40 cursor-pointer hover:border-emerald-500/40 transition-colors">
                                <input type="radio" name="duitku_channel" value="OV" class="text-emerald-500 focus:ring-0">
                                <div class="flex flex-col">
                                    <span class="font-bold text-white leading-tight">OVO</span>
                                    <span class="text-[9px] text-gray-400">E-Wallet</span>
                                </div>
                            </label>
                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-white/10 bg-black/40 cursor-pointer hover:border-emerald-500/40 transition-colors">
                                <input type="radio" name="duitku_channel" value="NQ" class="text-emerald-500 focus:ring-0">
                                <div class="flex flex-col">
                                    <span class="font-bold text-white leading-tight">Nobu QRIS</span>
                                    <span class="text-[9px] text-gray-400">QR Dinamis</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-black font-black text-sm py-4 rounded-xl shadow-xl shadow-emerald-500/25 active:scale-98 transition-all flex items-center justify-center gap-2 group">
                        <span class="material-symbols-outlined text-[22px]">payments</span>
                        <span>Bayar Sekarang via Duitku →</span>
                    </button>
                </form>
                <p class="text-[11px] text-gray-500 text-center mt-2.5">
                    Anda akan dialihkan ke halaman pembayaran resmi Duitku untuk menyelesaikan transaksi.
                </p>
            </div>

            <!-- OPTION 2: MANUAL TRANSFER & PROOF UPLOAD (FALLBACK) -->
            <div class="bg-[#131914] border border-white/10 p-6 sm:p-8 rounded-2xl shadow-xl">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-white/10">
                    <div class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-gray-400 text-[22px]">receipt_long</span>
                        <h2 class="text-base font-bold text-white font-headline">
                            Alternatif: Transfer Manual &amp; Unggah Bukti
                        </h2>
                    </div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider bg-white/5 px-2.5 py-1 rounded-full">
                        Verifikasi Manual Admin
                    </span>
                </div>

                <!-- Form Upload Bukti -->
                <form action="{{ route('pembayaran.submit', $booking->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="payment_method" value="qris">

                    <div id="upload-area" class="border-2 border-dashed border-white/20 hover:border-emerald-500/60 rounded-2xl p-8 flex flex-col items-center justify-center text-center transition-all cursor-pointer relative bg-black/30 group">
                        <input type="file" id="file-input" name="payment_proof" accept="image/*" onchange="handleImagePreview(event)" required class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">

                        <!-- Placeholder -->
                        <div id="upload-placeholder">
                            <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 text-gray-400 flex items-center justify-center mb-3 mx-auto group-hover:scale-110 group-hover:text-emerald-400 group-hover:border-emerald-500/30 transition-all">
                                <span class="material-symbols-outlined text-[28px]">cloud_upload</span>
                            </div>
                            <p class="text-xs font-bold text-white mb-1">
                                Klik atau seret foto bukti transfer manual ke sini
                            </p>
                            <p class="text-[11px] text-gray-400">
                                Format JPG, JPEG, PNG (Maksimal 5MB)
                            </p>
                        </div>

                        <!-- Preview -->
                        <div id="image-preview-container" class="hidden flex-col items-center w-full relative z-20">
                            <img id="image-preview" src="" alt="Preview Bukti Pembayaran" class="max-h-56 rounded-xl border border-white/10 mb-3 shadow-xl object-contain">
                            <button type="button" onclick="resetUpload(event)" class="text-xs font-bold text-red-400 hover:text-red-300 flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/10 border border-red-500/20 transition-all">
                                <span class="material-symbols-outlined text-[16px]">delete</span>
                                <span>Ganti Foto Bukti</span>
                            </button>
                        </div>
                    </div>

                    @error('payment_proof')
                        <p class="text-red-400 text-xs mt-2 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">error</span>
                            {{ $message }}
                        </p>
                    @enderror

                    <button type="submit" class="w-full bg-white/10 hover:bg-white/20 border border-white/10 text-white font-bold text-xs py-3 rounded-xl transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">send</span>
                        <span>Submit Bukti Transfer Manual</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Side: Sidebar Summary -->
        <div class="lg:col-span-4">
            <div class="sticky top-24 flex flex-col gap-6">
                <div class="bg-[#131914] border border-white/10 rounded-2xl overflow-hidden shadow-xl">
                    <img src="{{ $booking->lapangan->image_url }}" alt="{{ $booking->lapangan->name }}" class="h-40 w-full object-cover">

                    <div class="p-6">
                        <h3 class="text-lg font-bold text-white font-headline mb-1">
                            {{ $booking->lapangan->name }}
                        </h3>
                        <p class="text-xs text-gray-400 mb-5 flex items-center gap-1">
                            <span class="material-symbols-outlined text-emerald-400 text-[16px]">location_on</span>
                            {{ $booking->lapangan->location }}
                        </p>

                        <div class="space-y-3 text-xs">
                            <div class="flex justify-between items-center py-1">
                                <span class="text-gray-400 uppercase tracking-wider text-[10px] font-bold">Booking ID</span>
                                <span class="font-mono font-bold text-emerald-400 text-sm">#{{ $booking->booking_code }}</span>
                            </div>

                            <div class="flex justify-between items-center py-1 border-t border-white/5">
                                <span class="text-gray-400 uppercase tracking-wider text-[10px] font-bold">Tanggal</span>
                                <span class="font-semibold text-gray-200">{{ date('d M Y', strtotime($booking->date)) }}</span>
                            </div>

                            <div class="flex justify-between items-center py-1 border-t border-white/5">
                                <span class="text-gray-400 uppercase tracking-wider text-[10px] font-bold">Waktu</span>
                                <span class="font-semibold text-gray-200">{{ $booking->time }}</span>
                            </div>

                            <div class="pt-3 border-t border-white/10 flex justify-between items-center">
                                <span class="text-xs font-bold text-gray-300 uppercase tracking-wider">Total Tagihan</span>
                                <span class="text-xl font-black text-emerald-400 font-headline">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                @if(!$booking->payment_proof)
                    <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                        @csrf
                        <button type="submit" class="w-full py-2.5 px-4 border border-red-500/30 text-red-400 hover:bg-red-500/10 rounded-xl text-xs font-bold transition-all text-center">
                            Batalkan Pesanan Ini
                        </button>
                    </form>
                @endif

                <p class="text-[11px] text-center text-gray-500 flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-[16px] text-emerald-400">lock</span>
                    <span>Pembayaran Aman &amp; Terenkripsi</span>
                </p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function handleImagePreview(event) {
        const file = event.target.files[0];
        const placeholder = document.getElementById('upload-placeholder');
        const previewContainer = document.getElementById('image-preview-container');
        const previewImage = document.getElementById('image-preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                placeholder.classList.add('hidden');
                previewContainer.classList.remove('hidden');
                previewContainer.classList.add('flex');
            };
            reader.readAsDataURL(file);
        }
    }

    function resetUpload(event) {
        event.preventDefault();
        event.stopPropagation();
        const fileInput = document.getElementById('file-input');
        const placeholder = document.getElementById('upload-placeholder');
        const previewContainer = document.getElementById('image-preview-container');

        fileInput.value = '';
        placeholder.classList.remove('hidden');
        previewContainer.classList.add('hidden');
        previewContainer.classList.remove('flex');
    }
</script>
@endpush
