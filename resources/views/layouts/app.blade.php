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
                    <img class="h-12 w-12 rounded-full mr-3 object-cover" id="sidebar-profile-photo" src="{{ $profilePhoto }}" alt="Avatar">
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
                            <button id="profileDropdown" class="w-full text-left p-3 rounded-lg flex justify-between items-center">
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
                        <li class="sidebar-item">
                            <a href="{{ route('logout') }}" class="block p-3 rounded-lg text-red-400 hover:bg-gray-700 flex items-center"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-fw mr-3"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        <main class="flex-1 ml-0 md:ml-64 transition-all duration-300 content-area min-h-screen">
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

            // AJAX content loading for profile sections
            function loadProfileSection(target) {
                var url = '{{ route('profile.section', ['section' => ':section']) }}'.replace(':section', target);
                var newTitle = $(`[data-target="${target}"]`).text().trim();

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
                loadProfileSection($(this).data('target'));
            });

            // Event handler untuk SAVE-PROFILE
            $(document).on('click', '.save-profile', function (e) {
                e.preventDefault();
                console.log('Save button clicked');

                var form = $(this).closest('form');
                if (!form.length) {
                    console.log('No form found');
                    return;
                }

                var url = form.attr('action');
                var formData = new FormData(form[0]);
                console.log('Preparing AJAX to:', url);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        console.log('AJAX starting...');
                    },
                    success: function (response) {
                        console.log('AJAX success:', response);
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: response.message,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            console.log('Response success false:', response);
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: xhr.responseJSON?.message ?? 'Terjadi kesalahan.',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function (xhr) {
                        console.log('AJAX error:', xhr.status, xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: xhr.responseJSON?.message ?? 'Terjadi kesalahan.',
                            confirmButtonText: 'OK'
                        });
                    },
                    complete: function () {
                        console.log('AJAX completed');
                    }
                });
            });
        });
    </script>
</body>
</html>