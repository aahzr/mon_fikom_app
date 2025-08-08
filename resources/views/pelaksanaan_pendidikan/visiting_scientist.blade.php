<h2 class="text-2xl font-semibold mb-4 text-gray-800">Visiting Scientist</h2>

<div class="card p-6 mb-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="font-bold text-lg">Riwayat Visiting Scientist</h3>
        <button id="add-visiting-scientist-btn" class="bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="button">Tambah Data</button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Akademik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Institusi Tujuan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Negara/Daerah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Topik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($visitingScientists as $visiting)
                <tr data-id="{{ $visiting->id }}">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visiting->tahun_akademik }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visiting->nama_institusi_tujuan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visiting->negara_daerah }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visiting->topik_kegiatan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $visiting->tanggal_mulai }} - {{ $visiting->tanggal_selesai }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="edit-visiting-scientist-btn text-indigo-600 hover:text-indigo-900 mx-2" type="button">Edit</button>
                        <button class="delete-visiting-scientist-btn text-red-600 hover:text-red-900 mx-2" type="button">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data visiting scientist.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="visiting-scientist-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900" id="modal-title">Tambah Data Visiting Scientist</h3>
            <button id="close-visiting-scientist-modal-btn" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <div class="mt-2">
            <form id="visiting-scientist-form" action="{{ route('pelaksanaan-pendidikan.visiting-scientist.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="id" id="visiting-scientist-id">
                <input type="hidden" name="_method" id="visiting-scientist-method">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="tahun_akademik" class="block text-sm font-medium text-gray-700">Tahun Akademik</label>
                        <input type="text" name="tahun_akademik" id="tahun_akademik" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-tahun_akademik"></div>
                    </div>
                    <div>
                        <label for="nama_institusi_tujuan" class="block text-sm font-medium text-gray-700">Nama Institusi Tujuan</label>
                        <input type="text" name="nama_institusi_tujuan" id="nama_institusi_tujuan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-nama_institusi_tujuan"></div>
                    </div>
                    <div>
                        <label for="negara_daerah" class="block text-sm font-medium text-gray-700">Negara/Daerah</label>
                        <input type="text" name="negara_daerah" id="negara_daerah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-negara_daerah"></div>
                    </div>
                    <div>
                        <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-tanggal_mulai"></div>
                    </div>
                    <div>
                        <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-tanggal_selesai"></div>
                    </div>
                    <div>
                        <label for="topik_kegiatan" class="block text-sm font-medium text-gray-700">Topik/Kegiatan</label>
                        <input type="text" name="topik_kegiatan" id="topik_kegiatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="text-red-500 text-sm mt-1" id="error-topik_kegiatan"></div>
                    </div>
                    <div>
                        <label for="surat_tugas_file" class="block text-sm font-medium text-gray-700">Surat Tugas/Undangan</label>
                        <input type="file" name="surat_tugas_file" id="surat_tugas_file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <div class="text-red-500 text-sm mt-1" id="error-surat_tugas_file"></div>
                        <div class="mt-2 existing-file-link" id="existing-surat-tugas-file-link"></div>
                    </div>
                    <div>
                        <label for="bukti_dokumentasi_file" class="block text-sm font-medium text-gray-700">Bukti Dokumentasi</label>
                        <input type="file" name="bukti_dokumentasi_file" id="bukti_dokumentasi_file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <div class="text-red-500 text-sm mt-1" id="error-bukti_dokumentasi_file"></div>
                        <div class="mt-2 existing-file-link" id="existing-visiting-bukti-file-link"></div>
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