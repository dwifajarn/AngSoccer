@extends('layouts.admin')

@section('title', 'Kelola Lapangan - AngSoccer')

@section('main')
    <!-- Header Section -->
    <header class="flex justify-between items-end mb-xl">
        <div class="space-y-sm">
            <h2 class="font-headline-lg text-headline-lg text-on-background font-bold text-3xl">Kelola Lapangan</h2>
            <p class="text-on-surface-variant font-body-md">Tambah, ubah, atau hapus daftar lapangan olahraga yang tersedia.</p>
        </div>
        <button class="flex items-center gap-sm bg-secondary text-on-secondary px-lg py-md rounded-lg font-label-md shadow-md hover:scale-105 active:scale-95 transition-all" onclick="openModalForCreate()">
            <span class="material-symbols-outlined">add</span>
            Tambah Lapangan
        </button>
    </header>

    @if(session('success'))
        <div class="mb-lg p-md bg-secondary-container text-on-secondary-container rounded-lg font-body-md">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filters & Search Bar -->
    <section class="bg-surface-container-lowest p-lg rounded-xl mb-xl shadow-sm border border-outline-variant/30">
        <form method="GET" action="{{ route('admin.lapangan.index') }}" class="flex flex-wrap gap-lg items-center">
            <div class="flex-grow min-w-[300px]">
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                    <input name="search" value="{{ request('search') }}" class="w-full pl-xl pr-md py-md bg-surface-container-low border-transparent focus:border-secondary focus:ring-1 focus:ring-secondary rounded-lg font-body-md transition-all" placeholder="Cari nama lapangan atau lokasi..." type="text">
                </div>
            </div>
            <div class="flex gap-md">
                <select name="type" onchange="this.form.submit()" class="bg-surface-container-low border-transparent focus:border-secondary focus:ring-1 focus:ring-secondary rounded-lg px-md py-md font-label-md min-w-[160px]">
                    <option value="">Semua Tipe</option>
                    <option value="Futsal" {{ request('type') == 'Futsal' ? 'selected' : '' }}>Futsal</option>
                    <option value="Soccer" {{ request('type') == 'Soccer' ? 'selected' : '' }}>Soccer</option>
                </select>
                <select name="status" onchange="this.form.submit()" class="bg-surface-container-low border-transparent focus:border-secondary focus:ring-1 focus:ring-secondary rounded-lg px-md py-md font-label-md min-w-[140px]">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
        </form>
    </section>

    <!-- Data Table Section -->
    <section class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden border border-surface-container">
        <table class="w-full border-collapse text-left">
            <thead class="bg-surface-container-low border-b border-surface-container">
                <tr>
                    <th class="p-lg font-label-md text-on-surface-variant">Info Lapangan</th>
                    <th class="p-lg font-label-md text-on-surface-variant">Lokasi</th>
                    <th class="p-lg font-label-md text-on-surface-variant">Tipe</th>
                    <th class="p-lg font-label-md text-on-surface-variant">Harga / Jam</th>
                    <th class="p-lg font-label-md text-on-surface-variant">Status</th>
                    <th class="p-lg font-label-md text-on-surface-variant text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container">
                @forelse($fields as $field)
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="p-lg">
                            <div class="flex items-center gap-md">
                                <img class="w-16 h-12 rounded-lg object-cover shadow-sm" src="{{ $field->image_url }}">
                                <div class="flex flex-col">
                                    <span class="font-bold text-on-surface">{{ $field->name }}</span>
                                    <span class="text-caption text-on-surface-variant">ID: FL-{{ sprintf('%03d', $field->id) }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="p-lg text-body-md text-on-surface-variant">{{ $field->location }}</td>
                        <td class="p-lg">
                            <span class="px-md py-xs bg-tertiary-container text-on-tertiary-container rounded-full text-caption font-bold">{{ strtoupper($field->surface) }}</span>
                        </td>
                        <td class="p-lg font-bold text-secondary">Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}</td>
                        <td class="p-lg">
                            @if($field->status == 'active')
                                <span class="flex items-center gap-xs text-secondary">
                                    <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                                    <span class="font-label-md">Aktif</span>
                                </span>
                            @else
                                <span class="flex items-center gap-xs text-on-surface-variant">
                                    <span class="w-2 h-2 rounded-full bg-outline"></span>
                                    <span class="font-label-md">Nonaktif</span>
                                </span>
                            @endif
                        </td>
                        <td class="p-lg text-right">
                            <div class="flex justify-end gap-sm opacity-0 group-hover:opacity-100 transition-opacity">
                                <button type="button" onclick="openModalForEdit({{ json_encode($field) }})" class="p-sm hover:bg-secondary-container hover:text-on-secondary-container rounded-lg transition-all text-secondary" title="Edit">
                                    <span class="material-symbols-outlined">edit</span>
                                </button>
                                <form action="{{ route('admin.lapangan.destroy', $field->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lapangan ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-sm hover:bg-error-container hover:text-on-error-container rounded-lg transition-all text-error" title="Delete">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-lg text-center text-on-surface-variant">
                            Belum ada lapangan yang terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <!-- Pagination Footer -->
        <div class="p-lg border-t border-surface-container flex justify-between items-center bg-surface-container-lowest">
            {{ $fields->appends(request()->query())->links() }}
        </div>
    </section>

    <!-- Modal: Add/Edit Field -->
    <div
        class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto opacity-0 pointer-events-none transition-all duration-300"
        id="addModal">

        <!-- Overlay -->
        <div
            class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"
            onclick="toggleModal(false)">
        </div>

        <!-- Modal Container -->
        <div
            class="relative bg-surface-container-lowest w-full max-w-2xl max-h-[90vh] rounded-2xl shadow-2xl overflow-y-auto scale-95 transition-transform duration-300 z-50"
            id="modalContainer">

            <!-- Header -->
            <div class="bg-secondary p-lg flex justify-between items-center sticky top-0 z-10">
                <h3
                    class="font-headline-md text-white font-bold text-xl"
                    id="modalTitle">
                    Tambah Lapangan Baru
                </h3>

                <button
                    class="p-sm hover:bg-white/20 rounded-full transition-colors"
                    onclick="toggleModal(false)"
                    type="button">

                    <span class="material-symbols-outlined text-white">
                        close
                    </span>
                </button>
            </div>

            <!-- Form -->
            <form
                action="{{ route('admin.lapangan.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="p-xl space-y-lg"
                id="lapanganForm">

                @csrf

                <div id="methodPlaceholder"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">

                    <div class="flex flex-col gap-xs">
                        <label>Nama Lapangan</label>
                        <input
                            name="name"
                            type="text"
                            class="w-full px-md py-md border rounded-lg"
                            required>
                    </div>

                    <div class="flex flex-col gap-xs">
                        <label>Tipe Lapangan</label>
                        <select
                            name="type"
                            class="w-full px-md py-md border rounded-lg"
                            required>

                            <option value="Futsal">Futsal</option>
                            <option value="Soccer">Soccer</option>
                        </select>
                    </div>

                    <div class="flex flex-col gap-xs">
                        <label>Jenis Permukaan</label>

                        <select
                            name="surface"
                            class="w-full px-md py-md border rounded-lg"
                            required>

                            <option value="Sintetis">Sintetis</option>
                            <option value="Rumput Alami">Rumput Alami</option>
                        </select>
                    </div>

                    <div class="flex flex-col gap-xs">
                        <label>Harga Per Jam</label>

                        <div class="relative">
                            <span
                                class="absolute left-3 top-1/2 -translate-y-1/2">
                                Rp
                            </span>

                            <input
                                name="price_per_hour"
                                type="number"
                                class="w-full pl-10 pr-3 py-3 border rounded-lg text-right"
                                required>
                        </div>
                    </div>

                    <div class="flex flex-col gap-xs">
                        <label>Lokasi (Kota/Wilayah)</label>

                        <input
                            name="location"
                            type="text"
                            class="w-full px-md py-md border rounded-lg"
                            required>
                    </div>

                    <div
                        class="flex flex-col gap-xs hidden"
                        id="statusContainer">

                        <label>Status Lapangan</label>

                        <select
                            name="status"
                            class="w-full px-md py-md border rounded-lg">

                            <option value="active">Aktif</option>
                            <option value="inactive">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col gap-xs">
                    <label>Deskripsi & Fasilitas</label>

                    <textarea
                        name="description"
                        rows="4"
                        class="w-full px-md py-md border rounded-lg"></textarea>
                </div>

                <div class="flex flex-col gap-xs">
                    <label>Upload Foto Lapangan</label>

                    <input
                        name="image"
                        type="file"
                        class="w-full px-md py-md border rounded-lg">
                </div>

                <!-- Footer -->
                <div
                    class="sticky bottom-0 bg-white border-t pt-4 flex justify-end gap-3">

                    <button
                        type="button"
                        onclick="toggleModal(false)"
                        class="px-5 py-2 rounded-lg border">

                        Batal
                    </button>

                    <button
                        type="submit"
                        id="submitBtn"
                        class="px-6 py-2 bg-secondary text-white rounded-lg flex items-center gap-2">

                        <span class="material-symbols-outlined">
                            save
                        </span>

                        <span id="submitText">
                            Simpan Lapangan
                        </span>
                    </button>

                </div>

            </form>

        </div>
    </div>
@endsection

@push('scripts')
<script>
    const modalTitle = document.getElementById('modalTitle');
    const lapanganForm = document.getElementById('lapanganForm');
    const methodPlaceholder = document.getElementById('methodPlaceholder');
    const statusContainer = document.getElementById('statusContainer');
    const submitBtn = document.getElementById('submitBtn');

    function openModalForCreate() {
        modalTitle.textContent = "Tambah Lapangan Baru";
        lapanganForm.action = "{{ route('admin.lapangan.store') }}";
        methodPlaceholder.innerHTML = "";
        
        // Reset values
        lapanganForm.reset();
        
        // Hide status field for new creations
        statusContainer.classList.add('hidden');
        submitBtn.textContent = "Simpan Lapangan";
        
        toggleModal(true);
    }

    function openModalForEdit(field) {
        modalTitle.textContent = "Edit Lapangan";
        lapanganForm.action = `/admin/lapangan/${field.id}`;
        methodPlaceholder.innerHTML = '@method("PUT")';
        
        // Populate values
        lapanganForm.querySelector('[name="name"]').value = field.name;
        lapanganForm.querySelector('[name="type"]').value = field.type;
        lapanganForm.querySelector('[name="surface"]').value = field.surface;
        lapanganForm.querySelector('[name="price_per_hour"]').value = field.price_per_hour;
        lapanganForm.querySelector('[name="location"]').value = field.location;
        lapanganForm.querySelector('[name="description"]').value = field.description || "";
        lapanganForm.querySelector('[name="status"]').value = field.status;
        
        // Show status field
        statusContainer.classList.remove('hidden');
        submitBtn.textContent = "Update Lapangan";
        
        toggleModal(true);
    }

    function toggleModal(show) {
    const modal = document.getElementById('addModal');
    const container = document.getElementById('modalContainer');

    if (show) {
        modal.classList.remove('opacity-0', 'pointer-events-none');

        container.classList.remove('scale-95');
        container.classList.add('scale-100');

        document.body.classList.add('overflow-hidden');
    } else {
        modal.classList.add('opacity-0', 'pointer-events-none');

        container.classList.remove('scale-100');
        container.classList.add('scale-95');

        document.body.classList.remove('overflow-hidden');
    }
}
</script>
@endpush