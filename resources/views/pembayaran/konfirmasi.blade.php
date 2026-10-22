@extends('layouts.user')

@section('title', 'Konfirmasi Pembayaran - AngSoccer')

@section('main')
    <div class="mb-8">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-bold uppercase tracking-wider mb-2">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
            Langkah Terakhir Pemesanan
        </div>
        <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight font-headline">
            Konfirmasi &amp; Pembayaran QRIS
        </h1>
        <p class="text-xs sm:text-sm text-gray-400 mt-1">
            Selesaikan transfer untuk mengamankan slot lapangan Anda secara permanen.
        </p>
    </div>

    <form action="{{ route('pembayaran.submit', $booking->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="payment_method" value="qris">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Side: QRIS & Upload Proof -->
            <div class="lg:col-span-8 flex flex-col gap-6">
                <!-- QRIS Card -->
                <div class="bg-[#131914] border border-white/10 p-6 sm:p-8 rounded-2xl shadow-xl">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-white/10">
                        <div class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-emerald-400 text-[24px]">qr_code_2</span>
                            <h2 class="text-lg font-bold text-white font-headline">
                                Pembayaran Melalui QRIS
                            </h2>
                        </div>
                        <span class="text-[11px] font-bold uppercase tracking-widest text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3 py-1 rounded-full">
                            Semua Bank &amp; E-Wallet
                        </span>
                    </div>

                    <div class="flex flex-col items-center">
                        <!-- QRIS Image Box -->
                        <div class="bg-white p-5 rounded-2xl border-2 border-emerald-500/30 shadow-2xl mb-6 flex flex-col items-center">
                            <img src="{{ asset('images/qris.jpeg') }}" alt="QRIS AngSoccer" class="w-60 h-60 object-contain">
                            <span class="text-[10px] font-black uppercase tracking-wider text-black mt-2">NMID: ID1020038849204</span>
                        </div>

                        <!-- Instructions -->
                        <div class="bg-black/40 border border-white/10 p-5 rounded-xl w-full">
                            <p class="text-xs font-bold text-white uppercase tracking-wider mb-2.5 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-emerald-400 text-[18px]">info</span>
                                Panduan Pembayaran:
                            </p>
                            <ol class="list-decimal list-inside text-xs text-gray-300 space-y-1.5 leading-relaxed">
                                <li>Buka aplikasi Mobile Banking (BCA, Mandiri, BRI, BNI) atau E-Wallet (GoPay, OVO, Dana, ShopeePay).</li>
                                <li>Pilih menu <strong>Scan QRIS</strong> pada aplikasi Anda.</li>
                                <li>Arahkan kamera ke kode QR di atas.</li>
                                <li>Pastikan nominal transfer tepat sebesar <strong class="text-emerald-400">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</strong>.</li>
                                <li>Selesaikan transaksi dan simpan tangkapan layar (screenshot) bukti transfer.</li>
                                <li>Unggah bukti transfer pada form di bawah ini untuk verifikasi admin.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Upload Bukti Section -->
                <div class="bg-[#131914] border border-white/10 p-6 sm:p-8 rounded-2xl shadow-xl">
                    <div class="flex items-center gap-2.5 mb-6 pb-4 border-b border-white/10">
                        <span class="material-symbols-outlined text-emerald-400 text-[24px]">upload_file</span>
                        <h2 class="text-lg font-bold text-white font-headline">
                            Upload Bukti Transfer
                        </h2>
                    </div>

                    <div id="upload-area" class="border-2 border-dashed border-white/20 hover:border-emerald-500/60 rounded-2xl p-8 flex flex-col items-center justify-center text-center transition-all cursor-pointer relative bg-black/30 group">
                        <input type="file" id="file-input" name="payment_proof" accept="image/*" onchange="handleImagePreview(event)" required class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">

                        <!-- Placeholder -->
                        <div id="upload-placeholder">
                            <div class="w-16 h-16 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center mb-3 mx-auto group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[32px]">cloud_upload</span>
                            </div>
                            <p class="text-sm font-bold text-white mb-1">
                                Klik atau seret foto bukti transfer ke sini
                            </p>
                            <p class="text-xs text-gray-400">
                                Format JPG, JPEG, PNG (Maksimal 5MB)
                            </p>
                        </div>

                        <!-- Preview -->
                        <div id="image-preview-container" class="hidden flex-col items-center w-full relative z-20">
                            <img id="image-preview" src="" alt="Preview Bukti Pembayaran" class="max-h-64 rounded-xl border border-white/10 mb-4 shadow-xl object-contain">
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

                    <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-black font-extrabold text-xs py-3.5 rounded-xl shadow-lg shadow-emerald-500/20 active:scale-95 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">send</span>
                        <span>Submit Bukti Pembayaran</span>
                    </button>
                </form>

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
