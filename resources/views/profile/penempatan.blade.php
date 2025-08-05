<h2 class="text-xl font-semibold mb-4">Penempatan</h2>
  <form action="{{ route('profile.penempatan.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-4">
          <label>Fakultas</label>
          <input type="text" name="fakultas" value="{{ $profile->fakultas }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
      </div>
      <div class="mb-4">
          <label>Program Studi</label>
          <input type="text" name="program_studi" value="{{ $profile->program_studi }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
      </div>
      <div class="mb-4">
          <label>Status Penempatan</label>
          <select name="status_penempatan" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
              <option value="Tetap" {{ $profile->status_penempatan == 'Tetap' ? 'selected' : '' }}>Tetap</option>
              <option value="Tidak Tetap" {{ $profile->status_penempatan == 'Tidak Tetap' ? 'selected' : '' }}>Tidak Tetap</option>
              <option value="Kontrak" {{ $profile->status_penempatan == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
          </select>
      </div>
      <div class="mb-4">
          <label>TMT Penempatan</label>
          <input type="date" name="tmt_penempatan" value="{{ $profile->tmt_penempatan }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
      </div>
      <div class="mb-4">
          <label>Lokasi Kampus</label>
          <input type="text" name="lokasi_kampus" value="{{ $profile->lokasi_kampus }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
      </div>
      <button type="button" class="save-profile bg-yellow-600 text-black py-2 px-4 rounded">Simpan</button>
  </form>