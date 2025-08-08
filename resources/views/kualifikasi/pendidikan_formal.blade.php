<h2 class="text-2xl font-semibold mb-4 text-gray-800">Pendidikan Formal</h2>

<div class="card p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="font-bold text-lg">Riwayat Pendidikan Formal</h3>
        <button id="add-pendidikan-btn" class="bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="button">Tambah Data</button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenjang</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Institusi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gelar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Lulus</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Verifikasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($pendidikans as $pendidikan)
                <tr data-id="{{ $pendidikan->id }}">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pendidikan->jenjang_pendidikan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pendidikan->nama_institusi }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pendidikan->gelar_akademik }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pendidikan->tanggal_lulus }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pendidikan->status_verifikasi }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="edit-pendidikan-btn text-indigo-600 hover:text-indigo-900 mx-2" type="button">Edit</button>
                        <button class="delete-pendidikan-btn text-red-600 hover:text-red-900 mx-2" type="button">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data pendidikan formal.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="pendidikan-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900" id="modal-title">Tambah Data Pendidikan Formal</h3>
            <button id="close-modal-btn" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="mt-2">
            <form id="pendidikan-form" action="{{ route('kualifikasi.pendidikan-formal.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="id" id="pendidikan-id">
                <input type="hidden" name="_method" id="pendidikan-method">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="jenjang_pendidikan" class="block text-sm font-medium text-gray-700">Jenjang Pendidikan</label>
                        <input type="text" name="jenjang_pendidikan" id="jenjang_pendidikan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-jenjang_pendidikan"></div>
                    </div>
                    <div>
                        <label for="nama_institusi" class="block text-sm font-medium text-gray-700">Nama Institusi</label>
                        <input type="text" name="nama_institusi" id="nama_institusi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-nama_institusi"></div>
                    </div>
                    <div>
                        <label for="fakultas_jurusan" class="block text-sm font-medium text-gray-700">Fakultas/Jurusan</label>
                        <input type="text" name="fakultas_jurusan" id="fakultas_jurusan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-fakultas_jurusan"></div>
                    </div>
                    <div>
                        <label for="gelar_akademik" class="block text-sm font-medium text-gray-700">Gelar Akademik</label>
                        <input type="text" name="gelar_akademik" id="gelar_akademik" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity50">
                        <div class="text-red-500 text-sm mt-1" id="error-gelar_akademik"></div>
                    </div>
                    <div>
                        <label for="nomor_ijazah" class="block text-sm font-medium text-gray-700">Nomor Ijazah</label>
                        <input type="text" name="nomor_ijazah" id="nomor_ijazah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-nomor_ijazah"></div>
                    </div>
                    <div>
                        <label for="tanggal_lulus" class="block text-sm font-medium text-gray-700">Tanggal Lulus</label>
                        <input type="date" name="tanggal_lulus" id="tanggal_lulus" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-tanggal_lulus"></div>
                    </div>
                    <div>
                        <label for="negara_institusi" class="block text-sm font-medium text-gray-700">Negara Institusi</label>
                        <input type="text" name="negara_institusi" id="negara_institusi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-negara_institusi"></div>
                    </div>
                    <div>
                        <label for="file_scan_ijazah" class="block text-sm font-medium text-gray-700">File Scan Ijazah</label>
                        <input type="file" name="file_scan_ijazah" id="file_scan_ijazah" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <div class="text-red-500 text-sm mt-1" id="error-file_scan_ijazah"></div>
                        <div class="mt-2 existing-file-link" id="existing-file-link-ijazah"></div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="kualifikasi-submit-btn bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>