<h2 class="text-2xl font-semibold mb-4 text-gray-800">Inpassing</h2>
<div class="card">
    <form action="{{ route('profile.inpassing.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm text-gray-600 mb-1">Status Inpassing</label>
                <select name="status_inpassing" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                    <option value="1" {{ $profile->status_inpassing ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ !$profile->status_inpassing ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Nomor SK Inpassing</label>
                <input type="text" name="nomor_sk_inpassing" value="{{ $profile->nomor_sk_inpassing }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Tanggal SK</label>
                <input type="date" name="tanggal_sk_inpassing" value="{{ $profile->tanggal_sk_inpassing }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Jenjang Pendidikan</label>
                <input type="text" name="jenjang_pendidikan" value="{{ $profile->jenjang_pendidikan }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Jabatan Fungsional</label>
                <input type="text" name="jabatan_inpassing" value="{{ $profile->jabatan_inpassing }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Instansi Penerbit SK</label>
                <input type="text" name="instansi_sk_inpassing" value="{{ $profile->instansi_sk_inpassing }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm text-gray-600 mb-1">File SK Inpassing</label>
                <input type="file" name="file_sk_inpassing" class="w-full p-2 border border-gray-300 rounded">
                @if($profile->file_sk_inpassing)
                    <a href="{{ asset('storage/' . $profile->file_sk_inpassing) }}" target="_blank" class="mt-2 inline-block text-blue-600 hover:underline">Lihat File</a>
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