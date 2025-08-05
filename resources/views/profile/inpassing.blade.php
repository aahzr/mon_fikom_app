<h2 class="text-xl font-semibold mb-4">Inpassing</h2>
    <form action="{{ route('profile.inpassing.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label>Status Inpassing</label>
            <select name="status_inpassing" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
                <option value="1" {{ $profile->status_inpassing ? 'selected' : '' }}>Ya</option>
                <option value="0" {{ !$profile->status_inpassing ? 'selected' : '' }}>Tidak</option>
            </select>
        </div>
        <div class="mb-4">
            <label>Nomor SK Inpassing</label>
            <input type="text" name="nomor_sk_inpassing" value="{{ $profile->nomor_sk_inpassing }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
        </div>
        <div class="mb-4">
            <label>Tanggal SK</label>
            <input type="date" name="tanggal_sk_inpassing" value="{{ $profile->tanggal_sk_inpassing }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
        </div>
        <div class="mb-4">
            <label>Jenjang Pendidikan</label>
            <input type="text" name="jenjang_pendidikan" value="{{ $profile->jenjang_pendidikan }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
        </div>
        <div class="mb-4">
            <label>Jabatan Fungsional</label>
            <input type="text" name="jabatan_inpassing" value="{{ $profile->jabatan_inpassing }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
        </div>
        <div class="mb-4">
            <label>Instansi Penerbit SK</label>
            <input type="text" name="instansi_sk_inpassing" value="{{ $profile->instansi_sk_inpassing }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
        </div>
        <div class="mb-4">
            <label>File SK Inpassing</label>
            <input type="file" name="file_sk_inpassing" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
            @if($profile->file_sk_inpassing)
                <a href="{{ asset('storage/' . $profile->file_sk_inpassing) }}" target="_blank" class="mt-2 inline-block">Lihat File</a>
            @endif
        </div>
        <button type="button" class="save-profile bg-yellow-600 text-black py-2 px-4 rounded">Simpan</button>
    </form>