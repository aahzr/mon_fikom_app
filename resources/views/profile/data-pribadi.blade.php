<h2 class="text-xl font-semibold mb-4">Data Pribadi</h2>
<form action="{{ route('profile.data-pribadi.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="{{ $profile->nama_lengkap }}"
            class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
    </div>
    <div class="mb-4">
        <label>NIDN/NIP</label>
        <input type="text" name="nidn_nip" value="{{ $profile->nidn_nip }}"
            class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
    </div>
    <div class="mb-4">
        <label>Tempat, Tanggal Lahir</label>
        <input type="text" name="tempat_lahir" value="{{ $profile->tempat_lahir }}"
            class="w-1/2 p-2 bg-gray-800 border border-gray-600 rounded mr-2">
        <input type="date" name="tanggal_lahir" value="{{ $profile->tanggal_lahir }}"
            class="w-1/2 p-2 bg-gray-800 border border-gray-600 rounded">
    </div>
    <div class="mb-4">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
            <option value="L" {{ $profile->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ $profile->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>
    <div class="mb-4">
        <label>Agama</label>
        <input type="text" name="agama" value="{{ $profile->agama }}"
            class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
    </div>
    <div class="mb-4">
        <label>Nomor Telepon</label>
        <input type="text" name="nomor_telepon" value="{{ $profile->nomor_telepon }}"
            class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
    </div>
    <div class="mb-4">
        <label>Alamat Domisili</label>
        <textarea name="alamat_domisili"
            class="w-full p-2 bg-gray-800 border border-gray-600 rounded">{{ $profile->alamat_domisili }}</textarea>
    </div>
    <div class="mb-4">
        <label>Email Pribadi</label>
        <input type="email" name="email_pribadi" value="{{ $profile->email_pribadi }}"
            class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
    </div>
    <div class="mb-4">
        <label>Foto Profil</label>
        <input type="file" name="foto_profil" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
        @if($profile->foto_profil)
            <img src="{{ asset('storage/' . $profile->foto_profil) }}" alt="Foto Profil"
                class="mt-2 w-32 h-32 object-cover">
        @endif
    </div>
    <button type="button" class="save-profile bg-yellow-600 text-black py-2 px-4 rounded">Simpan</button>
</form>