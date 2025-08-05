@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <h1 class="text-2xl font-bold mb-8 text-gray-800">Selamat Datang, {{ $profile->nama_lengkap }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="card p-5 flex items-center space-x-4">
            <div class="flex-shrink-0">
                <i class="fas fa-user-circle text-4xl text-blue-500"></i>
            </div>
            <div>
                <div class="text-gray-500 text-sm">Status Profil</div>
                <div class="text-xl font-bold text-gray-900">Lengkap</div>
                <a href="#" class="profile-link text-blue-600 hover:underline text-sm mt-1 block" data-target="data-pribadi">Lihat Selengkapnya</a>
            </div>
        </div>

        <div class="card p-5 flex items-center space-x-4">
            <div class="flex-shrink-0">
                <i class="fas fa-file-alt text-4xl text-green-500"></i>
            </div>
            <div>
                <div class="text-gray-500 text-sm">Jumlah Proposal</div>
                <div class="text-xl font-bold text-gray-900">{{ $proposals->count() }}</div>
                <span class="text-xs text-gray-500">{{ $proposals->where('status', 'pending')->count() }} menunggu verifikasi</span>
            </div>
        </div>

        <div class="card p-5 flex items-center space-x-4">
            <div class="flex-shrink-0">
                <i class="fas fa-chart-line text-4xl text-yellow-500"></i>
            </div>
            <div>
                <div class="text-gray-500 text-sm">Jumlah Laporan</div>
                <div class="text-xl font-bold text-gray-900">{{ $laporans->count() }}</div>
                <span class="text-xs text-gray-500">{{ $laporans->where('status', 'pending')->count() }} menunggu verifikasi</span>
            </div>
        </div>

        <div class="card p-5 flex items-center space-x-4">
            <div class="flex-shrink-0">
                <i class="fas fa-money-bill-wave text-4xl text-red-500"></i>
            </div>
            <div>
                <div class="text-gray-500 text-sm">Data Keuangan</div>
                <div class="text-xl font-bold text-gray-900">{{ $keuangans->count() }}</div>
                <span class="text-xs text-gray-500">{{ $keuangans->where('status', 'pending')->count() }} menunggu verifikasi</span>
            </div>
        </div>

    </div>

    <div class="mt-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Aktivitas Terakhir</h2>
        <div class="card">
            <ul class="divide-y divide-gray-200">
                @forelse ($proposals->sortByDesc('updated_at')->take(5) as $item)
                    <li class="py-3 flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Proposal "{{ $item->judul }}"</p>
                            <p class="text-xs text-gray-500">Status: {{ $item->status }}</p>
                        </div>
                        <span class="text-xs text-gray-400">{{ $item->updated_at->diffForHumans() }}</span>
                    </li>
                @empty
                    <li class="py-3 text-center text-gray-500">Tidak ada aktivitas terbaru.</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection