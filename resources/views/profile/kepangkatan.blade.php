<h2 class="text-xl font-semibold mb-4">Kepangkatan</h2>
  <form action="{{ route('profile.kepangkatan.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-4">
          <label>Pangkat Terakhir</label>
          <input type="text" name="pangkat_terakhir" value="{{ $profile->pangkat_terakhir }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
      </div>
      <div class="mb-4">
          <label>Golongan Ruang</label>
          <input type="text" name="golongan_ruang" value="{{ $profile->golongan_ruang }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
      </div>
      <div class="mb-4">
          <label>Nomor SK Pangkat</label>
          <input type="text" name="nomor_sk_pangkat" value="{{ $profile->nomor_sk_pangkat }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
      </div>
      <div class="mb-4">
          <label>Tanggal SK Pangkat</label>
          <input type="date" name="tanggal_sk_pangkat" value="{{ $profile->tanggal_sk_pangkat }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
      </div>
      <div class="mb-4">
          <label>Masa Kerja Golongan</label>
          <input type="number" name="masa_kerja_golongan" value="{{ $profile->masa_kerja_golongan }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
      </div>
      <div class="mb-4">
          <label>Instansi Penerbit SK</label>
          <input type="text" name="instansi_sk_pangkat" value="{{ $profile->instansi_sk_pangkat }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
      </div>
      <div class="mb-4">
          <label>File SK Pangkat</label>
          <input type="file" name="file_sk_pangkat" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
          @if($profile->file_sk_pangkat)
              <a href="{{ asset('storage/' . $profile->file_sk_pangkat) }}" target="_blank" class="mt-2 inline-block">Lihat File</a>
          @endif
      </div>
      <button type="button" class="save-profile bg-yellow-600 text-black py-2 px-4 rounded">Simpan</button>
  </form>