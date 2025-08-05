@extends('layouts.app')
    @section('content')
        <h1 class="text-2xl font-bold mb-4">Profil Dosen</h1>
        <div id="profile-content">
            @include('profile.data-pribadi')
        </div>
    @endsection