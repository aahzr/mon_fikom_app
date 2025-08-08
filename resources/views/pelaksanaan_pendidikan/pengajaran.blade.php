<h2 class="text-2xl font-semibold mb-4 text-gray-800">Pengajaran</h2>

<div class="card p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="font-bold text-lg">Riwayat Pengajaran</h3>
        <button id="add-pengajaran-btn" class="bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="button">Tambah Data</button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Akademik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($pengajarans as $pengajaran)
                <tr data-id="{{ $pengajaran->id }}">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pengajaran->tahun_akademik }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pengajaran->semester }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pengajaran->mata_kuliah }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pengajaran->jumlah_sks }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="edit-pengajaran-btn text-indigo-600 hover:text-indigo-900 mx-2" type="button">Edit</button>
                        <button class="delete-pengajaran-btn text-red-600 hover:text-red-900 mx-2" type="button">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data pengajaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="pengajaran-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900" id="modal-title">Tambah Data Pengajaran</h3>
            <button id="close-pengajaran-modal-btn" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="mt-2">
            <form id="pengajaran-form" action="{{ route('pelaksanaan-pendidikan.pengajaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="id" id="pengajaran-id">
                <input type="hidden" name="_method" id="pengajaran-method">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="tahun_akademik" class="block text-sm font-medium text-gray-700">Tahun Akademik</label>
                        <input type="text" name="tahun_akademik" id="tahun_akademik" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-tahun_akademik"></div>
                    </div>
                    <div>
                        <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                        <input type="text" name="semester" id="semester" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-semester"></div>
                    </div>
                    <div>
                        <label for="mata_kuliah" class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
                        <input type="text" name="mata_kuliah" id="mata_kuliah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-mata_kuliah"></div>
                    </div>
                    <div>
                        <label for="kode_mata_kuliah" class="block text-sm font-medium text-gray-700">Kode Mata Kuliah</label>
                        <input type="text" name="kode_mata_kuliah" id="kode_mata_kuliah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-kode_mata_kuliah"></div>
                    </div>
                    <div>
                        <label for="jumlah_sks" class="block text-sm font-medium text-gray-700">Jumlah SKS</label>
                        <input type="number" name="jumlah_sks" id="jumlah_sks" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-jumlah_sks"></div>
                    </div>
                    <div>
                        <label for="program_studi" class="block text-sm font-medium text-gray-700">Program Studi</label>
                        <input type="text" name="program_studi" id="program_studi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-program_studi"></div>
                    </div>
                    <div>
                        <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                        <input type="text" name="kelas" id="kelas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-kelas"></div>
                    </div>
                    <div>
                        <label for="jumlah_pertemuan" class="block text-sm font-medium text-gray-700">Jumlah Pertemuan</label>
                        <input type="number" name="jumlah_pertemuan" id="jumlah_pertemuan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-jumlah_pertemuan"></div>
                    </div>
                    <div>
                        <label for="rps_file" class="block text-sm font-medium text-gray-700">RPS/Rencana Pembelajaran</label>
                        <input type="file" name="rps_file" id="rps_file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <div class="text-red-500 text-sm mt-1" id="error-rps_file"></div>
                        <div class="mt-2 existing-file-link" id="existing-rps-link"></div>
                    </div>
                    <div>
                        <label for="bukti_kehadiran_file" class="block text-sm font-medium text-gray-700">Bukti Kehadiran</label>
                        <input type="file" name="bukti_kehadiran_file" id="bukti_kehadiran_file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <div class="text-red-500 text-sm mt-1" id="error-bukti_kehadiran_file"></div>
                        <div class="mt-2 existing-file-link" id="existing-kehadiran-link"></div>
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