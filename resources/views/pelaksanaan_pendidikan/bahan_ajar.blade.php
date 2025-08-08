<h2 class="text-2xl font-semibold mb-4 text-gray-800">Bahan Ajar</h2>

<div class="card p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="font-bold text-lg">Riwayat Bahan Ajar</h3>
        <button id="add-bahan-ajar-btn" class="bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="button">Tambah Data</button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Akademik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Bahan Ajar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Penyusunan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($bahanAjar as $bahan)
                <tr data-id="{{ $bahan->id }}">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $bahan->tahun_akademik }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $bahan->mata_kuliah }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $bahan->judul_bahan_ajar }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $bahan->jenis_bahan_ajar }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $bahan->tanggal_penyusunan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="edit-bahan-ajar-btn text-indigo-600 hover:text-indigo-900 mx-2" type="button">Edit</button>
                        <button class="delete-bahan-ajar-btn text-red-600 hover:text-red-900 mx-2" type="button">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data bahan ajar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="bahan-ajar-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900" id="modal-title">Tambah Data Bahan Ajar</h3>
            <button id="close-bahan-ajar-modal-btn" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="mt-2">
            <form id="bahan-ajar-form" action="{{ route('pelaksanaan-pendidikan.bahan-ajar.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="id" id="bahan-ajar-id">
                <input type="hidden" name="_method" id="bahan-ajar-method">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="tahun_akademik" class="block text-sm font-medium text-gray-700">Tahun Akademik</label>
                        <input type="text" name="tahun_akademik" id="tahun_akademik" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-tahun_akademik"></div>
                    </div>
                    <div>
                        <label for="mata_kuliah" class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
                        <input type="text" name="mata_kuliah" id="mata_kuliah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-mata_kuliah"></div>
                    </div>
                    <div>
                        <label for="judul_bahan_ajar" class="block text-sm font-medium text-gray-700">Judul Bahan Ajar</label>
                        <input type="text" name="judul_bahan_ajar" id="judul_bahan_ajar" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-judul_bahan_ajar"></div>
                    </div>
                    <div>
                        <label for="jenis_bahan_ajar" class="block text-sm font-medium text-gray-700">Jenis Bahan Ajar</label>
                        <input type="text" name="jenis_bahan_ajar" id="jenis_bahan_ajar" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-jenis_bahan_ajar"></div>
                    </div>
                    <div>
                        <label for="tanggal_penyusunan" class="block text-sm font-medium text-gray-700">Tanggal Penyusunan</label>
                        <input type="date" name="tanggal_penyusunan" id="tanggal_penyusunan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-tanggal_penyusunan"></div>
                    </div>
                    <div>
                        <label for="file_bahan_ajar" class="block text-sm font-medium text-gray-700">File Bahan Ajar</label>
                        <input type="file" name="file_bahan_ajar" id="file_bahan_ajar" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <div class="text-red-500 text-sm mt-1" id="error-file_bahan_ajar"></div>
                        <div class="mt-2 existing-file-link" id="existing-bahan-ajar-link"></div>
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