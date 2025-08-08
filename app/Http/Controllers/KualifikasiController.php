<?php

namespace App\Http\Controllers;

use App\Models\DosenPendidikanFormal;
use App\Models\DosenDiklat;
use App\Models\DosenRiwayatPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class KualifikasiController extends Controller
{
    public function showSection($section)
    {
        $dosenProfile = Auth::user()->dosenProfile;
        if (!$dosenProfile) {
            abort(404, 'Dosen profile not found.');
        }

        $sections = [
            'pendidikan-formal' => 'kualifikasi.pendidikan_formal',
            'diklat' => 'kualifikasi.diklat',
            'riwayat-pekerjaan' => 'kualifikasi.riwayat_pekerjaan',
        ];

        if (!array_key_exists($section, $sections)) {
            abort(404);
        }
        
        $data = [];
        switch ($section) {
            case 'pendidikan-formal':
                $data['pendidikans'] = $dosenProfile->pendidikanFormal;
                break;
            case 'diklat':
                $data['diklats'] = $dosenProfile->diklats;
                break;
            case 'riwayat-pekerjaan':
                $data['riwayatPekerjaans'] = $dosenProfile->riwayatPekerjaan;
                break;
        }

        return view($sections[$section], $data);
    }
    
    // Metode untuk Pendidikan Formal
    public function storePendidikanFormal(Request $request)
    {
        $request->validate([
            'jenjang_pendidikan' => 'required|string|max:255',
            'nama_institusi' => 'required|string|max:255',
            'fakultas_jurusan' => 'required|string|max:255',
            'gelar_akademik' => 'required|string|max:255',
            'nomor_ijazah' => 'nullable|string|max:255',
            'tanggal_lulus' => 'required|date',
            'negara_institusi' => 'required|string|max:255',
            'file_scan_ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $dosenProfile = Auth::user()->dosenProfile;
        if (!$dosenProfile) {
            return response()->json(['success' => false, 'message' => 'Dosen profile not found.'], 404);
        }

        $data = $request->except(['_token']);
        if ($request->hasFile('file_scan_ijazah')) {
            $data['file_scan_ijazah'] = $request->file('file_scan_ijazah')->store('kualifikasi/pendidikan', 'public');
        }

        $dosenProfile->pendidikanFormal()->create($data);
        return response()->json(['success' => true, 'message' => 'Data pendidikan formal berhasil ditambahkan.']);
    }

    public function editPendidikanFormal($id)
    {
        $pendidikan = DosenPendidikanFormal::findOrFail($id);
        if ($pendidikan->dosen_profile_id !== Auth::user()->dosenProfile->id) {
            abort(403);
        }
        return response()->json($pendidikan);
    }

    public function updatePendidikanFormal(Request $request, $id)
    {
        $pendidikan = DosenPendidikanFormal::findOrFail($id);
        if ($pendidikan->dosen_profile_id !== Auth::user()->dosenProfile->id) {
            abort(403);
        }
        
        $request->validate([
            'jenjang_pendidikan' => 'required|string|max:255',
            'nama_institusi' => 'required|string|max:255',
            'fakultas_jurusan' => 'required|string|max:255',
            'gelar_akademik' => 'required|string|max:255',
            'nomor_ijazah' => 'nullable|string|max:255',
            'tanggal_lulus' => 'required|date',
            'negara_institusi' => 'required|string|max:255',
            'file_scan_ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('file_scan_ijazah')) {
            if ($pendidikan->file_scan_ijazah) {
                Storage::disk('public')->delete($pendidikan->file_scan_ijazah);
            }
            $data['file_scan_ijazah'] = $request->file('file_scan_ijazah')->store('kualifikasi/pendidikan', 'public');
        }

        $pendidikan->update($data);
        return response()->json(['success' => true, 'message' => 'Data pendidikan formal berhasil diperbarui.']);
    }

    public function deletePendidikanFormal($id)
    {
        $pendidikan = DosenPendidikanFormal::findOrFail($id);
        if ($pendidikan->dosen_profile_id !== Auth::user()->dosenProfile->id) {
            abort(403);
        }

        if ($pendidikan->file_scan_ijazah) {
            Storage::disk('public')->delete($pendidikan->file_scan_ijazah);
        }
        
        $pendidikan->delete();
        return response()->json(['success' => true, 'message' => 'Data pendidikan formal berhasil dihapus.']);
    }

    // Metode untuk Diklat
    public function storeDiklat(Request $request)
    {
        $request->validate([
            'nama_pelatihan' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'jenis_pelatihan' => 'required|string|max:255',
            'waktu_pelaksanaan' => 'required|string|max:255',
            'durasi_jam' => 'required|integer',
            'tempat' => 'required|string|max:255',
            'sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $dosenProfile = Auth::user()->dosenProfile;
        if (!$dosenProfile) {
            return response()->json(['success' => false, 'message' => 'Dosen profile not found.'], 404);
        }

        $data = $request->except(['_token']);
        if ($request->hasFile('sertifikat')) {
            $data['sertifikat'] = $request->file('sertifikat')->store('kualifikasi/diklat', 'public');
        }

        $dosenProfile->diklats()->create($data);
        return response()->json(['success' => true, 'message' => 'Data diklat berhasil ditambahkan.']);
    }

    public function editDiklat($id)
    {
        $diklat = DosenDiklat::findOrFail($id);
        if ($diklat->dosen_profile_id !== Auth::user()->dosenProfile->id) {
            abort(403);
        }
        return response()->json($diklat);
    }

    public function updateDiklat(Request $request, $id)
    {
        $diklat = DosenDiklat::findOrFail($id);
        if ($diklat->dosen_profile_id !== Auth::user()->dosenProfile->id) {
            abort(403);
        }
        
        $request->validate([
            'nama_pelatihan' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'jenis_pelatihan' => 'required|string|max:255',
            'waktu_pelaksanaan' => 'required|string|max:255',
            'durasi_jam' => 'required|integer',
            'tempat' => 'required|string|max:255',
            'sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('sertifikat')) {
            if ($diklat->sertifikat) {
                Storage::disk('public')->delete($diklat->sertifikat);
            }
            $data['sertifikat'] = $request->file('sertifikat')->store('kualifikasi/diklat', 'public');
        }

        $diklat->update($data);
        return response()->json(['success' => true, 'message' => 'Data diklat berhasil diperbarui.']);
    }

    public function deleteDiklat($id)
    {
        $diklat = DosenDiklat::findOrFail($id);
        if ($diklat->dosen_profile_id !== Auth::user()->dosenProfile->id) {
            abort(403);
        }

        if ($diklat->sertifikat) {
            Storage::disk('public')->delete($diklat->sertifikat);
        }
        
        $diklat->delete();
        return response()->json(['success' => true, 'message' => 'Data diklat berhasil dihapus.']);
    }

    // Metode untuk Riwayat Pekerjaan
    public function storeRiwayatPekerjaan(Request $request)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'jenis_instansi' => 'required|string|max:255',
            'alamat_instansi' => 'required|string|max:255',
            'periode_kerja' => 'required|string|max:255',
            'surat_keterangan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $dosenProfile = Auth::user()->dosenProfile;
        if (!$dosenProfile) {
            return response()->json(['success' => false, 'message' => 'Dosen profile not found.'], 404);
        }

        $data = $request->except(['_token']);
        if ($request->hasFile('surat_keterangan')) {
            $data['surat_keterangan'] = $request->file('surat_keterangan')->store('kualifikasi/riwayat_pekerjaan', 'public');
        }

        $dosenProfile->riwayatPekerjaan()->create($data);
        return response()->json(['success' => true, 'message' => 'Data riwayat pekerjaan berhasil ditambahkan.']);
    }

    public function editRiwayatPekerjaan($id)
    {
        $riwayat = DosenRiwayatPekerjaan::findOrFail($id);
        if ($riwayat->dosen_profile_id !== Auth::user()->dosenProfile->id) {
            abort(403);
        }
        return response()->json($riwayat);
    }

    public function updateRiwayatPekerjaan(Request $request, $id)
    {
        $riwayat = DosenRiwayatPekerjaan::findOrFail($id);
        if ($riwayat->dosen_profile_id !== Auth::user()->dosenProfile->id) {
            abort(403);
        }
        
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'jenis_instansi' => 'required|string|max:255',
            'alamat_instansi' => 'required|string|max:255',
            'periode_kerja' => 'required|string|max:255',
            'surat_keterangan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->except(['_token', '_method']);
        if ($request->hasFile('surat_keterangan')) {
            if ($riwayat->surat_keterangan) {
                Storage::disk('public')->delete($riwayat->surat_keterangan);
            }
            $data['surat_keterangan'] = $request->file('surat_keterangan')->store('kualifikasi/riwayat_pekerjaan', 'public');
        }

        $riwayat->update($data);
        return response()->json(['success' => true, 'message' => 'Data riwayat pekerjaan berhasil diperbarui.']);
    }

    public function deleteRiwayatPekerjaan($id)
    {
        $riwayat = DosenRiwayatPekerjaan::findOrFail($id);
        if ($riwayat->dosen_profile_id !== Auth::user()->dosenProfile->id) {
            abort(403);
        }

        if ($riwayat->surat_keterangan) {
            Storage::disk('public')->delete($riwayat->surat_keterangan);
        }
        
        $riwayat->delete();
        return response()->json(['success' => true, 'message' => 'Data riwayat pekerjaan berhasil dihapus.']);
    }
}