<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pusat Manajemen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header class="flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900">Manajemen Kelas</h2>
                            <p class="mt-1 text-sm text-gray-600">Tambah, edit, atau hapus data kelas.</p>
                        </div>
                        <a href="{{ route('admin.kelas.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Tambah</a>
                    </header>
                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">Nama Kelas</th>
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">Wali Kelas</th>
                                    <th class="px-4 py-2"></th> </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($kelasList as $kelas)
                                    <tr>
                                        <td class="px-4 py-2 font-medium text-gray-900">{{ $kelas->name }}</td>
                                        <td class="px-4 py-2 text-gray-700">{{ $kelas->homeroomTeacher->name ?? 'Belum Diatur' }}</td>
                                        <td class="px-4 py-2 text-right">
                                            <div class="inline-flex rounded-lg border border-gray-100 bg-gray-100 p-1">

                                                <a href="{{ route('admin.kelas.edit', $kelas->id) }}" class="inline-block rounded-md px-4 py-2 text-sm text-gray-500 hover:text-gray-700 focus:relative">
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('admin.kelas.destroy', $kelas->id) }}" id="delete-form-{{ $kelas->id }}">
                                                @csrf
                                                @method('DELETE')
                                                    <button type="button" class="delete-button inline-block rounded-md px-4 py-2 text-sm text-red-500 hover:text-red-700 focus:relative" data-form-id="{{ $kelas->id }}">
                                                    Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-gray-500 py-4">Tidak ada data kelas.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4">
                        {{ $kelasList->links() }}
                        </div>

                    </div>
                </section>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">Manajemen Akun Pengguna</h2>
                        <p class="mt-1 text-sm text-gray-600">Manajemen akun untuk semua peran.</p>
                    </header>

                    <div class="flex justify-between items-center mt-6">
                    <h3 class="text-md font-medium text-gray-800">Kepala Sekolah</h3>
                    <a href="{{ route('admin.kepsek.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Tambah</a>
                    </div>
                    <div class="mt-2 overflow-x-auto">
                    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 font-medium text-left text-gray-900">Nama</th>
                                <th class="px-4 py-2 font-medium text-left text-gray-900">Username</th>
                                <th class="px-4 py-2"></th> </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($kepseks as $user)
                                <tr>
                                    <td class="px-4 py-2 font-medium text-gray-900">{{ $user->name }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $user->username }}</td>
                                    <td class="px-4 py-2 text-right">
                                        <div class="inline-flex rounded-lg border border-gray-100 bg-gray-100 p-1">
                                            <a href="{{ route('admin.kepsek.edit', $user->id) }}" class="inline-block rounded-md px-4 py-2 text-sm text-gray-500 hover:text-gray-700 focus:relative">
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('admin.kepsek.destroy', $user->id) }}" id="delete-form-user-{{ $user->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="delete-button inline-block rounded-md px-4 py-2 text-sm text-red-500 hover:text-red-700 focus:relative" data-form-id="user-{{ $user->id }}">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center text-gray-500 py-4">Tidak ada data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                    {{ $kepseks->links() }}
                    </div>
                    </div>
                    <div class="flex justify-between items-center mt-6">
                        <h3 class="text-md font-medium text-gray-800">Guru</h3>
                        <a href="{{ route('admin.guru.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Tambah</a>
                    </div>
                    <div class="mt-2 overflow-x-auto">
                    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">Nama</th>
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">Username</th>
                                    <th class="px-4 py-2"></th></tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($gurus as $user)
                                    <tr>
                                    <td class="px-4 py-2 font-medium text-gray-900">{{ $user->name }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $user->username }}</td>
                                    <td class="px-4 py-2 text-right">
                                            <div class="inline-flex rounded-lg border border-gray-100 bg-gray-100 p-1">
                                                <a href="{{ route('admin.guru.edit', $user->id) }}" class="inline-block rounded-md px-4 py-2 text-sm text-gray-500 hover:text-gray-700 focus:relative">
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('admin.guru.destroy', $user->id) }}" id="delete-form-user-{{ $user->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="delete-button inline-block rounded-md px-4 py-2 text-sm text-red-500 hover:text-red-700 focus:relative" data-form-id="user-{{ $user->id }}">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                    </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-gray-500 py-4">Tidak ada data.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4">
                        {{ $gurus->links() }}
                        </div>
                    </div>
                    <div class="flex justify-between items-center mt-6">
                        <h3 class="text-md font-medium text-gray-800">Siswa</h3>
                        <div class="flex items-center">
                        <form method="POST" action="{{ route('admin.siswa.resetAllKelas') }}" id="delete-form-reset-kelas">
                            @csrf
                            <button type="button" class="delete-button inline-flex items-center px-4 py-2 bg-yellow-600 border rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500" data-form-id="reset-kelas">
                                Reset Kelas
                            </button>
                        </form>
                        <a href="{{ route('admin.siswa.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Tambah</a>

                        </div>
                    </div>
                    <div class="mt-2 overflow-x-auto">
                       <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">Nama</th>
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">Username</th>
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">Kelas</th>
                                    <th class="px-4 py-2 font-medium text-left">Status</th>
                                    <th class="px-4 py-2"></th></tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($siswas as $user)
                                    <tr>
                                    <td class="px-4 py-2 font-medium text-gray-900">{{ $user->name }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $user->username }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $user->kelas->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-2">
                                    <span class="px-2.5 py-0.5 rounded-full text-xs {{ $user->status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($user->status) }}
                                    </span>
                                    </td>


                                    <td class="px-4 py-2 text-right">
                                            <div class="inline-flex rounded-lg border border-gray-100 bg-gray-100 p-1">
                                            <form method="POST" action="{{ route('admin.siswa.toggleStatus', $user->id) }}">
                                            @csrf
                                            <button type="submit" class="inline-block rounded-md px-4 py-2 text-sm text-gray-500 hover:text-gray-700 focus:relative">
                                            {{ $user->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                            </form>

                                                <a href="{{ route('admin.siswa.edit', $user->id) }}" class="inline-block rounded-md px-4 py-2 text-sm text-gray-500 hover:text-gray-700 focus:relative">
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('admin.siswa.destroy', $user->id) }}" id="delete-form-user-{{ $user->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="delete-button inline-block rounded-md px-4 py-2 text-sm text-red-500 hover:text-red-700 focus:relative" data-form-id="user-{{ $user->id }}">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                    </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-gray-500 py-4">Tidak ada data.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4">
                        {{ $siswas->links() }}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
// Pastikan script berjalan setelah semua elemen dimuat
document.addEventListener('DOMContentLoaded', function () {
    // Cari semua tombol dengan class 'delete-button'
    const deleteButtons = document.querySelectorAll('.delete-button');

    // Tambahkan event listener ke setiap tombol
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            // Mencegah aksi default
            event.preventDefault();

            // Ambil ID form dari atribut data
            const formId = this.dataset.formId;
            const form = document.getElementById(`delete-form-${formId}`);

            // Tampilkan modal konfirmasi SweetAlert2
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                // Jika pengguna mengklik "Ya, hapus!"
                if (result.isConfirmed) {
                    // Kirim form
                    form.submit();
                }
            })
        });
    });
});
</script>
@endpush
