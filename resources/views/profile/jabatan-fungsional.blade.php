<h2 class="text-2xl font-semibold mb-4 text-gray-800">Jabatan Fungsional</h2>
<div class="card">
    <form action="{{ route('profile.jabatan-fungsional.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm text-gray-600 mb-1">Jabatan Terakhir</label>
                <input type="text" name="jabatan_terakhir" value="{{ $profile->jabatan_terakhir }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Nomor SK Jabfung</label>
                <input type="text" name="nomor_sk_jabfung" value="{{ $profile->nomor_sk_jabfung }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Tanggal SK Jabfung</label>
                <input type="date" name="tanggal_sk_jabfung" value="{{ $profile->tanggal_sk_jabfung }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Masa Berlaku</label>
                <input type="date" name="masa_berlaku" value="{{ $profile->masa_berlaku }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm text-gray-600 mb-1">File SK Jabfung</label>
                <input type="file" name="file_sk_jabfung" class="w-full p-2 border border-gray-300 rounded">
                @if($profile->file_sk_jabfung)
                    <a href="{{ asset('storage/' . $profile->file_sk_jabfung) }}" target="_blank" class="mt-2 inline-block text-blue-600 hover:underline">Lihat File</a>
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