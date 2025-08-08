<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\DosenPengajaran;
use App\Models\DosenBimbinganMahasiswa;
use App\Models\DosenPengujianMahasiswa;
use App\Models\DosenBahanAjar;
use App\Models\DosenPembinaanMahasiswa;
use App\Models\DosenVisitingScientist;
use App\Models\DosenDetasering;
use App\Models\DosenOrasiIlmiah;
use App\Models\DosenPembimbingDosen;
use App\Models\DosenTugasTambahan;

class PelaksanaanPendidikanController extends Controller
{
    public function showSection($section)
    {
        $dosenProfile = Auth::user()->dosenProfile;
        if (!$dosenProfile) {
            abort(404, 'Dosen profile not found.');
        }

        $sections = [
            'pengajaran' => 'pelaksanaan_pendidikan.pengajaran',
            'bimbingan-mahasiswa' => 'pelaksanaan_pendidikan.bimbingan_mahasiswa',
            'pengujian-mahasiswa' => 'pelaksanaan_pendidikan.pengujian_mahasiswa',
            'bahan-ajar' => 'pelaksanaan_pendidikan.bahan_ajar',
            'pembinaan-mahasiswa' => 'pelaksanaan_pendidikan.pembinaan_mahasiswa',
            'visiting-scientist' => 'pelaksanaan_pendidikan.visiting_scientist',
            'detasering' => 'pelaksanaan_pendidikan.detasering',
            'orasi-ilmiah' => 'pelaksanaan_pendidikan.orasi_ilmiah',
            'pembimbing-dosen' => 'pelaksanaan_pendidikan.pembimbing_dosen',
            'tugas-tambahan' => 'pelaksanaan_pendidikan.tugas_tambahan',
        ];

        if (!array_key_exists($section, $sections)) {
            abort(404);
        }

        $data = [];
        switch ($section) {
            case 'pengajaran':
                $data['pengajarans'] = $dosenProfile->pengajaran;
                break;
            case 'bimbingan-mahasiswa':
                $data['bimbingans'] = $dosenProfile->bimbinganMahasiswa;
                break;
            case 'pengujian-mahasiswa':
                $data['pengujians'] = $dosenProfile->pengujianMahasiswa;
                break;
            case 'bahan-ajar':
                $data['bahanAjar'] = $dosenProfile->bahanAjar;
                break;
            case 'pembinaan-mahasiswa':
                $data['pembinaans'] = $dosenProfile->pembinaanMahasiswa;
                break;
            case 'visiting-scientist':
                $data['visitingScientists'] = $dosenProfile->visitingScientist;
                break;
            case 'detasering':
                $data['detaserings'] = $dosenProfile->detasering;
                break;
            case 'orasi-ilmiah':
                $data['orasiIlmiah'] = $dosenProfile->orasiIlmiah;
                break;
            case 'pembimbing-dosen':
                $data['pembimbingDosen'] = $dosenProfile->pembimbingDosen;
                break;
            case 'tugas-tambahan':
                $data['tugasTambahan'] = $dosenProfile->tugasTambahan;
                break;
        }

        return view($sections[$section], $data);
    }

    public function storePengajaran(Request $request) {
        $request->validate([
            'tahun_akademik' => 'required|string',
            'semester' => 'required|string',
            'mata_kuliah' => 'required|string',
            'kode_mata_kuliah' => 'required|string',
            'jumlah_sks' => 'required|integer',
            'program_studi' => 'required|string',
            'kelas' => 'required|string',
            'jumlah_pertemuan' => 'required|integer',
            'rps_file' => 'nullable|file|mimes:pdf|max:2048',
            'bukti_kehadiran_file' => 'nullable|file|mimes:pdf|max:2048',
            'keterangan_tambahan' => 'nullable|string',
        ]);
        $dosenProfile = Auth::user()->dosenProfile;
        $data = $request->except(['_token']);
        if ($request->hasFile('rps_file')) $data['rps_file'] = $request->file('rps_file')->store('pelaksanaan_pendidikan/pengajaran/rps', 'public');
        if ($request->hasFile('bukti_kehadiran_file')) $data['bukti_kehadiran_file'] = $request->file('bukti_kehadiran_file')->store('pelaksanaan_pendidikan/pengajaran/kehadiran', 'public');
        $dosenProfile->pengajaran()->create($data);
        return response()->json(['success' => true, 'message' => 'Data pengajaran berhasil ditambahkan.']);
    }

    public function editPengajaran($id) {
        $data = DosenPengajaran::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        return response()->json($data);
    }

    public function updatePengajaran(Request $request, $id) {
        $data = DosenPengajaran::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        $request->validate([
            'tahun_akademik' => 'required|string',
            'semester' => 'required|string',
            'mata_kuliah' => 'required|string',
            'kode_mata_kuliah' => 'required|string',
            'jumlah_sks' => 'required|integer',
            'program_studi' => 'required|string',
            'kelas' => 'required|string',
            'jumlah_pertemuan' => 'required|integer',
            'rps_file' => 'nullable|file|mimes:pdf|max:2048',
            'bukti_kehadiran_file' => 'nullable|file|mimes:pdf|max:2048',
            'keterangan_tambahan' => 'nullable|string',
        ]);
        $input = $request->except(['_token', '_method']);
        if ($request->hasFile('rps_file')) { if($data->rps_file) Storage::disk('public')->delete($data->rps_file); $input['rps_file'] = $request->file('rps_file')->store('pelaksanaan_pendidikan/pengajaran/rps', 'public'); }
        if ($request->hasFile('bukti_kehadiran_file')) { if($data->bukti_kehadiran_file) Storage::disk('public')->delete($data->bukti_kehadiran_file); $input['bukti_kehadiran_file'] = $request->file('bukti_kehadiran_file')->store('pelaksanaan_pendidikan/pengajaran/kehadiran', 'public'); }
        $data->update($input);
        return response()->json(['success' => true, 'message' => 'Data pengajaran berhasil diperbarui.']);
    }

    public function deletePengajaran($id) {
        $data = DosenPengajaran::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        if ($data->rps_file) Storage::disk('public')->delete($data->rps_file);
        if ($data->bukti_kehadiran_file) Storage::disk('public')->delete($data->bukti_kehadiran_file);
        $data->delete();
        return response()->json(['success' => true, 'message' => 'Data pengajaran berhasil dihapus.']);
    }

    // Metode serupa untuk 9 submenu lainnya...
    // (Bimbingan Mahasiswa, Pengujian Mahasiswa, Bahan Ajar, dll.)
    public function storeBimbinganMahasiswa(Request $request) {
        $request->validate([
            'tahun_akademik' => 'required|string',
            'jenis_bimbingan' => 'required|string',
            'nama_mahasiswa' => 'required|string',
            'nim_mahasiswa' => 'required|string',
            'judul_tema' => 'required|string',
            'jumlah_bimbingan' => 'required|integer',
            'bukti_bimbingan_file' => 'nullable|file|mimes:pdf|max:2048',
            'status' => 'required|string',
        ]);
        $dosenProfile = Auth::user()->dosenProfile;
        $data = $request->except(['_token']);
        if ($request->hasFile('bukti_bimbingan_file')) $data['bukti_bimbingan_file'] = $request->file('bukti_bimbingan_file')->store('pelaksanaan_pendidikan/bimbingan', 'public');
        $dosenProfile->bimbinganMahasiswa()->create($data);
        return response()->json(['success' => true, 'message' => 'Data bimbingan mahasiswa berhasil ditambahkan.']);
    }
    public function editBimbinganMahasiswa($id) {
        $data = DosenBimbinganMahasiswa::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        return response()->json($data);
    }
    public function updateBimbinganMahasiswa(Request $request, $id) {
        $data = DosenBimbinganMahasiswa::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        $request->validate([
            'tahun_akademik' => 'required|string',
            'jenis_bimbingan' => 'required|string',
            'nama_mahasiswa' => 'required|string',
            'nim_mahasiswa' => 'required|string',
            'judul_tema' => 'required|string',
            'jumlah_bimbingan' => 'required|integer',
            'bukti_bimbingan_file' => 'nullable|file|mimes:pdf|max:2048',
            'status' => 'required|string',
        ]);
        $input = $request->except(['_token', '_method']);
        if ($request->hasFile('bukti_bimbingan_file')) { if($data->bukti_bimbingan_file) Storage::disk('public')->delete($data->bukti_bimbingan_file); $input['bukti_bimbingan_file'] = $request->file('bukti_bimbingan_file')->store('pelaksanaan_pendidikan/bimbingan', 'public'); }
        $data->update($input);
        return response()->json(['success' => true, 'message' => 'Data bimbingan mahasiswa berhasil diperbarui.']);
    }
    public function deleteBimbinganMahasiswa($id) {
        $data = DosenBimbinganMahasiswa::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        if ($data->bukti_bimbingan_file) Storage::disk('public')->delete($data->bukti_bimbingan_file);
        $data->delete();
        return response()->json(['success' => true, 'message' => 'Data bimbingan mahasiswa berhasil dihapus.']);
    }

    public function storePengujianMahasiswa(Request $request) {
        $request->validate([
            'tahun_akademik' => 'required|string',
            'jenis_ujian' => 'required|string',
            'nama_mahasiswa' => 'required|string',
            'nim_mahasiswa' => 'required|string',
            'judul' => 'required|string',
            'tanggal_ujian' => 'required|date',
            'bukti_kehadiran_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);
        $dosenProfile = Auth::user()->dosenProfile;
        $data = $request->except(['_token']);
        if ($request->hasFile('bukti_kehadiran_file')) $data['bukti_kehadiran_file'] = $request->file('bukti_kehadiran_file')->store('pelaksanaan_pendidikan/pengujian', 'public');
        $dosenProfile->pengujianMahasiswa()->create($data);
        return response()->json(['success' => true, 'message' => 'Data pengujian mahasiswa berhasil ditambahkan.']);
    }
    public function editPengujianMahasiswa($id) {
        $data = DosenPengujianMahasiswa::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        return response()->json($data);
    }
    public function updatePengujianMahasiswa(Request $request, $id) {
        $data = DosenPengujianMahasiswa::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        $request->validate([
            'tahun_akademik' => 'required|string',
            'jenis_ujian' => 'required|string',
            'nama_mahasiswa' => 'required|string',
            'nim_mahasiswa' => 'required|string',
            'judul' => 'required|string',
            'tanggal_ujian' => 'required|date',
            'bukti_kehadiran_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);
        $input = $request->except(['_token', '_method']);
        if ($request->hasFile('bukti_kehadiran_file')) { if($data->bukti_kehadiran_file) Storage::disk('public')->delete($data->bukti_kehadiran_file); $input['bukti_kehadiran_file'] = $request->file('bukti_kehadiran_file')->store('pelaksanaan_pendidikan/pengujian', 'public'); }
        $data->update($input);
        return response()->json(['success' => true, 'message' => 'Data pengujian mahasiswa berhasil diperbarui.']);
    }
    public function deletePengujianMahasiswa($id) {
        $data = DosenPengujianMahasiswa::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        if ($data->bukti_kehadiran_file) Storage::disk('public')->delete($data->bukti_kehadiran_file);
        $data->delete();
        return response()->json(['success' => true, 'message' => 'Data pengujian mahasiswa berhasil dihapus.']);
    }

    public function storeBahanAjar(Request $request) {
        $request->validate([
            'tahun_akademik' => 'required|string',
            'mata_kuliah' => 'required|string',
            'judul_bahan_ajar' => 'required|string',
            'jenis_bahan_ajar' => 'required|string',
            'file_bahan_ajar' => 'nullable|file|mimes:pdf|max:2048',
            'tanggal_penyusunan' => 'required|date',
            'keterangan_tambahan' => 'nullable|string',
        ]);
        $dosenProfile = Auth::user()->dosenProfile;
        $data = $request->except(['_token']);
        if ($request->hasFile('file_bahan_ajar')) $data['file_bahan_ajar'] = $request->file('file_bahan_ajar')->store('pelaksanaan_pendidikan/bahan_ajar', 'public');
        $dosenProfile->bahanAjar()->create($data);
        return response()->json(['success' => true, 'message' => 'Data bahan ajar berhasil ditambahkan.']);
    }
    public function editBahanAjar($id) {
        $data = DosenBahanAjar::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        return response()->json($data);
    }
    public function updateBahanAjar(Request $request, $id) {
        $data = DosenBahanAjar::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        $request->validate([
            'tahun_akademik' => 'required|string',
            'mata_kuliah' => 'required|string',
            'judul_bahan_ajar' => 'required|string',
            'jenis_bahan_ajar' => 'required|string',
            'file_bahan_ajar' => 'nullable|file|mimes:pdf|max:2048',
            'tanggal_penyusunan' => 'required|date',
            'keterangan_tambahan' => 'nullable|string',
        ]);
        $input = $request->except(['_token', '_method']);
        if ($request->hasFile('file_bahan_ajar')) { if($data->file_bahan_ajar) Storage::disk('public')->delete($data->file_bahan_ajar); $input['file_bahan_ajar'] = $request->file('file_bahan_ajar')->store('pelaksanaan_pendidikan/bahan_ajar', 'public'); }
        $data->update($input);
        return response()->json(['success' => true, 'message' => 'Data bahan ajar berhasil diperbarui.']);
    }
    public function deleteBahanAjar($id) {
        $data = DosenBahanAjar::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        if ($data->file_bahan_ajar) Storage::disk('public')->delete($data->file_bahan_ajar);
        $data->delete();
        return response()->json(['success' => true, 'message' => 'Data bahan ajar berhasil dihapus.']);
    }

    public function storePembinaanMahasiswa(Request $request) {
        $request->validate([
            'tahun_akademik' => 'required|string',
            'jenis_pembinaan' => 'required|string',
            'nama_kegiatan' => 'required|string',
            'periode_mulai' => 'required|string',
            'periode_selesai' => 'required|string',
            'lokasi' => 'required|string',
            'bukti_dokumentasi_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan_tambahan' => 'nullable|string',
        ]);
        $dosenProfile = Auth::user()->dosenProfile;
        $data = $request->except(['_token']);
        if ($request->hasFile('bukti_dokumentasi_file')) $data['bukti_dokumentasi_file'] = $request->file('bukti_dokumentasi_file')->store('pelaksanaan_pendidikan/pembinaan', 'public');
        $dosenProfile->pembinaanMahasiswa()->create($data);
        return response()->json(['success' => true, 'message' => 'Data pembinaan mahasiswa berhasil ditambahkan.']);
    }
    public function editPembinaanMahasiswa($id) {
        $data = DosenPembinaanMahasiswa::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        return response()->json($data);
    }
    public function updatePembinaanMahasiswa(Request $request, $id) {
        $data = DosenPembinaanMahasiswa::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        $request->validate([
            'tahun_akademik' => 'required|string',
            'jenis_pembinaan' => 'required|string',
            'nama_kegiatan' => 'required|string',
            'periode_mulai' => 'required|string',
            'periode_selesai' => 'required|string',
            'lokasi' => 'required|string',
            'bukti_dokumentasi_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan_tambahan' => 'nullable|string',
        ]);
        $input = $request->except(['_token', '_method']);
        if ($request->hasFile('bukti_dokumentasi_file')) { if($data->bukti_dokumentasi_file) Storage::disk('public')->delete($data->bukti_dokumentasi_file); $input['bukti_dokumentasi_file'] = $request->file('bukti_dokumentasi_file')->store('pelaksanaan_pendidikan/pembinaan', 'public'); }
        $data->update($input);
        return response()->json(['success' => true, 'message' => 'Data pembinaan mahasiswa berhasil diperbarui.']);
    }
    public function deletePembinaanMahasiswa($id) {
        $data = DosenPembinaanMahasiswa::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        if ($data->bukti_dokumentasi_file) Storage::disk('public')->delete($data->bukti_dokumentasi_file);
        $data->delete();
        return response()->json(['success' => true, 'message' => 'Data pembinaan mahasiswa berhasil dihapus.']);
    }

    public function storeVisitingScientist(Request $request) {
        $request->validate([
            'tahun_akademik' => 'required|string',
            'nama_institusi_tujuan' => 'required|string',
            'negara_daerah' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'topik_kegiatan' => 'required|string',
            'surat_tugas_file' => 'nullable|file|mimes:pdf|max:2048',
            'bukti_dokumentasi_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan_tambahan' => 'nullable|string',
        ]);
        $dosenProfile = Auth::user()->dosenProfile;
        $data = $request->except(['_token']);
        if ($request->hasFile('surat_tugas_file')) $data['surat_tugas_file'] = $request->file('surat_tugas_file')->store('pelaksanaan_pendidikan/visiting', 'public');
        if ($request->hasFile('bukti_dokumentasi_file')) $data['bukti_dokumentasi_file'] = $request->file('bukti_dokumentasi_file')->store('pelaksanaan_pendidikan/visiting', 'public');
        $dosenProfile->visitingScientist()->create($data);
        return response()->json(['success' => true, 'message' => 'Data visiting scientist berhasil ditambahkan.']);
    }
    public function editVisitingScientist($id) {
        $data = DosenVisitingScientist::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        return response()->json($data);
    }
    public function updateVisitingScientist(Request $request, $id) {
        $data = DosenVisitingScientist::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        $request->validate([
            'tahun_akademik' => 'required|string',
            'nama_institusi_tujuan' => 'required|string',
            'negara_daerah' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'topik_kegiatan' => 'required|string',
            'surat_tugas_file' => 'nullable|file|mimes:pdf|max:2048',
            'bukti_dokumentasi_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan_tambahan' => 'nullable|string',
        ]);
        $input = $request->except(['_token', '_method']);
        if ($request->hasFile('surat_tugas_file')) { if($data->surat_tugas_file) Storage::disk('public')->delete($data->surat_tugas_file); $input['surat_tugas_file'] = $request->file('surat_tugas_file')->store('pelaksanaan_pendidikan/visiting', 'public'); }
        if ($request->hasFile('bukti_dokumentasi_file')) { if($data->bukti_dokumentasi_file) Storage::disk('public')->delete($data->bukti_dokumentasi_file); $input['bukti_dokumentasi_file'] = $request->file('bukti_dokumentasi_file')->store('pelaksanaan_pendidikan/visiting', 'public'); }
        $data->update($input);
        return response()->json(['success' => true, 'message' => 'Data visiting scientist berhasil diperbarui.']);
    }
    public function deleteVisitingScientist($id) {
        $data = DosenVisitingScientist::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        if ($data->surat_tugas_file) Storage::disk('public')->delete($data->surat_tugas_file);
        if ($data->bukti_dokumentasi_file) Storage::disk('public')->delete($data->bukti_dokumentasi_file);
        $data->delete();
        return response()->json(['success' => true, 'message' => 'Data visiting scientist berhasil dihapus.']);
    }

    public function storeDetasering(Request $request) {
        $request->validate([
            'tahun_akademik' => 'required|string',
            'perguruan_tinggi_tujuan' => 'required|string',
            'bidang_penugasan' => 'required|string',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'required|date',
            'surat_tugas_file' => 'nullable|file|mimes:pdf|max:2048',
            'bukti_kegiatan_file' => 'nullable|file|mimes:pdf|max:2048',
            'keterangan_tambahan' => 'nullable|string',
        ]);
        $dosenProfile = Auth::user()->dosenProfile;
        $data = $request->except(['_token']);
        if ($request->hasFile('surat_tugas_file')) $data['surat_tugas_file'] = $request->file('surat_tugas_file')->store('pelaksanaan_pendidikan/detasering', 'public');
        if ($request->hasFile('bukti_kegiatan_file')) $data['bukti_kegiatan_file'] = $request->file('bukti_kegiatan_file')->store('pelaksanaan_pendidikan/detasering', 'public');
        $dosenProfile->detasering()->create($data);
        return response()->json(['success' => true, 'message' => 'Data detasering berhasil ditambahkan.']);
    }
    public function editDetasering($id) {
        $data = DosenDetasering::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        return response()->json($data);
    }
    public function updateDetasering(Request $request, $id) {
        $data = DosenDetasering::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        $request->validate([
            'tahun_akademik' => 'required|string',
            'perguruan_tinggi_tujuan' => 'required|string',
            'bidang_penugasan' => 'required|string',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'required|date',
            'surat_tugas_file' => 'nullable|file|mimes:pdf|max:2048',
            'bukti_kegiatan_file' => 'nullable|file|mimes:pdf|max:2048',
            'keterangan_tambahan' => 'nullable|string',
        ]);
        $input = $request->except(['_token', '_method']);
        if ($request->hasFile('surat_tugas_file')) { if($data->surat_tugas_file) Storage::disk('public')->delete($data->surat_tugas_file); $input['surat_tugas_file'] = $request->file('surat_tugas_file')->store('pelaksanaan_pendidikan/detasering', 'public'); }
        if ($request->hasFile('bukti_kegiatan_file')) { if($data->bukti_kegiatan_file) Storage::disk('public')->delete($data->bukti_kegiatan_file); $input['bukti_kegiatan_file'] = $request->file('bukti_kegiatan_file')->store('pelaksanaan_pendidikan/detasering', 'public'); }
        $data->update($input);
        return response()->json(['success' => true, 'message' => 'Data detasering berhasil diperbarui.']);
    }
    public function deleteDetasering($id) {
        $data = DosenDetasering::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        if ($data->surat_tugas_file) Storage::disk('public')->delete($data->surat_tugas_file);
        if ($data->bukti_kegiatan_file) Storage::disk('public')->delete($data->bukti_kegiatan_file);
        $data->delete();
        return response()->json(['success' => true, 'message' => 'Data detasering berhasil dihapus.']);
    }

    public function storeOrasiIlmiah(Request $request) {
        $request->validate([
            'tahun_akademik' => 'required|string',
            'judul_orasi' => 'required|string',
            'acara_kegiatan' => 'required|string',
            'penyelenggara' => 'required|string',
            'tanggal_orasi' => 'required|date',
            'materi_file' => 'nullable|file|mimes:pdf|max:2048',
            'bukti_dokumentasi_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        $dosenProfile = Auth::user()->dosenProfile;
        $data = $request->except(['_token']);
        if ($request->hasFile('materi_file')) $data['materi_file'] = $request->file('materi_file')->store('pelaksanaan_pendidikan/orasi_ilmiah', 'public');
        if ($request->hasFile('bukti_dokumentasi_file')) $data['bukti_dokumentasi_file'] = $request->file('bukti_dokumentasi_file')->store('pelaksanaan_pendidikan/orasi_ilmiah', 'public');
        $dosenProfile->orasiIlmiah()->create($data);
        return response()->json(['success' => true, 'message' => 'Data orasi ilmiah berhasil ditambahkan.']);
    }
    public function editOrasiIlmiah($id) {
        $data = DosenOrasiIlmiah::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        return response()->json($data);
    }
    public function updateOrasiIlmiah(Request $request, $id) {
        $data = DosenOrasiIlmiah::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        $request->validate([
            'tahun_akademik' => 'required|string',
            'judul_orasi' => 'required|string',
            'acara_kegiatan' => 'required|string',
            'penyelenggara' => 'required|string',
            'tanggal_orasi' => 'required|date',
            'materi_file' => 'nullable|file|mimes:pdf|max:2048',
            'bukti_dokumentasi_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        $input = $request->except(['_token', '_method']);
        if ($request->hasFile('materi_file')) { if($data->materi_file) Storage::disk('public')->delete($data->materi_file); $input['materi_file'] = $request->file('materi_file')->store('pelaksanaan_pendidikan/orasi_ilmiah', 'public'); }
        if ($request->hasFile('bukti_dokumentasi_file')) { if($data->bukti_dokumentasi_file) Storage::disk('public')->delete($data->bukti_dokumentasi_file); $input['bukti_dokumentasi_file'] = $request->file('bukti_dokumentasi_file')->store('pelaksanaan_pendidikan/orasi_ilmiah', 'public'); }
        $data->update($input);
        return response()->json(['success' => true, 'message' => 'Data orasi ilmiah berhasil diperbarui.']);
    }
    public function deleteOrasiIlmiah($id) {
        $data = DosenOrasiIlmiah::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        if ($data->materi_file) Storage::disk('public')->delete($data->materi_file);
        if ($data->bukti_dokumentasi_file) Storage::disk('public')->delete($data->bukti_dokumentasi_file);
        $data->delete();
        return response()->json(['success' => true, 'message' => 'Data orasi ilmiah berhasil dihapus.']);
    }

    public function storePembimbingDosen(Request $request) {
        $request->validate([
            'tahun_akademik' => 'required|string',
            'nama_dosen_dibimbing' => 'required|string',
            'nidn_nip' => 'required|string',
            'topik_pembimbingan' => 'required|string',
            'periode_pembimbingan' => 'required|string',
            'bukti_pembimbingan_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan_tambahan' => 'nullable|string',
        ]);
        $dosenProfile = Auth::user()->dosenProfile;
        $data = $request->except(['_token']);
        if ($request->hasFile('bukti_pembimbingan_file')) $data['bukti_pembimbingan_file'] = $request->file('bukti_pembimbingan_file')->store('pelaksanaan_pendidikan/pembimbing_dosen', 'public');
        $dosenProfile->pembimbingDosen()->create($data);
        return response()->json(['success' => true, 'message' => 'Data pembimbingan dosen berhasil ditambahkan.']);
    }
    public function editPembimbingDosen($id) {
        $data = DosenPembimbingDosen::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        return response()->json($data);
    }
    public function updatePembimbingDosen(Request $request, $id) {
        $data = DosenPembimbingDosen::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        $request->validate([
            'tahun_akademik' => 'required|string',
            'nama_dosen_dibimbing' => 'required|string',
            'nidn_nip' => 'required|string',
            'topik_pembimbingan' => 'required|string',
            'periode_pembimbingan' => 'required|string',
            'bukti_pembimbingan_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan_tambahan' => 'nullable|string',
        ]);
        $input = $request->except(['_token', '_method']);
        if ($request->hasFile('bukti_pembimbingan_file')) { if($data->bukti_pembimbingan_file) Storage::disk('public')->delete($data->bukti_pembimbingan_file); $input['bukti_pembimbingan_file'] = $request->file('bukti_pembimbingan_file')->store('pelaksanaan_pendidikan/pembimbing_dosen', 'public'); }
        $data->update($input);
        return response()->json(['success' => true, 'message' => 'Data pembimbingan dosen berhasil diperbarui.']);
    }
    public function deletePembimbingDosen($id) {
        $data = DosenPembimbingDosen::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        if ($data->bukti_pembimbingan_file) Storage::disk('public')->delete($data->bukti_pembimbingan_file);
        $data->delete();
        return response()->json(['success' => true, 'message' => 'Data pembimbingan dosen berhasil dihapus.']);
    }

    public function storeTugasTambahan(Request $request) {
        $request->validate([
            'tahun_akademik' => 'required|string',
            'nama_jabatan' => 'required|string',
            'periode_menjabat' => 'required|string',
            'sk_file' => 'nullable|file|mimes:pdf|max:2048',
            'keterangan_tambahan' => 'nullable|string',
        ]);
        $dosenProfile = Auth::user()->dosenProfile;
        $data = $request->except(['_token']);
        if ($request->hasFile('sk_file')) $data['sk_file'] = $request->file('sk_file')->store('pelaksanaan_pendidikan/tugas_tambahan', 'public');
        $dosenProfile->tugasTambahan()->create($data);
        return response()->json(['success' => true, 'message' => 'Data tugas tambahan berhasil ditambahkan.']);
    }
    public function editTugasTambahan($id) {
        $data = DosenTugasTambahan::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        return response()->json($data);
    }
    public function updateTugasTambahan(Request $request, $id) {
        $data = DosenTugasTambahan::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        $request->validate([
            'tahun_akademik' => 'required|string',
            'nama_jabatan' => 'required|string',
            'periode_menjabat' => 'required|string',
            'sk_file' => 'nullable|file|mimes:pdf|max:2048',
            'keterangan_tambahan' => 'nullable|string',
        ]);
        $input = $request->except(['_token', '_method']);
        if ($request->hasFile('sk_file')) { if($data->sk_file) Storage::disk('public')->delete($data->sk_file); $input['sk_file'] = $request->file('sk_file')->store('pelaksanaan_pendidikan/tugas_tambahan', 'public'); }
        $data->update($input);
        return response()->json(['success' => true, 'message' => 'Data tugas tambahan berhasil diperbarui.']);
    }
    public function deleteTugasTambahan($id) {
        $data = DosenTugasTambahan::findOrFail($id);
        if ($data->dosen_profile_id !== Auth::user()->dosenProfile->id) abort(403);
        if ($data->sk_file) Storage::disk('public')->delete($data->sk_file);
        $data->delete();
        return response()->json(['success' => true, 'message' => 'Data tugas tambahan berhasil dihapus.']);
    }
}