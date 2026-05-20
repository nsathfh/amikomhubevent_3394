@extends('layouts.admin')
@section('content')
    <main class="flex-1 overflow-y-auto p-10">
        <header class="mb-10 flex items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black">Manajemen Kategori</h1>
                <p class="font-medium text-slate-500">Kelola daftar kategori event yang tersedia.</p>
            </div>
            <a href="{{ route('admin.categories.create') }}"
                class="rounded-2xl bg-indigo-600 px-6 py-3 font-bold text-white shadow-lg shadow-indigo-100 transition hover:bg-indigo-700 active:scale-95">
                + Tambah Kategori
            </a>
        </header>

        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-6 py-4 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <section class="overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white shadow-sm">
            <div class="border-b bg-slate-50/50 px-8 py-6">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-black text-slate-800">Daftar Kategori</h2>
                        <p class="text-sm text-slate-500">Kolom menampilkan id, nama, created_at, dan updated_at.</p>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left">
                    <thead class="bg-slate-50 text-[10px] font-black uppercase tracking-widest text-slate-400">
                        <tr>
                            <th class="w-20 px-8 py-4">ID</th>
                            <th class="px-8 py-4">Nama</th>
                            <th class="px-8 py-4">Created At</th>
                            <th class="px-8 py-4">Updated At</th>
                            <th class="px-8 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y border-t">
                        @forelse($categories as $category)
                            <tr class="transition hover:bg-slate-50/50">
                                <td class="px-8 py-6 font-bold text-slate-400">{{ $category->id }}</td>
                                <td class="px-8 py-6">
                                    <p class="font-black text-slate-800">{{ $category->name }}</p>
                                </td>
                                <td class="px-8 py-6 text-slate-600">
                                    {{ $category->created_at ? $category->created_at->format('d M Y, H:i') : '-' }}
                                </td>
                                <td class="px-8 py-6 text-slate-600">
                                    {{ $category->updated_at ? $category->updated_at->format('d M Y, H:i') : '-' }}
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex gap-2">
                                        <button type="button"
                                            class="rounded-xl bg-indigo-50 px-4 py-2 text-indigo-600 transition hover:bg-indigo-600 hover:text-white"
                                            onclick='openEditModal({{ $category->id }}, @json($category->name), @json(route("admin.categories.update", $category)))'>
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="rounded-xl bg-rose-50 px-4 py-2 text-rose-600 transition hover:bg-rose-600 hover:text-white"
                                                onclick="return confirm('Hapus kategori ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-10 text-center text-slate-500">Belum ada kategori.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t bg-slate-50 px-8 py-6">
                {{ $categories->links() }}
            </div>
        </section>
    </main>

    <div id="editCategoryModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 px-4 py-8 backdrop-blur-sm">
        <div class="w-full max-w-lg rounded-4xl bg-white p-8 shadow-2xl">
            <div class="mb-6 flex items-start justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-black text-slate-900">Edit Kategori</h2>
                    <p class="mt-1 text-sm text-slate-500">Ubah nama kategori pada form berikut.</p>
                </div>
                <button type="button" class="rounded-full bg-slate-100 px-3 py-1 text-sm font-bold text-slate-500 transition hover:bg-slate-200" onclick="closeEditModal()">
                    ✕
                </button>
            </div>

            <form id="editCategoryForm" method="POST" action="{{ route('admin.categories.index') }}">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="editCategoryName" class="mb-2 block font-bold text-slate-700">Nama Kategori</label>
                    <input id="editCategoryName" type="text" name="name"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                        placeholder="Masukkan nama kategori" required>
                    @error('name')
                        <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="button"
                        class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50"
                        onclick="closeEditModal()">
                        Batal
                    </button>
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white transition hover:bg-indigo-700">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const editCategoryModal = document.getElementById('editCategoryModal');
        const editCategoryForm = document.getElementById('editCategoryForm');
        const editCategoryName = document.getElementById('editCategoryName');

        function openEditModal(id, name, action) {
            editCategoryForm.action = action;
            editCategoryName.value = name;
            editCategoryModal.classList.remove('hidden');
            editCategoryModal.classList.add('flex');
            editCategoryName.focus();
        }

        function closeEditModal() {
            editCategoryModal.classList.add('hidden');
            editCategoryModal.classList.remove('flex');
        }

        editCategoryModal.addEventListener('click', function (event) {
            if (event.target === editCategoryModal) {
                closeEditModal();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeEditModal();
            }
        });
    </script>
@endsection
