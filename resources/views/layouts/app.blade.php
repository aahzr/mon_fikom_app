<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SiMonik - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Gaya Kustom untuk Tampilan Baru */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f5f7f9;
        }

        .header {
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            height: 64px;
        }

        .sidebar {
            background-color: #2a3038;
            color: #d1d8df;
            width: 250px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar-item a {
            transition: all 0.2s ease;
        }

        .sidebar-item a:hover {
            background-color: #3b424d;
            color: #fff;
        }

        .sidebar-item a.active {
            background-color: #007bff;
            color: #fff;
        }
        
        .content-area {
            background-color: #f5f7f9;
        }

        .breadcrumb {
            background-color: #fff;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e0e6ed;
        }
        
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
        }
        
        .btn-primary {
            background-color: #007bff;
            color: #fff;
            transition: background-color 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    @php
        $dosenProfile = Auth::user()->dosenProfile ?? null;
        $profilePhoto = $dosenProfile && $dosenProfile->foto_profil ? asset('storage/' . $dosenProfile->foto_profil) : 'https://via.placeholder.com/150';
        $profileName = $dosenProfile && $dosenProfile->nama_lengkap ? $dosenProfile->nama_lengkap : Auth::user()->name;
    @endphp

    <header class="header fixed top-0 left-0 w-full z-10 flex items-center justify-between px-6">
        <div class="flex items-center">
            <button class="text-gray-600 mr-4 md:hidden">
                <i class="fas fa-bars"></i>
            </button>
            <span class="text-2xl font-semibold text-gray-800">SiMonik</span>
        </div>
        <div class="flex items-center text-gray-700">
            <div class="mr-4 text-sm font-medium" id="header-profile-name">Hi, {{ $profileName }}</div>
            <img class="h-10 w-10 rounded-full object-cover" id="header-profile-photo" src="{{ $profilePhoto }}" alt="Avatar">
        </div>
    </header>

    <div class="flex-1 flex pt-16">
        <aside class="w-64 sidebar fixed top-16 bottom-0 left-0 p-4 flex flex-col justify-between transition-all duration-300">
            <div class="overflow-y-auto flex-1">
                <div class="flex items-center mb-6">
                    <img class="h-12 w-12 rounded-full object-cover mr-3" id="sidebar-profile-photo" src="{{ $profilePhoto }}" alt="Avatar">
                    <div>
                        <div class="text-sm font-semibold text-white" id="sidebar-profile-name">{{ $profileName }}</div>
                        <div class="text-xs text-gray-400">Dosen</div>
                    </div>
                </div>
                <div class="border-t border-gray-600 pt-4">
                    <ul class="space-y-2">
                        <li class="sidebar-item">
                            <a href="{{ route('beranda') }}" class="block p-3 rounded-lg flex items-center {{ request()->routeIs('beranda') ? 'active' : '' }}">
                                <i class="fas fa-home fa-fw mr-3"></i>
                                <span>Beranda</span>
                            </a>
                        </li>
                        <li class="sidebar-item relative">
                            <button id="profileDropdown" class="w-full text-left p-3 rounded-lg flex justify-between items-center {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                                <div><i class="fas fa-user fa-fw mr-3"></i><span>Profil</span></div>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
                            </button>
                            <ul id="profileSubmenu" class="hidden pl-8 space-y-2 mt-2 text-sm">
                                <li><a href="#" class="profile-link block p-2 rounded-lg hover:bg-gray-700" data-target="data-pribadi">Data Pribadi</a></li>
                                <li><a href="#" class="profile-link block p-2 rounded-lg hover:bg-gray-700" data-target="inpassing">Inpassing</a></li>
                                <li><a href="#" class="profile-link block p-2 rounded-lg hover:bg-gray-700" data-target="jabatan-fungsional">Jabatan Fungsional</a></li>
                                <li><a href="#" class="profile-link block p-2 rounded-lg hover:bg-gray-700" data-target="kepangkatan">Kepangkatan</a></li>
                                <li><a href="#" class="profile-link block p-2 rounded-lg hover:bg-gray-700" data-target="penempatan">Penempatan</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item relative">
                            <button id="kualifikasiDropdown" class="w-full text-left p-3 rounded-lg flex justify-between items-center {{ request()->routeIs('kualifikasi.*') ? 'active' : '' }}">
                                <div><i class="fas fa-graduation-cap fa-fw mr-3"></i><span>Kualifikasi</span></div>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
                            </button>
                            <ul id="kualifikasiSubmenu" class="hidden pl-8 space-y-2 mt-2 text-sm">
                                <li><a href="#" class="kualifikasi-link block p-2 rounded-lg hover:bg-gray-700" data-target="pendidikan-formal">Pendidikan Formal</a></li>
                                <li><a href="#" class="kualifikasi-link block p-2 rounded-lg hover:bg-gray-700" data-target="diklat">Diklat</a></li>
                                <li><a href="#" class="kualifikasi-link block p-2 rounded-lg hover:bg-gray-700" data-target="riwayat-pekerjaan">Riwayat Pekerjaan</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item relative">
                            <button id="pelaksanaanPendidikanDropdown" class="w-full text-left p-3 rounded-lg flex justify-between items-center {{ request()->routeIs('pelaksanaan-pendidikan.*') ? 'active' : '' }}">
                                <div><i class="fas fa-book fa-fw mr-3"></i><span>Pelaksanaan Pendidikan</span></div>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
                            </button>
                            <ul id="pelaksanaanPendidikanSubmenu" class="hidden pl-8 space-y-2 mt-2 text-sm">
                                <li><a href="#" class="pelaksanaan-pendidikan-link block p-2 rounded-lg hover:bg-gray-700" data-target="pengajaran">Pengajaran</a></li>
                                <li><a href="#" class="pelaksanaan-pendidikan-link block p-2 rounded-lg hover:bg-gray-700" data-target="bimbingan-mahasiswa">Bimbingan Mahasiswa</a></li>
                                <li><a href="#" class="pelaksanaan-pendidikan-link block p-2 rounded-lg hover:bg-gray-700" data-target="pengujian-mahasiswa">Pengujian Mahasiswa</a></li>
                                <li><a href="#" class="pelaksanaan-pendidikan-link block p-2 rounded-lg hover:bg-gray-700" data-target="bahan-ajar">Bahan Ajar</a></li>
                                <li><a href="#" class="pelaksanaan-pendidikan-link block p-2 rounded-lg hover:bg-gray-700" data-target="pembinaan-mahasiswa">Pembinaan Mahasiswa</a></li>
                                <li><a href="#" class="pelaksanaan-pendidikan-link block p-2 rounded-lg hover:bg-gray-700" data-target="visiting-scientist">Visiting Scientist</a></li>
                                <li><a href="#" class="pelaksanaan-pendidikan-link block p-2 rounded-lg hover:bg-gray-700" data-target="detasering">Detasering</a></li>
                                <li><a href="#" class="pelaksanaan-pendidikan-link block p-2 rounded-lg hover:bg-gray-700" data-target="orasi-ilmiah">Orasi Ilmiah</a></li>
                                <li><a href="#" class="pelaksanaan-pendidikan-link block p-2 rounded-lg hover:bg-gray-700" data-target="pembimbing-dosen">Pembimbing Dosen</a></li>
                                <li><a href="#" class="pelaksanaan-pendidikan-link block p-2 rounded-lg hover:bg-gray-700" data-target="tugas-tambahan">Tugas Tambahan</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="p-4 mt-auto">
                <a href="{{ route('logout') }}" class="block p-3 rounded-lg text-red-400 hover:bg-gray-700 flex items-center"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-fw mr-3"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>

        <main class="flex-1 ml-64 transition-all duration-300 content-area min-h-screen">
            <div class="breadcrumb flex items-center space-x-2 text-sm text-gray-500">
                <a href="{{ route('beranda') }}" class="hover:text-gray-700">Home</a>
                <span>/</span>
                <span class="text-gray-800 font-medium" id="page-title">@yield('title')</span>
            </div>
            <div class="p-6" id="dynamic-content-area">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        $(document).ready(function () {
            // Dropdown menu toggle
            $('#profileDropdown').click(function () {
                $('#profileSubmenu').toggleClass('hidden');
                $(this).find('i.fa-chevron-down').toggleClass('rotate-180');
            });
            
            $('#kualifikasiDropdown').click(function () {
                $('#kualifikasiSubmenu').toggleClass('hidden');
                $(this).find('i.fa-chevron-down').toggleClass('rotate-180');
            });

            $('#pelaksanaanPendidikanDropdown').click(function () {
                $('#pelaksanaanPendidikanSubmenu').toggleClass('hidden');
                $(this).find('i.fa-chevron-down').toggleClass('rotate-180');
            });

            function resetForm(formId) {
                const form = $(`#${formId}`);
                form[0].reset();
                form.find('input[name="id"]').val('');
                form.find('input[name="_method"]').val('');
                form.find('.text-red-500').text('');
                form.find('.border-red-500').removeClass('border-red-500');
                form.find('.existing-file-link').html('');
            }
            
            function showModal(modalId, formId, title) {
                $(`#${modalId}`).removeClass('hidden');
                $(`#${modalId} #modal-title`).text(title);
                resetForm(formId);
            }
            
            function closeModal(modalId) {
                $(`#${modalId}`).addClass('hidden');
            }

            function loadSection(url, newTitle) {
                $.get(url, function (data) {
                    $('#dynamic-content-area').html(data);
                    $('#page-title').text(newTitle);
                }).fail(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Memuat',
                        text: 'Terjadi kesalahan saat memuat konten.',
                        confirmButtonText: 'OK'
                    });
                });
            }
            
            $('.profile-link').click(function (e) {
                e.preventDefault();
                $('.profile-link').removeClass('active');
                $(this).addClass('active');
                var target = $(this).data('target');
                var url = '{{ route('profile.section', ['section' => ':section']) }}'.replace(':section', target);
                var newTitle = $(this).text().trim();
                loadSection(url, newTitle);
            });

            $('.kualifikasi-link').click(function (e) {
                e.preventDefault();
                $('.kualifikasi-link').removeClass('active');
                $(this).addClass('active');
                var target = $(this).data('target');
                var url = '{{ route('kualifikasi.section', ['section' => ':section']) }}'.replace(':section', target);
                var newTitle = $(this).text().trim();
                loadSection(url, newTitle);
            });
            
            $('.pelaksanaan-pendidikan-link').click(function (e) {
                e.preventDefault();
                $('.pelaksanaan-pendidikan-link').removeClass('active');
                $(this).addClass('active');
                var target = $(this).data('target');
                var url = '{{ route('pelaksanaan-pendidikan.section', ['section' => ':section']) }}'.replace(':section', target);
                var newTitle = $(this).text().trim();
                loadSection(url, newTitle);
            });

            // Logika terpusat untuk Tambah Data di Pelaksanaan Pendidikan
            $(document).on('click', '#add-pengajaran-btn', function() {
                showModal('pengajaran-modal', 'pengajaran-form', 'Tambah Data Pengajaran');
            });
            $(document).on('click', '#add-bimbingan-btn', function() {
                showModal('bimbingan-modal', 'bimbingan-form', 'Tambah Data Bimbingan Mahasiswa');
            });
            $(document).on('click', '#add-pengujian-btn', function() {
                showModal('pengujian-modal', 'pengujian-form', 'Tambah Data Pengujian Mahasiswa');
            });
            $(document).on('click', '#add-bahan-ajar-btn', function() {
                showModal('bahan-ajar-modal', 'bahan-ajar-form', 'Tambah Data Bahan Ajar');
            });
            $(document).on('click', '#add-pembinaan-btn', function() {
                showModal('pembinaan-modal', 'pembinaan-form', 'Tambah Data Pembinaan Mahasiswa');
            });
            $(document).on('click', '#add-visiting-scientist-btn', function() {
                showModal('visiting-scientist-modal', 'visiting-scientist-form', 'Tambah Data Visiting Scientist');
            });
            $(document).on('click', '#add-detasering-btn', function() {
                showModal('detasering-modal', 'detasering-form', 'Tambah Data Detasering');
            });
            $(document).on('click', '#add-orasi-ilmiah-btn', function() {
                showModal('orasi-ilmiah-modal', 'orasi-ilmiah-form', 'Tambah Data Orasi Ilmiah');
            });
            $(document).on('click', '#add-pembimbing-dosen-btn', function() {
                showModal('pembimbing-dosen-modal', 'pembimbing-dosen-form', 'Tambah Data Pembimbingan Dosen');
            });
            $(document).on('click', '#add-tugas-tambahan-btn', function() {
                showModal('tugas-tambahan-modal', 'tugas-tambahan-form', 'Tambah Data Tugas Tambahan');
            });
            
            $(document).on('click', '#close-modal-btn', function() {
                closeModal('pendidikan-modal');
            });
            $(document).on('click', '#close-diklat-modal-btn', function() {
                closeModal('diklat-modal');
            });
            $(document).on('click', '#close-riwayat-pekerjaan-modal-btn', function() {
                closeModal('riwayat-pekerjaan-modal');
            });
            $(document).on('click', '#close-pengajaran-modal-btn', function() {
                closeModal('pengajaran-modal');
            });
            $(document).on('click', '#close-bimbingan-modal-btn', function() {
                closeModal('bimbingan-modal');
            });
            $(document).on('click', '#close-pengujian-modal-btn', function() {
                closeModal('pengujian-modal');
            });
            $(document).on('click', '#close-bahan-ajar-modal-btn', function() {
                closeModal('bahan-ajar-modal');
            });
            $(document).on('click', '#close-pembinaan-modal-btn', function() {
                closeModal('pembinaan-modal');
            });
            $(document).on('click', '#close-visiting-scientist-modal-btn', function() {
                closeModal('visiting-scientist-modal');
            });
            $(document).on('click', '#close-detasering-modal-btn', function() {
                closeModal('detasering-modal');
            });
            $(document).on('click', '#close-orasi-ilmiah-modal-btn', function() {
                closeModal('orasi-ilmiah-modal');
            });
            $(document).on('click', '#close-pembimbing-dosen-modal-btn', function() {
                closeModal('pembimbing-dosen-modal');
            });
            $(document).on('click', '#close-tugas-tambahan-modal-btn', function() {
                closeModal('tugas-tambahan-modal');
            });


            // Logika untuk Pendidikan Formal
            $(document).on('click', '.edit-pendidikan-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('kualifikasi.pendidikan-formal.edit', ['id' => ':id']) }}'.replace(':id', id);
                
                $.get(url, function(data) {
                    resetForm('pendidikan-form');
                    $('#pendidikan-form #modal-title').text('Edit Data Pendidikan Formal');
                    $('#pendidikan-form').attr('action', '{{ route('kualifikasi.pendidikan-formal.update', ['id' => ':id']) }}'.replace(':id', id));
                    $('#pendidikan-form #pendidikan-method').val('PUT');

                    for (var key in data) {
                        var input = $(`#pendidikan-form #${key}`);
                        if (input.length && input.attr('type') !== 'file') {
                            input.val(data[key]);
                        }
                    }
                    if (data.file_scan_ijazah) {
                        var fileUrl = '{{ asset('storage/') }}' + '/' + data.file_scan_ijazah;
                        var link = $('<a>').attr('href', fileUrl).attr('target', '_blank').text('Lihat File Ijazah');
                        $('#existing-file-link-ijazah').html(link);
                    }
                    $('#pendidikan-modal').removeClass('hidden');
                }).fail(function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.message ?? 'Gagal mengambil data.', 'error');
                });
            });

            $(document).on('click', '.delete-pendidikan-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('kualifikasi.pendidikan-formal.delete', ['id' => ':id']) }}'.replace(':id', id);
                handleDelete(url);
            });
            
            // Logika untuk Diklat
            $(document).on('click', '#add-diklat-btn', function() {
                showModal('diklat-modal', 'diklat-form', 'Tambah Data Diklat');
            });
            $(document).on('click', '.edit-diklat-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('kualifikasi.diklat.edit', ['id' => ':id']) }}'.replace(':id', id);
                
                $.get(url, function(data) {
                    resetForm('diklat-form');
                    $('#diklat-form #modal-title').text('Edit Data Diklat');
                    $('#diklat-form').attr('action', '{{ route('kualifikasi.diklat.update', ['id' => ':id']) }}'.replace(':id', id));
                    $('#diklat-form #diklat-method').val('PUT');

                    for (var key in data) {
                        var input = $(`#diklat-form #${key}`);
                        if (input.length && input.attr('type') !== 'file') {
                            input.val(data[key]);
                        }
                    }
                    if (data.sertifikat) {
                        var fileUrl = '{{ asset('storage/') }}' + '/' + data.sertifikat;
                        var link = $('<a>').attr('href', fileUrl).attr('target', '_blank').text('Lihat File Sertifikat');
                        $('#existing-file-link-sertifikat').html(link);
                    }
                    $('#diklat-modal').removeClass('hidden');
                }).fail(function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.message ?? 'Gagal mengambil data.', 'error');
                });
            });

            $(document).on('click', '.delete-diklat-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('kualifikasi.diklat.delete', ['id' => ':id']) }}'.replace(':id', id);
                handleDelete(url);
            });

            // Logika untuk Riwayat Pekerjaan
            $(document).on('click', '#add-riwayat-pekerjaan-btn', function() {
                showModal('riwayat-pekerjaan-modal', 'riwayat-pekerjaan-form', 'Tambah Data Riwayat Pekerjaan');
            });
            $(document).on('click', '.edit-riwayat-pekerjaan-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('kualifikasi.riwayat-pekerjaan.edit', ['id' => ':id']) }}'.replace(':id', id);
                
                $.get(url, function(data) {
                    resetForm('riwayat-pekerjaan-form');
                    $('#riwayat-pekerjaan-form #modal-title').text('Edit Data Riwayat Pekerjaan');
                    $('#riwayat-pekerjaan-form').attr('action', '{{ route('kualifikasi.riwayat-pekerjaan.update', ['id' => ':id']) }}'.replace(':id', id));
                    $('#riwayat-pekerjaan-form #riwayat-pekerjaan-method').val('PUT');

                    for (var key in data) {
                        var input = $(`#riwayat-pekerjaan-form #${key}`);
                        if (input.length && input.attr('type') !== 'file') {
                            input.val(data[key]);
                        }
                    }
                    if (data.surat_keterangan) {
                        var fileUrl = '{{ asset('storage/') }}' + '/' + data.surat_keterangan;
                        var link = $('<a>').attr('href', fileUrl).attr('target', '_blank').text('Lihat Surat Keterangan');
                        $('#existing-file-link-surat').html(link);
                    }
                    $('#riwayat-pekerjaan-modal').removeClass('hidden');
                }).fail(function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.message ?? 'Gagal mengambil data.', 'error');
                });
            });

            $(document).on('click', '.delete-riwayat-pekerjaan-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('kualifikasi.riwayat-pekerjaan.delete', ['id' => ':id']) }}'.replace(':id', id);
                handleDelete(url);
            });

            // Logika untuk Pengajaran
            $(document).on('click', '#add-pengajaran-btn', function() {
                showModal('pengajaran-modal', 'pengajaran-form', 'Tambah Data Pengajaran');
            });
            $(document).on('click', '.edit-pengajaran-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.pengajaran.edit', ['id' => ':id']) }}'.replace(':id', id);
                $.get(url, function(data) {
                    resetForm('pengajaran-form');
                    $('#pengajaran-form #modal-title').text('Edit Data Pengajaran');
                    $('#pengajaran-form').attr('action', '{{ route('pelaksanaan-pendidikan.pengajaran.update', ['id' => ':id']) }}'.replace(':id', id));
                    $('#pengajaran-form #pengajaran-method').val('PUT');

                    for (var key in data) {
                        var input = $(`#pengajaran-form #${key}`);
                        if (input.length && input.attr('type') !== 'file') {
                            input.val(data[key]);
                        }
                    }
                    if (data.rps_file) {
                        var fileUrl = '{{ asset('storage/') }}' + '/' + data.rps_file;
                        var link = $('<a>').attr('href', fileUrl).attr('target', '_blank').text('Lihat File RPS');
                        $('#existing-rps-link').html(link);
                    }
                    if (data.bukti_kehadiran_file) {
                        var fileUrl = '{{ asset('storage/') }}' + '/' + data.bukti_kehadiran_file;
                        var link = $('<a>').attr('href', fileUrl).attr('target', '_blank').text('Lihat Bukti Kehadiran');
                        $('#existing-kehadiran-link').html(link);
                    }
                    $('#pengajaran-modal').removeClass('hidden');
                }).fail(function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.message ?? 'Gagal mengambil data.', 'error');
                });
            });
            $(document).on('click', '.delete-pengajaran-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.pengajaran.delete', ['id' => ':id']) }}'.replace(':id', id);
                handleDelete(url);
            });

            // Logika untuk Bimbingan Mahasiswa
            $(document).on('click', '#add-bimbingan-btn', function() {
                showModal('bimbingan-modal', 'bimbingan-form', 'Tambah Data Bimbingan Mahasiswa');
            });
            $(document).on('click', '#close-bimbingan-modal-btn', function() {
                closeModal('bimbingan-modal');
            });
            $(document).on('click', '.edit-bimbingan-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.bimbingan-mahasiswa.edit', ['id' => ':id']) }}'.replace(':id', id);
                $.get(url, function(data) {
                    resetForm('bimbingan-form');
                    $('#bimbingan-form #modal-title').text('Edit Data Bimbingan Mahasiswa');
                    $('#bimbingan-form').attr('action', '{{ route('pelaksanaan-pendidikan.bimbingan-mahasiswa.update', ['id' => ':id']) }}'.replace(':id', id));
                    $('#bimbingan-form #bimbingan-method').val('PUT');

                    for (var key in data) {
                        var input = $(`#bimbingan-form #${key}`);
                        if (input.length && input.attr('type') !== 'file') {
                            input.val(data[key]);
                        }
                    }
                    if (data.bukti_bimbingan_file) {
                        var fileUrl = '{{ asset('storage/') }}' + '/' + data.bukti_bimbingan_file;
                        var link = $('<a>').attr('href', fileUrl).attr('target', '_blank').text('Lihat Bukti Bimbingan');
                        $('#existing-bimbingan-file-link').html(link);
                    }
                    $('#bimbingan-modal').removeClass('hidden');
                }).fail(function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.message ?? 'Gagal mengambil data.', 'error');
                });
            });
            $(document).on('click', '.delete-bimbingan-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.bimbingan-mahasiswa.delete', ['id' => ':id']) }}'.replace(':id', id);
                handleDelete(url);
            });

            // Logika untuk Pengujian Mahasiswa
            $(document).on('click', '#add-pengujian-btn', function() {
                showModal('pengujian-modal', 'pengujian-form', 'Tambah Data Pengujian Mahasiswa');
            });
            $(document).on('click', '#close-pengujian-modal-btn', function() {
                closeModal('pengujian-modal');
            });
            $(document).on('click', '.edit-pengujian-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.pengujian-mahasiswa.edit', ['id' => ':id']) }}'.replace(':id', id);
                $.get(url, function(data) {
                    resetForm('pengujian-form');
                    $('#pengujian-form #modal-title').text('Edit Data Pengujian Mahasiswa');
                    $('#pengujian-form').attr('action', '{{ route('pelaksanaan-pendidikan.pengujian-mahasiswa.update', ['id' => ':id']) }}'.replace(':id', id));
                    $('#pengujian-form #pengujian-method').val('PUT');

                    for (var key in data) {
                        var input = $(`#pengujian-form #${key}`);
                        if (input.length && input.attr('type') !== 'file') {
                            input.val(data[key]);
                        }
                    }
                    if (data.bukti_kehadiran_file) {
                        var fileUrl = '{{ asset('storage/') }}' + '/' + data.bukti_kehadiran_file;
                        var link = $('<a>').attr('href', fileUrl).attr('target', '_blank').text('Lihat Bukti Kehadiran');
                        $('#existing-pengujian-file-link').html(link);
                    }
                    $('#pengujian-modal').removeClass('hidden');
                }).fail(function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.message ?? 'Gagal mengambil data.', 'error');
                });
            });
            $(document).on('click', '.delete-pengujian-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.pengujian-mahasiswa.delete', ['id' => ':id']) }}'.replace(':id', id);
                handleDelete(url);
            });
            
            // Logika untuk Bahan Ajar
            $(document).on('click', '#add-bahan-ajar-btn', function() {
                showModal('bahan-ajar-modal', 'bahan-ajar-form', 'Tambah Data Bahan Ajar');
            });
            $(document).on('click', '#close-bahan-ajar-modal-btn', function() {
                closeModal('bahan-ajar-modal');
            });
            $(document).on('click', '.edit-bahan-ajar-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.bahan-ajar.edit', ['id' => ':id']) }}'.replace(':id', id);
                $.get(url, function(data) {
                    resetForm('bahan-ajar-form');
                    $('#bahan-ajar-form #modal-title').text('Edit Data Bahan Ajar');
                    $('#bahan-ajar-form').attr('action', '{{ route('pelaksanaan-pendidikan.bahan-ajar.update', ['id' => ':id']) }}'.replace(':id', id));
                    $('#bahan-ajar-form #bahan-ajar-method').val('PUT');

                    for (var key in data) {
                        var input = $(`#bahan-ajar-form #${key}`);
                        if (input.length && input.attr('type') !== 'file') {
                            input.val(data[key]);
                        }
                    }
                    if (data.file_bahan_ajar) {
                        var fileUrl = '{{ asset('storage/') }}' + '/' + data.file_bahan_ajar;
                        var link = $('<a>').attr('href', fileUrl).attr('target', '_blank').text('Lihat File Bahan Ajar');
                        $('#existing-bahan-ajar-link').html(link);
                    }
                    $('#bahan-ajar-modal').removeClass('hidden');
                }).fail(function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.message ?? 'Gagal mengambil data.', 'error');
                });
            });
            $(document).on('click', '.delete-bahan-ajar-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.bahan-ajar.delete', ['id' => ':id']) }}'.replace(':id', id);
                handleDelete(url);
            });

            // Logika untuk Pembinaan Mahasiswa
            $(document).on('click', '#add-pembinaan-btn', function() {
                showModal('pembinaan-modal', 'pembinaan-form', 'Tambah Data Pembinaan Mahasiswa');
            });
            $(document).on('click', '#close-pembinaan-modal-btn', function() {
                closeModal('pembinaan-modal');
            });
            $(document).on('click', '.edit-pembinaan-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.pembinaan-mahasiswa.edit', ['id' => ':id']) }}'.replace(':id', id);
                $.get(url, function(data) {
                    resetForm('pembinaan-form');
                    $('#pembinaan-form #modal-title').text('Edit Data Pembinaan Mahasiswa');
                    $('#pembinaan-form').attr('action', '{{ route('pelaksanaan-pendidikan.pembinaan-mahasiswa.update', ['id' => ':id']) }}'.replace(':id', id));
                    $('#pembinaan-form #pembinaan-method').val('PUT');

                    for (var key in data) {
                        var input = $(`#pembinaan-form #${key}`);
                        if (input.length && input.attr('type') !== 'file') {
                            input.val(data[key]);
                        }
                    }
                    if (data.bukti_dokumentasi_file) {
                        var fileUrl = '{{ asset('storage/') }}' + '/' + data.bukti_dokumentasi_file;
                        var link = $('<a>').attr('href', fileUrl).attr('target', '_blank').text('Lihat Bukti Dokumentasi');
                        $('#existing-pembinaan-file-link').html(link);
                    }
                    $('#pembinaan-modal').removeClass('hidden');
                }).fail(function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.message ?? 'Gagal mengambil data.', 'error');
                });
            });
            $(document).on('click', '.delete-pembinaan-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.pembinaan-mahasiswa.delete', ['id' => ':id']) }}'.replace(':id', id);
                handleDelete(url);
            });
            
            // Logika untuk Visiting Scientist
            $(document).on('click', '#add-visiting-scientist-btn', function() {
                showModal('visiting-scientist-modal', 'visiting-scientist-form', 'Tambah Data Visiting Scientist');
            });
            $(document).on('click', '#close-visiting-scientist-modal-btn', function() {
                closeModal('visiting-scientist-modal');
            });
            $(document).on('click', '.edit-visiting-scientist-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.visiting-scientist.edit', ['id' => ':id']) }}'.replace(':id', id);
                $.get(url, function(data) {
                    resetForm('visiting-scientist-form');
                    $('#visiting-scientist-form #modal-title').text('Edit Data Visiting Scientist');
                    $('#visiting-scientist-form').attr('action', '{{ route('pelaksanaan-pendidikan.visiting-scientist.update', ['id' => ':id']) }}'.replace(':id', id));
                    $('#visiting-scientist-form #visiting-scientist-method').val('PUT');
                    for (var key in data) {
                        var input = $(`#visiting-scientist-form #${key}`);
                        if (input.length && input.attr('type') !== 'file') {
                            input.val(data[key]);
                        }
                    }
                    if (data.surat_tugas_file) {
                        var fileUrl = '{{ asset('storage/') }}' + '/' + data.surat_tugas_file;
                        var link = $('<a>').attr('href', fileUrl).attr('target', '_blank').text('Lihat Surat Tugas');
                        $('#existing-surat-tugas-file-link').html(link);
                    }
                    if (data.bukti_dokumentasi_file) {
                        var fileUrl = '{{ asset('storage/') }}' + '/' + data.bukti_dokumentasi_file;
                        var link = $('<a>').attr('href', fileUrl).attr('target', '_blank').text('Lihat Bukti Dokumentasi');
                        $('#existing-visiting-bukti-file-link').html(link);
                    }
                    $('#visiting-scientist-modal').removeClass('hidden');
                }).fail(function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.message ?? 'Gagal mengambil data.', 'error');
                });
            });
            $(document).on('click', '.delete-visiting-scientist-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.visiting-scientist.delete', ['id' => ':id']) }}'.replace(':id', id);
                handleDelete(url);
            });

            // Logika untuk Detasering
            $(document).on('click', '#add-detasering-btn', function() {
                showModal('detasering-modal', 'detasering-form', 'Tambah Data Detasering');
            });
            $(document).on('click', '#close-detasering-modal-btn', function() {
                closeModal('detasering-modal');
            });
            $(document).on('click', '.edit-detasering-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.detasering.edit', ['id' => ':id']) }}'.replace(':id', id);
                $.get(url, function(data) {
                    resetForm('detasering-form');
                    $('#detasering-form #modal-title').text('Edit Data Detasering');
                    $('#detasering-form').attr('action', '{{ route('pelaksanaan-pendidikan.detasering.update', ['id' => ':id']) }}'.replace(':id', id));
                    $('#detasering-form #detasering-method').val('PUT');
                    for (var key in data) {
                        var input = $(`#detasering-form #${key}`);
                        if (input.length && input.attr('type') !== 'file') {
                            input.val(data[key]);
                        }
                    }
                    if (data.surat_tugas_file) {
                        var fileUrl = '{{ asset('storage/') }}' + '/' + data.surat_tugas_file;
                        var link = $('<a>').attr('href', fileUrl).attr('target', '_blank').text('Lihat Surat Tugas');
                        $('#existing-surat-tugas-link').html(link);
                    }
                    if (data.bukti_kegiatan_file) {
                        var fileUrl = '{{ asset('storage/') }}' + '/' + data.bukti_kegiatan_file;
                        var link = $('<a>').attr('href', fileUrl).attr('target', '_blank').text('Lihat Bukti Kegiatan');
                        $('#existing-bukti-kegiatan-link').html(link);
                    }
                    $('#detasering-modal').removeClass('hidden');
                }).fail(function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.message ?? 'Gagal mengambil data.', 'error');
                });
            });
            $(document).on('click', '.delete-detasering-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.detasering.delete', ['id' => ':id']) }}'.replace(':id', id);
                handleDelete(url);
            });

            // Logika untuk Orasi Ilmiah
            $(document).on('click', '#add-orasi-ilmiah-btn', function() {
                showModal('orasi-ilmiah-modal', 'orasi-ilmiah-form', 'Tambah Data Orasi Ilmiah');
            });
            $(document).on('click', '#close-orasi-ilmiah-modal-btn', function() {
                closeModal('orasi-ilmiah-modal');
            });
            $(document).on('click', '.edit-orasi-ilmiah-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.orasi-ilmiah.edit', ['id' => ':id']) }}'.replace(':id', id);
                $.get(url, function(data) {
                    resetForm('orasi-ilmiah-form');
                    $('#orasi-ilmiah-form #modal-title').text('Edit Data Orasi Ilmiah');
                    $('#orasi-ilmiah-form').attr('action', '{{ route('pelaksanaan-pendidikan.orasi-ilmiah.update', ['id' => ':id']) }}'.replace(':id', id));
                    $('#orasi-ilmiah-form #orasi-ilmiah-method').val('PUT');
                    for (var key in data) {
                        var input = $(`#orasi-ilmiah-form #${key}`);
                        if (input.length && input.attr('type') !== 'file') {
                            input.val(data[key]);
                        }
                    }
                    if (data.materi_file) {
                        var fileUrl = '{{ asset('storage/') }}' + '/' + data.materi_file;
                        var link = $('<a>').attr('href', fileUrl).attr('target', '_blank').text('Lihat File Materi');
                        $('#existing-materi-file-link').html(link);
                    }
                    if (data.bukti_dokumentasi_file) {
                        var fileUrl = '{{ asset('storage/') }}' + '/' + data.bukti_dokumentasi_file;
                        var link = $('<a>').attr('href', fileUrl).attr('target', '_blank').text('Lihat Bukti Dokumentasi');
                        $('#existing-orasi-bukti-file-link').html(link);
                    }
                    $('#orasi-ilmiah-modal').removeClass('hidden');
                }).fail(function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.message ?? 'Gagal mengambil data.', 'error');
                });
            });
            $(document).on('click', '.delete-orasi-ilmiah-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.orasi-ilmiah.delete', ['id' => ':id']) }}'.replace(':id', id);
                handleDelete(url);
            });
            
            // Logika untuk Pembimbing Dosen
            $(document).on('click', '#add-pembimbing-dosen-btn', function() {
                showModal('pembimbing-dosen-modal', 'pembimbing-dosen-form', 'Tambah Data Pembimbingan Dosen');
            });
            $(document).on('click', '#close-pembimbing-dosen-modal-btn', function() {
                closeModal('pembimbing-dosen-modal');
            });
            $(document).on('click', '.edit-pembimbing-dosen-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.pembimbing-dosen.edit', ['id' => ':id']) }}'.replace(':id', id);
                $.get(url, function(data) {
                    resetForm('pembimbing-dosen-form');
                    $('#pembimbing-dosen-form #modal-title').text('Edit Data Pembimbingan Dosen');
                    $('#pembimbing-dosen-form').attr('action', '{{ route('pelaksanaan-pendidikan.pembimbing-dosen.update', ['id' => ':id']) }}'.replace(':id', id));
                    $('#pembimbing-dosen-form #pembimbing-dosen-method').val('PUT');
                    for (var key in data) {
                        var input = $(`#pembimbing-dosen-form #${key}`);
                        if (input.length && input.attr('type') !== 'file') {
                            input.val(data[key]);
                        }
                    }
                    if (data.bukti_pembimbingan_file) {
                        var fileUrl = '{{ asset('storage/') }}' + '/' + data.bukti_pembimbingan_file;
                        var link = $('<a>').attr('href', fileUrl).attr('target', '_blank').text('Lihat Bukti Pembimbingan');
                        $('#existing-pembimbing-dosen-file-link').html(link);
                    }
                    $('#pembimbing-dosen-modal').removeClass('hidden');
                }).fail(function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.message ?? 'Gagal mengambil data.', 'error');
                });
            });
            $(document).on('click', '.delete-pembimbing-dosen-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.pembimbing-dosen.delete', ['id' => ':id']) }}'.replace(':id', id);
                handleDelete(url);
            });

            // Logika untuk Tugas Tambahan
            $(document).on('click', '#add-tugas-tambahan-btn', function() {
                showModal('tugas-tambahan-modal', 'tugas-tambahan-form', 'Tambah Data Tugas Tambahan');
            });
            $(document).on('click', '#close-tugas-tambahan-modal-btn', function() {
                closeModal('tugas-tambahan-modal');
            });
            $(document).on('click', '.edit-tugas-tambahan-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.tugas-tambahan.edit', ['id' => ':id']) }}'.replace(':id', id);
                $.get(url, function(data) {
                    resetForm('tugas-tambahan-form');
                    $('#tugas-tambahan-form #modal-title').text('Edit Data Tugas Tambahan');
                    $('#tugas-tambahan-form').attr('action', '{{ route('pelaksanaan-pendidikan.tugas-tambahan.update', ['id' => ':id']) }}'.replace(':id', id));
                    $('#tugas-tambahan-form #tugas-tambahan-method').val('PUT');
                    for (var key in data) {
                        var input = $(`#tugas-tambahan-form #${key}`);
                        if (input.length && input.attr('type') !== 'file') {
                            input.val(data[key]);
                        }
                    }
                    if (data.sk_file) {
                        var fileUrl = '{{ asset('storage/') }}' + '/' + data.sk_file;
                        var link = $('<a>').attr('href', fileUrl).attr('target', '_blank').text('Lihat File SK');
                        $('#existing-sk-file-link').html(link);
                    }
                    $('#tugas-tambahan-modal').removeClass('hidden');
                }).fail(function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.message ?? 'Gagal mengambil data.', 'error');
                });
            });
            $(document).on('click', '.delete-tugas-tambahan-btn', function() {
                var id = $(this).closest('tr').data('id');
                var url = '{{ route('pelaksanaan-pendidikan.tugas-tambahan.delete', ['id' => ':id']) }}'.replace(':id', id);
                handleDelete(url);
            });

            // Event handler untuk SAVE-PROFILE
            $(document).on('click', '.save-profile', function (e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var url = form.attr('action');
                var formData = new FormData(form[0]);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.fire('Sukses!', response.message, 'success').then(() => {
                            window.location.reload();
                        });
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            form.find('.text-red-500').text('');
                            form.find('input, textarea, select').removeClass('border-red-500');
                            $.each(errors, function(key, value) {
                                form.find(`#error-${key}`).text(value[0]);
                                form.find(`[name="${key}"]`).addClass('border-red-500');
                            });
                            Swal.fire('Gagal!', 'Ada kesalahan validasi pada form.', 'error');
                        } else {
                            Swal.fire('Gagal!', xhr.responseJSON?.message ?? 'Terjadi kesalahan.', 'error');
                        }
                    }
                });
            });

            // Handler untuk semua form submit
            $(document).on('submit', '#pendidikan-form, #diklat-form, #riwayat-pekerjaan-form, #pengajaran-form, #bimbingan-form, #pengujian-form, #bahan-ajar-form, #pembinaan-form, #visiting-scientist-form, #detasering-form, #orasi-ilmiah-form, #pembimbing-dosen-form, #tugas-tambahan-form', function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var formData = new FormData(form[0]);
                var modalId = form.closest('.fixed').attr('id');
                
                if (form.find('input[name="_method"]').val() === 'PUT') {
                    formData.append('_method', 'PUT');
                }

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire('Sukses!', response.message, 'success').then(() => {
                            closeModal(modalId);
                            var activeLink = $('.kualifikasi-link.active, .pelaksanaan-pendidikan-link.active');
                            var target = activeLink.data('target');
                            var newUrl = '';
                            if (activeLink.hasClass('kualifikasi-link')) {
                                newUrl = '{{ route('kualifikasi.section', ['section' => ':section']) }}'.replace(':section', target);
                            } else {
                                newUrl = '{{ route('pelaksanaan-pendidikan.section', ['section' => ':section']) }}'.replace(':section', target);
                            }
                            var newTitle = activeLink.text().trim();
                            loadSection(newUrl, newTitle);
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            form.find('.text-red-500').text('');
                            form.find('input, textarea, select').removeClass('border-red-500');
                            $.each(errors, function(key, value) {
                                form.find(`#error-${key}`).text(value[0]);
                                form.find(`[name="${key}"]`).addClass('border-red-500');
                            });
                            Swal.fire('Gagal!', 'Ada kesalahan validasi pada form.', 'error');
                        } else {
                            Swal.fire('Gagal!', xhr.responseJSON?.message ?? 'Terjadi kesalahan.', 'error');
                        }
                    }
                });
            });

            function handleDelete(deleteUrl) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire('Dihapus!', response.message, 'success').then(() => {
                                    var activeLink = $('.kualifikasi-link.active, .pelaksanaan-pendidikan-link.active');
                                    var target = activeLink.data('target');
                                    var newUrl = '';
                                    if (activeLink.hasClass('kualifikasi-link')) {
                                        newUrl = '{{ route('kualifikasi.section', ['section' => ':section']) }}'.replace(':section', target);
                                    } else {
                                        newUrl = '{{ route('pelaksanaan-pendidikan.section', ['section' => ':section']) }}'.replace(':section', target);
                                    }
                                    var newTitle = activeLink.text().trim();
                                    loadSection(newUrl, newTitle);
                                });
                            },
                            error: function(xhr) {
                                Swal.fire('Gagal!', xhr.responseJSON?.message ?? 'Terjadi kesalahan.', 'error');
                            }
                        });
                    }
                });
            }
        });
    </script>
</body>
</html>