<h2 class="text-2xl font-semibold mb-4 text-gray-800">Kepangkatan</h2>
<div class="card">
    <form action="{{ route('profile.kepangkatan.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm text-gray-600 mb-1">Pangkat Terakhir</label>
                <input type="text" name="pangkat_terakhir" value="{{ $profile->pangkat_terakhir }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Golongan Ruang</label>
                <input type="text" name="golongan_ruang" value="{{ $profile->golongan_ruang }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Nomor SK Pangkat</label>
                <input type="text" name="nomor_sk_pangkat" value="{{ $profile->nomor_sk_pangkat }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Tanggal SK Pangkat</label>
                <input type="date" name="tanggal_sk_pangkat" value="{{ $profile->tanggal_sk_pangkat }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Masa Kerja Golongan</label>
                <input type="number" name="masa_kerja_golongan" value="{{ $profile->masa_kerja_golongan }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Instansi Penerbit SK</label>
                <input type="text" name="instansi_sk_pangkat" value="{{ $profile->instansi_sk_pangkat }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm text-gray-600 mb-1">File SK Pangkat</label>
                <input type="file" name="file_sk_pangkat" class="w-full p-2 border border-gray-300 rounded">
                @if($profile->file_sk_pangkat)
                    <a href="{{ asset('storage/' . $profile->file_sk_pangkat) }}" target="_blank" class="mt-2 inline-block text-blue-600 hover:underline">Lihat File</a>
                @endif
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button type="button" class="save-profile btn-primary py-2 px-4 rounded-lg font-semibold">
                Simpan
            </button>
        </div>
    </form>
</div>