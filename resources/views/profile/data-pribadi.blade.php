<h2 class="text-2xl font-semibold mb-4 text-gray-800">Data Pribadi</h2>
<div class="card">
    <form action="{{ route('profile.data-pribadi.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm text-gray-600 mb-1">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ $profile->nama_lengkap }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">NIDN/NIP</label>
                <input type="text" name="nidn_nip" value="{{ $profile->nidn_nip }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="{{ $profile->tempat_lahir }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ $profile->tanggal_lahir }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                    <option value="L" {{ $profile->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ $profile->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Agama</label>
                <input type="text" name="agama" value="{{ $profile->agama }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Nomor Telepon</label>
                <input type="text" name="nomor_telepon" value="{{ $profile->nomor_telepon }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Email Pribadi</label>
                <input type="email" name="email_pribadi" value="{{ $profile->email_pribadi }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm text-gray-600 mb-1">Alamat Domisili</label>
                <textarea name="alamat_domisili" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">{{ $profile->alamat_domisili }}</textarea>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm text-gray-600 mb-1">Foto Profil</label>
                <input type="file" name="foto_profil" class="w-full p-2 border border-gray-300 rounded">
                @if($profile->foto_profil)
                    <img src="{{ asset('storage/' . $profile->foto_profil) }}" alt="Foto Profil"
                        class="mt-4 w-32 h-32 object-cover rounded-full border-2 border-gray-400">
                @endif
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button type="button"
                class="save-profile btn-primary py-2 px-4 rounded-lg font-semibold">
                Simpan
            </button>
        </div>
    </form>
</div>