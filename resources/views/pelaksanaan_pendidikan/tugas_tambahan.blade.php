<h2 class="text-2xl font-semibold mb-4 text-gray-800">Tugas Tambahan</h2>

<div class="card p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="font-bold text-lg">Riwayat Tugas Tambahan</h3>
        <button id="add-tugas-tambahan-btn" class="bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="button">Tambah Data</button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Akademik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Jabatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode Menjabat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($tugasTambahan as $tugas)
                <tr data-id="{{ $tugas->id }}">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tugas->tahun_akademik }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tugas->nama_jabatan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $tugas->periode_menjabat }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="edit-tugas-tambahan-btn text-indigo-600 hover:text-indigo-900 mx-2" type="button">Edit</button>
                        <button class="delete-tugas-tambahan-btn text-red-600 hover:text-red-900 mx-2" type="button">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data tugas tambahan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="tugas-tambahan-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900" id="modal-title">Tambah Data Tugas Tambahan</h3>
            <button id="close-tugas-tambahan-modal-btn" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="mt-2">
            <form id="tugas-tambahan-form" action="{{ route('pelaksanaan-pendidikan.tugas-tambahan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="id" id="tugas-tambahan-id">
                <input type="hidden" name="_method" id="tugas-tambahan-method">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="tahun_akademik" class="block text-sm font-medium text-gray-700">Tahun Akademik</label>
                        <input type="text" name="tahun_akademik" id="tahun_akademik" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-tahun_akademik"></div>
                    </div>
                    <div>
                        <label for="nama_jabatan" class="block text-sm font-medium text-gray-700">Nama Jabatan</label>
                        <input type="text" name="nama_jabatan" id="nama_jabatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-nama_jabatan"></div>
                    </div>
                    <div>
                        <label for="periode_menjabat" class="block text-sm font-medium text-gray-700">Periode Menjabat</label>
                        <input type="text" name="periode_menjabat" id="periode_menjabat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-periode_menjabat"></div>
                    </div>
                    <div>
                        <label for="sk_file" class="block text-sm font-medium text-gray-700">Surat Keputusan</label>
                        <input type="file" name="sk_file" id="sk_file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <div class="text-red-500 text-sm mt-1" id="error-sk_file"></div>
                        <div class="mt-2 existing-file-link" id="existing-sk-file-link"></div>
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