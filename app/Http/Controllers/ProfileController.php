<?php

namespace App\Http\Controllers;

use App\Models\DosenProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Auth::user()->dosenProfile ?? new DosenProfile(['user_id' => Auth::id()]);
        return view('profile.index', compact('profile'));
    }

    public function showSection($section)
    {
        $profile = Auth::user()->dosenProfile ?? new DosenProfile(['user_id' => Auth::id()]);
        $sections = [
            'data-pribadi' => 'profile.data-pribadi',
            'inpassing' => 'profile.inpassing',
            'jabatan-fungsional' => 'profile.jabatan-fungsional',
            'kepangkatan' => 'profile.kepangkatan',
            'penempatan' => 'profile.penempatan',
        ];

        if (!array_key_exists($section, $sections)) {
            abort(404);
        }

        return view($sections[$section], compact('profile'));
    }

    public function updateDataPribadi(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nidn_nip' => 'nullable|string|max:20',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'nomor_telepon' => 'required|string|max:15',
            'alamat_domisili' => 'required|string|max:500',
            // 'email_pribadi' => 'required|email|unique:dosen_profiles,email_pribadi,' . Auth::id(), // Dihapus karena user_id tidak sama dengan id dosen_profile
            'email_pribadi' => 'required|email|unique:dosen_profiles,email_pribadi,' . (Auth::user()->dosenProfile->id ?? null),
            'foto_profil' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();
        $profile = $user->dosenProfile ?? new DosenProfile(['user_id' => $user->id]);
        
        $data = $request->except(['_token']);

        if ($request->hasFile('foto_profil')) {
            if ($profile->foto_profil) {
                Storage::disk('public')->delete($profile->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto_profil')->store('profiles', 'public');
        }
        
        // Memperbarui nama di tabel users
        $user->name = $request->input('nama_lengkap');
        $user->save();

        // Memperbarui data di tabel dosen_profiles
        $profile->fill($data);
        $profile->save();
        
        return response()->json(['success' => true, 'message' => 'Data pribadi berhasil diperbarui.']);
    }

    // Metode update lainnya (updateInpassing, updateJabatanFungsional, dll.)
    // Saya telah memperbarui logika untuk memastikan objek $profile diambil dengan benar
    public function updateInpassing(Request $request)
    {
        $request->validate([
            'status_inpassing' => 'required|boolean',
            'nomor_sk_inpassing' => 'nullable|string|max:100',
            'tanggal_sk_inpassing' => 'nullable|date',
            'jenjang_pendidikan' => 'nullable|string|max:100',
            'jabatan_inpassing' => 'nullable|string|max:100',
            'instansi_sk_inpassing' => 'nullable|string|max:100',
            'file_sk_inpassing' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $profile = Auth::user()->dosenProfile ?? new DosenProfile(['user_id' => Auth::id()]);
        $data = $request->except(['_token']);

        if ($request->hasFile('file_sk_inpassing')) {
            if ($profile->file_sk_inpassing) {
                Storage::disk('public')->delete($profile->file_sk_inpassing);
            }
            $data['file_sk_inpassing'] = $request->file('file_sk_inpassing')->store('inpassing', 'public');
        }

        $profile->fill($data);
        $profile->save();
        return response()->json(['success' => true, 'message' => 'Data inpassing berhasil diperbarui.']);
    }

    public function updateJabatanFungsional(Request $request)
    {
        $request->validate([
            'jabatan_terakhir' => 'nullable|string|max:100',
            'nomor_sk_jabfung' => 'nullable|string|max:100',
            'tanggal_sk_jabfung' => 'nullable|date',
            'masa_berlaku' => 'nullable|date',
            'file_sk_jabfung' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $profile = Auth::user()->dosenProfile ?? new DosenProfile(['user_id' => Auth::id()]);
        $data = $request->except(['_token']);

        if ($request->hasFile('file_sk_jabfung')) {
            if ($profile->file_sk_jabfung) {
                Storage::disk('public')->delete($profile->file_sk_jabfung);
            }
            $data['file_sk_jabfung'] = $request->file('file_sk_jabfung')->store('jabfung', 'public');
        }

        $profile->fill($data);
        $profile->save();
        return response()->json(['success' => true, 'message' => 'Data jabatan fungsional berhasil diperbarui.']);
    }

    public function updateKepangkatan(Request $request)
    {
        $request->validate([
            'pangkat_terakhir' => 'nullable|string|max:100',
            'golongan_ruang' => 'nullable|string|max:50',
            'nomor_sk_pangkat' => 'nullable|string|max:100',
            'tanggal_sk_pangkat' => 'nullable|date',
            'masa_kerja_golongan' => 'nullable|integer',
            'instansi_sk_pangkat' => 'nullable|string|max:100',
            'file_sk_pangkat' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $profile = Auth::user()->dosenProfile ?? new DosenProfile(['user_id' => Auth::id()]);
        $data = $request->except(['_token']);

        if ($request->hasFile('file_sk_pangkat')) {
            if ($profile->file_sk_pangkat) {
                Storage::disk('public')->delete($profile->file_sk_pangkat);
            }
            $data['file_sk_pangkat'] = $request->file('file_sk_pangkat')->store('pangkat', 'public');
        }

        $profile->fill($data);
        $profile->save();
        return response()->json(['success' => true, 'message' => 'Data kepangkatan berhasil diperbarui.']);
    }

    public function updatePenempatan(Request $request)
    {
        $request->validate([
            'fakultas' => 'required|string|max:100',
            'program_studi' => 'required|string|max:100',
            'status_penempatan' => 'required|in:Tetap,Tidak Tetap,Kontrak',
            'tmt_penempatan' => 'required|date',
            'lokasi_kampus' => 'required|string|max:100',
        ]);

        $profile = Auth::user()->dosenProfile ?? new DosenProfile(['user_id' => Auth::id()]);
        $profile->fill($request->except(['_token']));
        $profile->save();
        return response()->json(['success' => true, 'message' => 'Data penempatan berhasil diperbarui.']);
    }
}