@extends('layouts.admin')

@section('title', 'Kelola Lapangan - AngSoccer')

@section('main')
    <!-- Header Section -->
    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight font-headline">Kelola Lapangan</h1>
            <p class="text-xs sm:text-sm text-gray-400 mt-1">Tambah, perbarui tarif, dan atur ketersediaan fasilitas lapangan.</p>
        </div>
        <button class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-black px-5 py-2.5 rounded-xl font-bold text-xs shadow-lg shadow-emerald-500/20 active:scale-95 transition-all" onclick="openModalForCreate()">
            <span class="material-symbols-outlined text-[18px]">add_circle</span>
            <span>Tambah Lapangan Baru</span>
        </button>
    </header>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl flex items-center gap-3 text-emerald-400 text-sm shadow-sm">
            <span class="material-symbols-outlined text-emerald-400 text-[22px]">check_circle</span>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Filters & Search Bar -->
    <section class="bg-[#131914] border border-white/10 p-5 rounded-2xl mb-8 shadow-xl">
        <form method="GET" action="{{ route('admin.lapangan.index') }}" class="flex flex-col md:flex-row gap-4 items-center">
            <div class="flex-grow w-full">
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-emerald-400 transition-colors text-[20px]">search</span>
                    <input name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white placeholder-gray-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all" placeholder="Cari nama lapangan atau lokasi..." type="text">
                </div>
            </div>
            <div class="flex gap-3 w-full md:w-auto">
                <select name="type" onchange="this.form.submit()" class="bg-black/40 border border-white/10 text-white rounded-xl px-4 py-2.5 text-xs font-semibold focus:outline-none focus:border-emerald-500 cursor-pointer min-w-[130px]">
                    <option value="">Semua Tipe</option>
                    <option value="Futsal" {{ request('type') == 'Futsal' ? 'selected' : '' }}>Futsal</option>
                    <option value="Soccer" {{ request('type') == 'Soccer' ? 'selected' : '' }}>Soccer</option>
                </select>
                <select name="status" onchange="this.form.submit()" class="bg-black/40 border border-white/10 text-white rounded-xl px-4 py-2.5 text-xs font-semibold focus:outline-none focus:border-emerald-500 cursor-pointer min-w-[130px]">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
        </form>
    </section>

    <!-- Data Table Section -->
    <section class="bg-[#131914] border border-white/10 rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-black/30 text-gray-400 font-bold uppercase tracking-wider border-b border-white/10">
                        <th class="py-4 px-6">Informasi Lapangan</th>
                        <th class="py-4 px-6">Lokasi</th>
                        <th class="py-4 px-6">Tipe &amp; Rumput</th>
                        <th class="py-4 px-6">Tarif Sewa</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($fields as $field)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <img class="w-16 h-12 rounded-xl object-cover border border-white/10 shadow-sm shrink-0" src="{{ $field->image_url }}" alt="{{ $field->name }}">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-white text-sm">{{ $field->name }}</span>
                                        <span class="text-[10px] text-gray-500 font-mono mt-0.5">ID: FL-{{ sprintf('%03d', $field->id) }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-gray-300">
                                <div class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px] text-emerald-400">location_on</span>
                                    <span>{{ $field->location }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex flex-col gap-1">
                                    <span class="font-bold text-white">{{ $field->type }}</span>
                                    <span class="text-[10px] font-medium text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2 py-0.5 rounded-full inline-block w-fit">
                                        {{ $field->surface }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-bold text-emerald-400 text-sm">
                                Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}<span class="text-[10px] text-gray-500 font-normal">/jam</span>
                            </td>
                            <td class="py-4 px-6">
                                @if($field->status == 'active')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-500/10 border border-emerald-500/30 text-emerald-400">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-white/5 border border-white/10 text-gray-400">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <button type="button" onclick="openModalForEdit({{ json_encode($field) }})" class="p-2 bg-white/5 hover:bg-emerald-500/20 text-gray-300 hover:text-emerald-400 rounded-lg transition-all" title="Ubah Lapangan">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </button>
                                    <form action="{{ route('admin.lapangan.destroy', $field->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lapangan ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-white/5 hover:bg-red-500/20 text-gray-300 hover:text-red-400 rounded-lg transition-all" title="Hapus Lapangan">
                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 px-6 text-center text-gray-500">
                                Belum ada lapangan yang terdaftar dalam sistem.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Footer -->
        <div class="p-4 border-t border-white/10 bg-black/20">
            {{ $fields->appends(request()->query())->links() }}
        </div>
    </section>

    <!-- Modal: Add/Edit Field -->
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto opacity-0 pointer-events-none transition-all duration-300" id="addModal">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" onclick="toggleModal(false)"></div>

        <!-- Modal Container -->
        <div class="relative bg-[#131914] border border-white/10 w-full max-w-2xl max-h-[90vh] rounded-2xl shadow-2xl overflow-y-auto scale-95 transition-transform duration-300 z-50 text-white" id="modalContainer">
            <!-- Header -->
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 p-5 flex justify-between items-center sticky top-0 z-10 text-white">
                <h3 class="font-headline text-white font-bold text-lg" id="modalTitle">
                    Tambah Lapangan Baru
                </h3>
                <button class="p-1 text-white/80 hover:text-white rounded-lg hover:bg-white/10 transition-colors" onclick="toggleModal(false)" type="button">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.lapangan.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4" id="lapanganForm">
                @csrf
                <div id="methodPlaceholder"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Nama Lapangan</label>
                        <input name="name" type="text" class="w-full px-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white placeholder-gray-500 focus:outline-none focus:border-emerald-500" required>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Tipe Lapangan</label>
                        <select name="type" class="w-full px-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white focus:outline-none focus:border-emerald-500" required>
                            <option value="Futsal">Futsal</option>
                            <option value="Soccer">Soccer</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Jenis Permukaan</label>
                        <select name="surface" class="w-full px-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white focus:outline-none focus:border-emerald-500" required>
                            <option value="Sintetis">Rumput Sintetis</option>
                            <option value="Rumput Alami">Rumput Alami</option>
                            <option value="Vinyl">Lantai Vinyl</option>
                            <option value="Interlock">Lantai Interlock</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Harga Sewa / Jam</label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-gray-500 font-bold">Rp</span>
                            <input name="price_per_hour" type="number" class="w-full pl-10 pr-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white focus:outline-none focus:border-emerald-500" required>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Lokasi Wilayah</label>
                        <input name="location" type="text" class="w-full px-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white placeholder-gray-500 focus:outline-none focus:border-emerald-500" required>
                    </div>

                    <div class="space-y-1.5 hidden" id="statusContainer">
                        <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Status Lapangan</label>
                        <select name="status" class="w-full px-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white focus:outline-none focus:border-emerald-500">
                            <option value="active">Aktif</option>
                            <option value="inactive">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Deskripsi & Fasilitas Lapangan</label>
                    <textarea name="description" rows="3" class="w-full px-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white placeholder-gray-500 focus:outline-none focus:border-emerald-500" placeholder="Tuliskan spesifikasi lapangan, pencahayaan, ruang ganti, dsb."></textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Upload Foto Lapangan</label>
                    <input name="image" type="file" class="w-full px-3.5 py-2 bg-black/40 border border-white/10 rounded-xl text-xs text-gray-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-emerald-500/20 file:text-emerald-400 hover:file:bg-emerald-500/30">
                </div>

                <!-- Footer -->
                <div class="sticky bottom-0 bg-[#131914] pt-4 border-t border-white/10 flex justify-end gap-3">
                    <button type="button" onclick="toggleModal(false)" class="px-4 py-2 rounded-xl border border-white/10 text-xs font-semibold text-gray-300 hover:bg-white/5 transition-all">
                        Batal
                    </button>
                    <button type="submit" id="submitBtn" class="px-5 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-black font-extrabold rounded-xl text-xs flex items-center gap-1.5 shadow-lg shadow-emerald-500/20 active:scale-95 transition-all">
                        <span class="material-symbols-outlined text-[16px]">save</span>
                        <span id="submitText">Simpan Lapangan</span>
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
    const submitText = document.getElementById('submitText');

    function openModalForCreate() {
        modalTitle.textContent = "Tambah Lapangan Baru";
        lapanganForm.action = "{{ route('admin.lapangan.store') }}";
        methodPlaceholder.innerHTML = "";
        lapanganForm.reset();
        statusContainer.classList.add('hidden');
        submitText.textContent = "Simpan Lapangan";
        toggleModal(true);
    }

    function openModalForEdit(field) {
        modalTitle.textContent = "Edit Lapangan";
        lapanganForm.action = `/admin/lapangan/${field.id}`;
        methodPlaceholder.innerHTML = '<input type="hidden" name="_method" value="PUT">';
        
        lapanganForm.querySelector('[name="name"]').value = field.name;
        lapanganForm.querySelector('[name="type"]').value = field.type;
        lapanganForm.querySelector('[name="surface"]').value = field.surface;
        lapanganForm.querySelector('[name="price_per_hour"]').value = field.price_per_hour;
        lapanganForm.querySelector('[name="location"]').value = field.location;
        lapanganForm.querySelector('[name="description"]').value = field.description || '';
        lapanganForm.querySelector('[name="status"]').value = field.status;
        
        statusContainer.classList.remove('hidden');
        submitText.textContent = "Perbarui Lapangan";
        toggleModal(true);
    }

    function toggleModal(show) {
        const modal = document.getElementById('addModal');
        const container = document.getElementById('modalContainer');
        if (show) {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            container.classList.remove('scale-95');
        } else {
            modal.classList.add('opacity-0', 'pointer-events-none');
            container.classList.add('scale-95');
        }
    }
</script>
@endpush
