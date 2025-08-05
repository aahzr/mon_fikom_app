<h2 class="text-xl font-semibold mb-4">Jabatan Fungsional</h2>
  <form action="{{ route('profile.jabatan-fungsional.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-4">
          <label>Jabatan Terakhir</label>
          <input type="text" name="jabatan_terakhir" value="{{ $profile->jabatan_terakhir }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
      </div>
      <div class="mb-4">
          <label>Nomor SK Jabfung</label>
          <input type="text" name="nomor_sk_jabfung" value="{{ $profile->nomor_sk_jabfung }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
      </div>
      <div class="mb-4">
          <label>Tanggal SK Jabfung</label>
          <input type="date" name="tanggal_sk_jabfung" value="{{ $profile->tanggal_sk_jabfung }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
      </div>
      <div class="mb-4">
          <label>Masa Berlaku</label>
          <input type="date" name="masa_berlaku" value="{{ $profile->masa_berlaku }}" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
      </div>
      <div class="mb-4">
          <label>File SK Jabfung</label>
          <input type="file" name="file_sk_jabfung" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
          @if($profile->file_sk_jabfung)
              <a href="{{ asset('storage/' . $profile->file_sk_jabfung) }}" target="_blank" class="mt-2 inline-block">Lihat File</a>
          @endif
      </div>
      <button type="button" class="save-profile bg-yellow-600 text-black py-2 px-4 rounded">Simpan</button>
  </form>