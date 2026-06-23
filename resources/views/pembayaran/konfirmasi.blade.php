@extends('layouts.user')

@section('title', 'Konfirmasi Pembayaran - AngSoccer')

@section('main')
<div class="mb-xl">
    <h1 class="font-headline-lg text-headline-lg text-on-background font-bold">
        Konfirmasi Pembayaran
    </h1>
    <p class="text-on-surface-variant font-body-md">
        Selesaikan transaksi untuk mengamankan slot lapangan Anda.
    </p>
</div>

<form action="{{ route('pembayaran.submit', $booking->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <input type="hidden"
           name="payment_method"
           value="qris">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-lg">

        <!-- Content -->
        <div class="lg:col-span-8 flex flex-col gap-lg">

            <!-- QRIS -->
            <div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/30">

                <h2 class="font-headline-md text-on-background mb-lg font-bold">
                    Pembayaran QRIS
                </h2>

                <div class="flex flex-col items-center">

                    <!-- QRIS Image -->
                    <div class="bg-white p-lg rounded-xl border border-outline-variant shadow-sm mb-lg">
                        <img
                            src="{{ asset('images/qris.jpeg') }}"
                            alt="QRIS"
                            class="w-64 h-64 object-contain">
                    </div>

                    <div class="bg-surface-container p-md rounded-lg w-full">
                        <p class="font-label-md mb-sm text-on-surface">
                            Cara Pembayaran:
                        </p>

                        <ol class="list-decimal list-inside text-caption text-on-surface-variant space-y-1">
                            <li>Buka aplikasi Mobile Banking atau E-Wallet.</li>
                            <li>Pilih menu Scan QRIS.</li>
                            <li>Scan kode QR di atas.</li>
                            <li>Pastikan nominal sesuai total tagihan.</li>
                            <li>Selesaikan pembayaran.</li>
                            <li>Upload bukti pembayaran pada form di bawah.</li>
                            <li>Tunggu verifikasi admin.</li>
                        </ol>
                    </div>

                </div>
            </div>

            <!-- Upload Bukti -->
            <div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/30">

                <h2 class="font-headline-md text-on-background mb-lg font-bold">
                    Upload Bukti Pembayaran
                </h2>

                <div id="upload-area"
                     class="border-2 border-dashed border-outline-variant rounded-xl p-xl flex flex-col items-center justify-center text-center hover:border-secondary transition-all cursor-pointer relative">

                    <input
                        type="file"
                        id="file-input"
                        name="payment_proof"
                        accept="image/*"
                        onchange="handleImagePreview(event)"
                        required
                        class="absolute inset-0 opacity-0 cursor-pointer">

                    <!-- Placeholder -->
                    <div id="upload-placeholder">

                        <div class="w-16 h-16 rounded-full bg-secondary-container flex items-center justify-center text-secondary mb-md mx-auto">
                            <span class="material-symbols-outlined text-[32px]">
                                cloud_upload
                            </span>
                        </div>

                        <p class="font-label-md text-on-surface mb-xs">
                            Klik untuk memilih gambar
                        </p>

                        <p class="text-caption text-on-surface-variant">
                            JPG, JPEG, PNG (Maksimal 5MB)
                        </p>

                    </div>

                    <!-- Preview -->
                    <div id="image-preview-container"
                         class="hidden flex-col items-center w-full">

                        <img id="image-preview"
                             src=""
                             alt="Preview Bukti Pembayaran"
                             class="max-h-64 rounded-lg mb-md">

                        <button
                            type="button"
                            onclick="resetUpload(event)"
                            class="text-error font-label-md flex items-center gap-xs">

                            <span class="material-symbols-outlined">
                                delete
                            </span>

                            Hapus Bukti
                        </button>

                    </div>

                </div>

                @error('payment_proof')
                    <p class="text-error text-caption mt-sm">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-4">

            <div class="sticky top-24 flex flex-col gap-lg">

                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-outline-variant/30">

                    <img
                        src="{{ $booking->lapangan->image_url }}"
                        alt="{{ $booking->lapangan->name }}"
                        class="h-40 w-full object-cover">

                    <div class="p-lg">

                        <h3 class="font-headline-md text-on-background mb-xs font-bold">
                            {{ $booking->lapangan->name }}
                        </h3>

                        <p class="text-caption text-on-surface-variant mb-md flex items-center gap-xs">
                            <span class="material-symbols-outlined text-[14px]">
                                location_on
                            </span>
                            {{ $booking->lapangan->location }}
                        </p>

                        <div class="flex flex-col gap-sm">

                            <div class="flex justify-between">
                                <span class="text-on-surface-variant">
                                    Booking ID
                                </span>
                                <span class="font-bold">
                                    #{{ $booking->booking_code }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-on-surface-variant">
                                    Tanggal
                                </span>
                                <span>
                                    {{ date('d M Y', strtotime($booking->date)) }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-on-surface-variant">
                                    Waktu
                                </span>
                                <span>
                                    {{ $booking->time }}
                                </span>
                            </div>

                            <div class="h-px bg-surface-container-high my-xs"></div>

                            <div class="flex justify-between items-center font-bold">

                                <span>
                                    Total Tagihan
                                </span>

                                <span class="text-secondary text-headline-md">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                <button
                    type="submit"
                    class="w-full bg-secondary text-on-secondary font-headline-md py-md rounded-xl shadow-lg hover:bg-primary transition-all">

                    Submit Pembayaran

                </button>

                <p class="text-caption text-center text-on-surface-variant">
                    <span class="material-symbols-outlined text-[14px] align-middle">
                        lock
                    </span>
                    Pembayaran Aman & Terenkripsi
                </p>

            </div>

        </div>

    </div>

</form>
@endsection

@push('scripts')
<script>

function handleImagePreview(event) {

    const file = event.target.files[0];

    const placeholder =
        document.getElementById('upload-placeholder');

    const previewContainer =
        document.getElementById('image-preview-container');

    const previewImage =
        document.getElementById('image-preview');

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

    const fileInput =
        document.getElementById('file-input');

    const placeholder =
        document.getElementById('upload-placeholder');

    const previewContainer =
        document.getElementById('image-preview-container');

    fileInput.value = '';

    placeholder.classList.remove('hidden');

    previewContainer.classList.add('hidden');
    previewContainer.classList.remove('flex');
}

</script>
@endpush