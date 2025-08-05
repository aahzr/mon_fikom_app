<!DOCTYPE html>
       <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
       <head>
           <meta charset="utf-8">
           <meta name="viewport" content="width=device-width, initial-scale=1">
           <title>Monitoring Dosen - @yield('title')</title>
           <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
       </head>
       <body class="bg-gray-900 text-white">
           <div class="flex h-screen">
               <aside class="w-64 bg-gray-800 p-4">
                   <h2 class="text-xl font-bold mb-4">Menu</h2>
                   <ul>
                       <li><a href="{{ route('dashboard') }}" class="block py-2 px-4 hover:bg-yellow-600 rounded">Dashboard</a></li>
                       @if (Auth::check() && Auth::user()->hasRole('dosen'))
                           <li><a href="#" class="block py-2 px-4 hover:bg-yellow-600 rounded">Profil</a></li>
                           <li><a href="#" class="block py-2 px-4 hover:bg-yellow-600 rounded">Kualifikasi</a></li>
                           <li><a href="#" class="block py-2 px-4 hover:bg-yellow-600 rounded">Pendidikan</a></li>
                           <li><a href="#" class="block py-2 px-4 hover:bg-yellow-600 rounded">Penelitian</a></li>
                           <li><a href="#" class="block py-2 px-4 hover:bg-yellow-600 rounded">Pengabdian</a></li>
                           <li><a href="#" class="block py-2 px-4 hover:bg-yellow-600 rounded">Penunjang</a></li>
                           <li><a href="#" class="block py-2 px-4 hover:bg-yellow-600 rounded">Reward</a></li>
                       @endif
                       <li><a href="{{ route('logout') }}" class="block py-2 px-4 hover:bg-yellow-600 rounded" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           @csrf
                       </form>
                   </ul>
               </aside>
               <main class="flex-1 p-6">
                   @yield('content')
               </main>
           </div>
       </body>
       </html>