<h2 class="text-2xl font-semibold mb-4 text-gray-800">Bimbingan Mahasiswa</h2>

<div class="card p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="font-bold text-lg">Riwayat Bimbingan Mahasiswa</h3>
        <button id="add-bimbingan-btn" class="bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="button">Tambah Data</button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Akademik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Bimbingan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mahasiswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul/Tema</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($bimbingans as $bimbingan)
                <tr data-id="{{ $bimbingan->id }}">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $bimbingan->tahun_akademik }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $bimbingan->jenis_bimbingan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $bimbingan->nama_mahasiswa }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $bimbingan->judul_tema }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $bimbingan->status }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="edit-bimbingan-btn text-indigo-600 hover:text-indigo-900 mx-2" type="button">Edit</button>
                        <button class="delete-bimbingan-btn text-red-600 hover:text-red-900 mx-2" type="button">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data bimbingan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="bimbingan-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900" id="modal-title">Tambah Data Bimbingan Mahasiswa</h3>
            <button id="close-bimbingan-modal-btn" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="mt-2">
            <form id="bimbingan-form" action="{{ route('pelaksanaan-pendidikan.bimbingan-mahasiswa.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="id" id="bimbingan-id">
                <input type="hidden" name="_method" id="bimbingan-method">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="tahun_akademik" class="block text-sm font-medium text-gray-700">Tahun Akademik</label>
                        <input type="text" name="tahun_akademik" id="tahun_akademik" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-tahun_akademik"></div>
                    </div>
                    <div>
                        <label for="jenis_bimbingan" class="block text-sm font-medium text-gray-700">Jenis Bimbingan</label>
                        <input type="text" name="jenis_bimbingan" id="jenis_bimbingan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-jenis_bimbingan"></div>
                    </div>
                    <div>
                        <label for="nama_mahasiswa" class="block text-sm font-medium text-gray-700">Nama Mahasiswa</label>
                        <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-nama_mahasiswa"></div>
                    </div>
                    <div>
                        <label for="nim_mahasiswa" class="block text-sm font-medium text-gray-700">NIM Mahasiswa</label>
                        <input type="text" name="nim_mahasiswa" id="nim_mahasiswa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-nim_mahasiswa"></div>
                    </div>
                    <div>
                        <label for="judul_tema" class="block text-sm font-medium text-gray-700">Judul/Tema</label>
                        <input type="text" name="judul_tema" id="judul_tema" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-judul_tema"></div>
                    </div>
                    <div>
                        <label for="jumlah_bimbingan" class="block text-sm font-medium text-gray-700">Jumlah Bimbingan</label>
                        <input type="number" name="jumlah_bimbingan" id="jumlah_bimbingan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-jumlah_bimbingan"></div>
                    </div>
                    <div>
                        <label for="bukti_bimbingan_file" class="block text-sm font-medium text-gray-700">Bukti Bimbingan</label>
                        <input type="file" name="bukti_bimbingan_file" id="bukti_bimbingan_file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <div class="text-red-500 text-sm mt-1" id="error-bukti_bimbingan_file"></div>
                        <div class="mt-2 existing-file-link" id="existing-bimbingan-file-link"></div>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="Berjalan">Berjalan</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                        <div class="text-red-500 text-sm mt-1" id="error-status"></div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="pelaksanaan-pendidikan-submit-btn bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>