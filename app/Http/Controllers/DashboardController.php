<?php

     namespace App\Http\Controllers;

     use App\Models\DosenProfile;
     use App\Models\Proposal;
     use App\Models\Laporan;
     use App\Models\Luaran;
     use App\Models\Keuangan;
     use Illuminate\Http\Request;
     use Illuminate\Support\Facades\Auth;

     class DashboardController extends Controller {
         public function index() {
             $user = Auth::user();
             if ($user->hasRole('dosen')) {
                 $profile = DosenProfile::where('user_id', $user->id)->first();
                 $proposals = Proposal::where('dosen_id', $profile->id)->get();
                 $laporans = Laporan::where('dosen_id', $profile->id)->get();
                 $luarans = Luaran::where('dosen_id', $profile->id)->get();
                 $keuangans = Keuangan::where('dosen_id', $profile->id)->get();

                 return view('dashboard.dosen', compact('profile', 'proposals', 'laporans', 'luarans', 'keuangans'));
             }
             return view('dashboard.default');
         }

         public function storeProposal(Request $request) {
             $request->validate([
                 'judul' => 'required|string|max:255',
                 'deskripsi' => 'required',
                 'file' => 'nullable|file|max:10240', // 10MB max
             ]);

             $profile = DosenProfile::where('user_id', Auth::id())->first();
             $data = $request->all();
             if ($request->hasFile('file')) {
                 $data['file_path'] = $request->file('file')->store('proposals', 'public');
             }
             $profile->proposals()->create($data);

             return redirect()->back()->with('success', 'Proposal berhasil disimpan.');
         }

         // Fungsi serupa untuk laporan, luaran, dan keuangan
         public function storeLaporan(Request $request) {
             $request->validate([
                 'judul' => 'required|string|max:255',
                 'deskripsi' => 'required',
                 'file' => 'nullable|file|max:10240',
             ]);

             $profile = DosenProfile::where('user_id', Auth::id())->first();
             $data = $request->all();
             if ($request->hasFile('file')) {
                 $data['file_path'] = $request->file('file')->store('laporans', 'public');
             }
             $profile->laporans()->create($data);

             return redirect()->back()->with('success', 'Laporan berhasil disimpan.');
         }

         public function storeLuaran(Request $request) {
             $request->validate([
                 'judul' => 'required|string|max:255',
                 'deskripsi' => 'required',
                 'file' => 'nullable|file|max:10240',
             ]);

             $profile = DosenProfile::where('user_id', Auth::id())->first();
             $data = $request->all();
             if ($request->hasFile('file')) {
                 $data['file_path'] = $request->file('file')->store('luarans', 'public');
             }
             $profile->luarans()->create($data);

             return redirect()->back()->with('success', 'Luaran berhasil disimpan.');
         }

         public function storeKeuangan(Request $request) {
             $request->validate([
                 'judul' => 'required|string|max:255',
                 'jumlah' => 'required|numeric',
                 'deskripsi' => 'required',
                 'file' => 'nullable|file|max:10240',
             ]);

             $profile = DosenProfile::where('user_id', Auth::id())->first();
             $data = $request->all();
             if ($request->hasFile('file')) {
                 $data['file_path'] = $request->file('file')->store('keuangans', 'public');
             }
             $profile->keuangans()->create($data);

             return redirect()->back()->with('success', 'Data keuangan berhasil disimpan.');
         }
     }