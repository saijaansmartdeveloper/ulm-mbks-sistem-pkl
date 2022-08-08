<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Mail\NotifyUploadNilai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function show($guard, $id)
    {
        if (! (Auth::guard($guard)->user()))
        {
            abort(403);
        }

        $user       = Auth::guard($guard)->user();

        $data = [
            'title' => 'Daftar Kegiatan',
            'guard' => $user->guardname,
            'data'  => Activity::findOrFail($id),
            'user'  => $user
        ];

        return view('public.activity.show', $data);
    }
    public function guidance($guard)
    {
        if (! (Auth::guard($guard)->user()))
        {
            abort(403);
        }

        $user       = Auth::guard($guard)->user();
        $activity   = Activity::select('jenis_kegiatan_uuid')->orderBy('jenis_kegiatan_uuid', 'asc')->distinct()->get();

        foreach ($activity as $key => $value) {
            if ($guard == 'lecturer') {
                $activity[$key]->list_guidance = Activity::where('jenis_kegiatan_uuid', $value->jenis_kegiatan_uuid)->where('dosen_uuid', $user->uuid)->orderBy('mitra_uuid', 'asc')->paginate(5);
            } else {
                $activity[$key]->list_guidance = Activity::where('jenis_kegiatan_uuid', $value->jenis_kegiatan_uuid)->where('mitra_uuid', $user->uuid)->orderBy('mitra_uuid', 'asc')->paginate(5);
            }
        }

        $data = [
            'title' => 'Daftar Bimbingan',
            'guard' => $user->guardname,
            'data'  => $activity,
            'user'  => $user
        ];

        return view('public.activity.guidance', $data);
    }

    public function uploadFileActivity(Request $request, $id)
    {
        $request->validate([
            'file_jurnal_kegiatan' => 'max:5000',
            'file_laporan_kegiatan' => 'max:5000',
            'file_penilaian_kegiatan' => 'max:5000'
        ], [
            'file_jurnal_kegiatan.max' => 'File Tidak Boleh Lebih Besar Dari 5Mb',
            'file_laporan_kegiatan.max' => 'File Tidak Boleh Lebih Besar Dari 5Mb',
            'file_penilaian_kegiatan.max' => 'File Tidak Boleh Lebih Besar Dari 5Mb',
        ]);

        $laporan = Activity::findOrFail($id);

        if ($request->hasFile('file_jurnal_kegiatan')) {
            Storage::delete($laporan->file_jurnal_kegiatan);
            $file_image     = request()->file('file_jurnal_kegiatan');
            $fileNameImg    = $id . '-' . time() . '.' . $file_image->extension();
            $laporan->file_jurnal_kegiatan = $file_image->storeAs('file/file_jurnal_kegiatan', $fileNameImg, "public");
            $laporan->save();

            return redirect()->back()->with('info', 'File Journal Activity Sah Telah Berhasil Diupload');
        }

        if ($request->hasFile('file_laporan_kegiatan')) {
            Storage::delete($laporan->file_laporan_kegiatan);
            $file_image     = request()->file('file_laporan_kegiatan');
            $fileNameImg    = $id . '-' . time() . '.' . $file_image->extension();
            $laporan->file_laporan_kegiatan = $file_image->storeAs('file/file_kegiatan', $fileNameImg, "public");
            $laporan->save();

            return redirect()->back()->with('info', 'Laporan Activity Telah Berhasil Diupload');
        }

        if ($request->hasFile('file_penilaian_kegiatan')) {
            Storage::disk('public')->delete($laporan->file_penilaian_kegiatan);
            $file_nilai     = request()->file('file_penilaian_kegiatan');
            $fileName       = $id . '-' . time() . '.' . $file_nilai->extension();
            $laporan->file_penilaian_kegiatan = $file_nilai->storeAs('file/file_penilaian_kegiatan', $fileName, "public");
            $laporan->save();

            try {
                // Disabled
                // Mail::to([$laporan->admin_prodi()->first()->email,$laporan->lecturer()->first()->email])->queue(new NotifyUploadNilai($laporan->student()->first()));
            } catch (\Exception $ex) {

            }

            return redirect()->back()->with('info', 'Penilaian Telah Berhasil Diupload');
        }

        return redirect()->back()->with('warning', 'Gagal upload');
    }
}
