<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoring Dosen - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-900 text-white flex">
    <aside class="w-64 bg-gray-800 p-4 h-screen fixed">
        <h2 class="text-xl font-bold mb-4 text-center">Menu</h2>
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="block py-2 px-4 hover:bg-yellow-600 rounded {{ request()->routeIs('dashboard') ? 'bg-yellow-600' : '' }}">Dashboard</a>
            </li>
            <li class="relative">
                <button id="profileDropdown"
                    class="w-full text-left py-2 px-4 hover:bg-yellow-600 rounded flex justify-between items-center {{ request()->routeIs('profile.*') ? 'bg-yellow-600' : '' }}">
                    Profil
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <ul id="profileSubmenu" class="hidden pl-4 space-y-2 mt-2">
                    <li><a href="#" class="block py-2 px-4 hover:bg-yellow-600 rounded" data-target="data-pribadi">Data
                            Pribadi</a></li>
                    <li><a href="#" class="block py-2 px-4 hover:bg-yellow-600 rounded"
                            data-target="inpassing">Inpassing</a></li>
                    <li><a href="#" class="block py-2 px-4 hover:bg-yellow-600 rounded"
                            data-target="jabatan-fungsional">Jabatan Fungsional</a></li>
                    <li><a href="#" class="block py-2 px-4 hover:bg-yellow-600 rounded"
                            data-target="kepangkatan">Kepangkatan</a></li>
                    <li><a href="#" class="block py-2 px-4 hover:bg-yellow-600 rounded"
                            data-target="penempatan">Penempatan</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('logout') }}" class="block py-2 px-4 hover:bg-yellow-600 rounded"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </aside>
    <main class="ml-64 p-6 flex-1" id="main-content">
        @yield('content')
    </main>

    <script>
        $(document).ready(function () {
            console.log('Document ready');

            $('#profileDropdown').click(function () {
                $('#profileSubmenu').toggleClass('hidden');
                console.log('Dropdown clicked');
            });

            $('[data-target]').click(function (e) {
                e.preventDefault();
                var target = $(this).data('target');
                var url = '{{ route('profile.section', ['section' => ':section']) }}'.replace(':section', target);
                $.get(url, function (data) {
                    $('#main-content').html(data);
                });
                history.pushState(null, '', url);
            });

            // ✅ EVENT HANDLER UNTUK SAVE-PROFILE
            $(document).on('click', '.save-profile', function (e) {
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
                                var target = $('.active-sub-menu').data('target') || 'data-pribadi';
                                var url = '{{ route('profile.section', ['section' => ':section']) }}'.replace(':section', target);
                                $.get(url, function (data) {
                                    $('#main-content').html(data);
                                });
                                history.pushState(null, '', url);
                            });
                        } else {
                            console.log('Response success false:', response);
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