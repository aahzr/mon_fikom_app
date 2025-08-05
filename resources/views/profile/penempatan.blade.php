<h2 class="text-2xl font-semibold mb-4 text-gray-800">Penempatan</h2>
<div class="card">
    <form action="{{ route('profile.penempatan.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm text-gray-600 mb-1">Fakultas</label>
                <input type="text" name="fakultas" value="{{ $profile->fakultas }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Program Studi</label>
                <input type="text" name="program_studi" value="{{ $profile->program_studi }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Status Penempatan</label>
                <select name="status_penempatan" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                    <option value="Tetap" {{ $profile->status_penempatan == 'Tetap' ? 'selected' : '' }}>Tetap</option>
                    <option value="Tidak Tetap" {{ $profile->status_penempatan == 'Tidak Tetap' ? 'selected' : '' }}>Tidak Tetap</option>
                    <option value="Kontrak" {{ $profile->status_penempatan == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">TMT Penempatan</label>
                <input type="date" name="tmt_penempatan" value="{{ $profile->tmt_penempatan }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm text-gray-600 mb-1">Lokasi Kampus</label>
                <input type="text" name="lokasi_kampus" value="{{ $profile->lokasi_kampus }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button type="button" class="save-profile btn-primary py-2 px-4 rounded-lg font-semibold">
                Simpan
            </button>
        </div>
    </form>
</div>