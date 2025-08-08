<h2 class="text-2xl font-semibold mb-4 text-gray-800">Diklat</h2>

<div class="card p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="font-bold text-lg">Riwayat Diklat</h3>
        <button id="add-diklat-btn" class="bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="button">Tambah Data</button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelatihan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penyelenggara</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Verifikasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($diklats as $diklat)
                <tr data-id="{{ $diklat->id }}">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $diklat->nama_pelatihan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $diklat->penyelenggara }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $diklat->durasi_jam }} jam</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $diklat->status_verifikasi }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="edit-diklat-btn text-indigo-600 hover:text-indigo-900 mx-2" type="button">Edit</button>
                        <button class="delete-diklat-btn text-red-600 hover:text-red-900 mx-2" type="button">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data diklat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="diklat-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900" id="modal-title">Tambah Data Diklat</h3>
            <button id="close-diklat-modal-btn" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="mt-2">
            <form id="diklat-form" action="{{ route('kualifikasi.diklat.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="id" id="diklat-id">
                <input type="hidden" name="_method" id="diklat-method">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nama_pelatihan" class="block text-sm font-medium text-gray-700">Nama Pelatihan</label>
                        <input type="text" name="nama_pelatihan" id="nama_pelatihan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-nama_pelatihan"></div>
                    </div>
                    <div>
                        <label for="penyelenggara" class="block text-sm font-medium text-gray-700">Penyelenggara</label>
                        <input type="text" name="penyelenggara" id="penyelenggara" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-penyelenggara"></div>
                    </div>
                    <div>
                        <label for="jenis_pelatihan" class="block text-sm font-medium text-gray-700">Jenis Pelatihan</label>
                        <input type="text" name="jenis_pelatihan" id="jenis_pelatihan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-jenis_pelatihan"></div>
                    </div>
                    <div>
                        <label for="waktu_pelaksanaan" class="block text-sm font-medium text-gray-700">Waktu Pelaksanaan</label>
                        <input type="text" name="waktu_pelaksanaan" id="waktu_pelaksanaan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-waktu_pelaksanaan"></div>
                    </div>
                    <div>
                        <label for="durasi_jam" class="block text-sm font-medium text-gray-700">Durasi (jam)</label>
                        <input type="number" name="durasi_jam" id="durasi_jam" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-durasi_jam"></div>
                    </div>
                    <div>
                        <label for="tempat" class="block text-sm font-medium text-gray-700">Tempat</label>
                        <input type="text" name="tempat" id="tempat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-tempat"></div>
                    </div>
                    <div>
                        <label for="sertifikat" class="block text-sm font-medium text-gray-700">Sertifikat</label>
                        <input type="file" name="sertifikat" id="sertifikat" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <div class="text-red-500 text-sm mt-1" id="error-sertifikat"></div>
                        <div class="mt-2 existing-file-link" id="existing-file-link-sertifikat"></div>
                    </div>
                    <div class="md:col-span-2">
                        <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        <div class="text-red-500 text-sm mt-1" id="error-keterangan"></div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="kualifikasi-submit-btn bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>