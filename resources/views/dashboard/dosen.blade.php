@extends('layouts.app')

     @section('title', 'Dashboard Dosen')

     @section('content')
         <h1 class="text-3xl font-bold mb-6 text-yellow-400">Selamat Datang, {{ Auth::user()->name }}</h1>
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
             <div class="bg-gray-800 p-4 rounded-lg shadow-lg">
                 <h2 class="text-xl font-semibold mb-2">Profil</h2>
                 <p>NIP: {{ $profile->nip }}</p>
                 <p>Nama: {{ $profile->nama }}</p>
                 <p>Jabatan: {{ $profile->jabatan }}</p>
                 <p>Pangkat: {{ $profile->pangkat }}</p>
                 <p>Penempatan: {{ $profile->penempatan }}</p>
             </div>
             <div class="bg-gray-800 p-4 rounded-lg shadow-lg">
                 <h2 class="text-xl font-semibold mb-2">Input Proposal</h2>
                 <form action="{{ route('store.proposal') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <input type="text" name="judul" class="w-full p-2 mb-2 bg-gray-700 rounded" placeholder="Judul" required>
                     <textarea name="deskripsi" class="w-full p-2 mb-2 bg-gray-700 rounded" placeholder="Deskripsi" required></textarea>
                     <input type="file" name="file" class="w-full p-2 mb-2 bg-gray-700 rounded">
                     <button type="submit" class="bg-yellow-600 p-2 rounded text-white">Simpan</button>
                 </form>
                 @foreach ($proposals as $proposal)
                     <p>{{ $proposal->judul }} - {{ $proposal->status }}</p>
                 @endforeach
             </div>
             <div class="bg-gray-800 p-4 rounded-lg shadow-lg">
                 <h2 class="text-xl font-semibold mb-2">Input Laporan</h2>
                 <form action="{{ route('store.laporan') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <input type="text" name="judul" class="w-full p-2 mb-2 bg-gray-700 rounded" placeholder="Judul" required>
                     <textarea name="deskripsi" class="w-full p-2 mb-2 bg-gray-700 rounded" placeholder="Deskripsi" required></textarea>
                     <input type="file" name="file" class="w-full p-2 mb-2 bg-gray-700 rounded">
                     <button type="submit" class="bg-yellow-600 p-2 rounded text-white">Simpan</button>
                 </form>
                 @foreach ($laporans as $laporan)
                     <p>{{ $laporan->judul }} - {{ $laporan->status }}</p>
                 @endforeach
             </div>
             <div class="bg-gray-800 p-4 rounded-lg shadow-lg">
                 <h2 class="text-xl font-semibold mb-2">Input Luaran</h2>
                 <form action="{{ route('store.luaran') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <input type="text" name="judul" class="w-full p-2 mb-2 bg-gray-700 rounded" placeholder="Judul" required>
                     <textarea name="deskripsi" class="w-full p-2 mb-2 bg-gray-700 rounded" placeholder="Deskripsi" required></textarea>
                     <input type="file" name="file" class="w-full p-2 mb-2 bg-gray-700 rounded">
                     <button type="submit" class="bg-yellow-600 p-2 rounded text-white">Simpan</button>
                 </form>
                 @foreach ($luarans as $luaran)
                     <p>{{ $luaran->judul }} - {{ $luaran->status }}</p>
                 @endforeach
             </div>
             <div class="bg-gray-800 p-4 rounded-lg shadow-lg">
                 <h2 class="text-xl font-semibold mb-2">Input Keuangan</h2>
                 <form action="{{ route('store.keuangan') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <input type="text" name="judul" class="w-full p-2 mb-2 bg-gray-700 rounded" placeholder="Judul" required>
                     <input type="number" step="0.01" name="jumlah" class="w-full p-2 mb-2 bg-gray-700 rounded" placeholder="Jumlah" required>
                     <textarea name="deskripsi" class="w-full p-2 mb-2 bg-gray-700 rounded" placeholder="Deskripsi" required></textarea>
                     <input type="file" name="file" class="w-full p-2 mb-2 bg-gray-700 rounded">
                     <button type="submit" class="bg-yellow-600 p-2 rounded text-white">Simpan</button>
                 </form>
                 @foreach ($keuangans as $keuangan)
                     <p>{{ $keuangan->judul }} - Rp {{ number_format($keuangan->jumlah, 2) }} - {{ $keuangan->status }}</p>
                 @endforeach
             </div>
         </div>
     @endsection