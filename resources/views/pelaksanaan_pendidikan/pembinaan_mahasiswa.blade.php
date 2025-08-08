<h2 class="text-2xl font-semibold mb-4 text-gray-800">Pembinaan Mahasiswa</h2>

<div class="card p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="font-bold text-lg">Riwayat Pembinaan Mahasiswa</h3>
        <button id="add-pembinaan-btn" class="bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="button">Tambah Data</button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Akademik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Pembinaan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kegiatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($pembinaans as $pembinaan)
                <tr data-id="{{ $pembinaan->id }}">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pembinaan->tahun_akademik }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pembinaan->jenis_pembinaan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pembinaan->nama_kegiatan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pembinaan->periode_mulai }} - {{ $pembinaan->periode_selesai }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pembinaan->lokasi }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="edit-pembinaan-btn text-indigo-600 hover:text-indigo-900 mx-2" type="button">Edit</button>
                        <button class="delete-pembinaan-btn text-red-600 hover:text-red-900 mx-2" type="button">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data pembinaan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="pembinaan-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900" id="modal-title">Tambah Data Pembinaan Mahasiswa</h3>
            <button id="close-pembinaan-modal-btn" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="mt-2">
            <form id="pembinaan-form" action="{{ route('pelaksanaan-pendidikan.pembinaan-mahasiswa.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="id" id="pembinaan-id">
                <input type="hidden" name="_method" id="pembinaan-method">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="tahun_akademik" class="block text-sm font-medium text-gray-700">Tahun Akademik</label>
                        <input type="text" name="tahun_akademik" id="tahun_akademik" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-tahun_akademik"></div>
                    </div>
                    <div>
                        <label for="jenis_pembinaan" class="block text-sm font-medium text-gray-700">Jenis Pembinaan</label>
                        <input type="text" name="jenis_pembinaan" id="jenis_pembinaan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-jenis_pembinaan"></div>
                    </div>
                    <div>
                        <label for="nama_kegiatan" class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-nama_kegiatan"></div>
                    </div>
                    <div>
                        <label for="periode_mulai" class="block text-sm font-medium text-gray-700">Periode (Mulai)</label>
                        <input type="date" name="periode_mulai" id="periode_mulai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-periode_mulai"></div>
                    </div>
                    <div>
                        <label for="periode_selesai" class="block text-sm font-medium text-gray-700">Periode (Selesai)</label>
                        <input type="date" name="periode_selesai" id="periode_selesai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-periode_selesai"></div>
                    </div>
                    <div>
                        <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-lokasi"></div>
                    </div>
                    <div>
                        <label for="bukti_dokumentasi_file" class="block text-sm font-medium text-gray-700">Bukti Dokumentasi</label>
                        <input type="file" name="bukti_dokumentasi_file" id="bukti_dokumentasi_file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <div class="text-red-500 text-sm mt-1" id="error-bukti_dokumentasi_file"></div>
                        <div class="mt-2 existing-file-link" id="existing-pembinaan-file-link"></div>
                    </div>
                    <div class="md:col-span-2">
                        <label for="keterangan_tambahan" class="block text-sm font-medium text-gray-700">Keterangan Tambahan</label>
                        <textarea name="keterangan_tambahan" id="keterangan_tambahan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        <div class="text-red-500 text-sm mt-1" id="error-keterangan_tambahan"></div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="pelaksanaan-pendidikan-submit-btn bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>