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
        <aside class="sidebar fixed top-16 bottom-0 left-0 overflow-y-auto hidden md:block">
            <div class="p-6">
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
                    </ul>
                </div>
            </div>
            <div class="mt-auto absolute bottom-4 w-full px-6">
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

            function resetForm(formId) {
                const form = $(`#${formId}`);
                form[0].reset();
                form.find('input[name="id"]').val('');
                form.find('input[name="_method"]').val('');
                form.find('.text-red-500').text('');
                form.find('.border-red-500').removeClass('border-red-500');
                // Hapus tautan file yang ada saat reset form
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

            // AJAX content loading for profile and kualifikasi sections
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
            
            // Logika untuk Pendidikan Formal
            $(document).on('click', '#add-pendidikan-btn', function() {
                showModal('pendidikan-modal', 'pendidikan-form', 'Tambah Data Pendidikan Formal');
            });
            $(document).on('click', '#close-modal-btn', function() {
                closeModal('pendidikan-modal');
            });

            // Perbaikan bug: Tombol edit tidak bisa ditekan
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
                    
                    // Tampilkan link file jika ada
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
            $(document).on('click', '#close-diklat-modal-btn', function() {
                closeModal('diklat-modal');
            });

            // Perbaikan bug: Modal muncul kosong
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
                    
                    // Tampilkan link file jika ada
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
            $(document).on('click', '#close-riwayat-pekerjaan-modal-btn', function() {
                closeModal('riwayat-pekerjaan-modal');
            });

            // Perbaikan bug: Modal muncul kosong
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
                    
                    // Tampilkan link file jika ada
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

            // Handler untuk semua form submit kualifikasi
            $(document).on('submit', '#pendidikan-form, #diklat-form, #riwayat-pekerjaan-form', function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var formData = new FormData(form[0]);
                var modalId = form.closest('.fixed').attr('id');
                var section = form.attr('id').replace('-form', '');
                
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
                            var activeLink = $('.kualifikasi-link.active');
                            var target = activeLink.data('target') || 'pendidikan-formal';
                            var newUrl = '{{ route('kualifikasi.section', ['section' => ':section']) }}'.replace(':section', target);
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
                                    var activeLink = $('.kualifikasi-link.active');
                                    var target = activeLink.data('target') || 'pendidikan-formal';
                                    var newUrl = '{{ route('kualifikasi.section', ['section' => ':section']) }}'.replace(':section', target);
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