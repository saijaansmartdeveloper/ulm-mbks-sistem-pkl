<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function guidance($guard)
    {
        if (! (Auth::guard($guard)->user()))
        {
            abort(403);
        }

        $user       = Auth::guard($guard)->user();
        $activity   = Activity::select('jenis_kegiatan_uuid')->orderBy('jenis_kegiatan_uuid', 'asc')->distinct()->get();

        foreach ($activity as $key => $value) {
            $activity[$key]->list_guidance = Activity::where('jenis_kegiatan_uuid', $value->jenis_kegiatan_uuid)->where('dosen_uuid', $user->uuid)->orderBy('mitra_uuid', 'asc')->get();
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
        $laporan = Activity::findOrFail($id);

        if ($request->hasFile('file_jurnal_kegiatan')) {
            $file_image     = request()->file('file_jurnal_kegiatan');
            $fileNameImg    = $id . '-' . time() . '.' . $file_image->extension();
            $laporan->file_jurnal_kegiatan = $file_image->storeAs('file/file_jurnal_kegiatan', $fileNameImg, "public");
            $laporan->save();

            return redirect()->back()->with('info', 'File Journal Activity Sah Telah Berhasil Diupload');
        }

        if ($request->hasFile('file_laporan_kegiatan')) {
            $file_image     = request()->file('file_laporan_kegiatan');
            $fileNameImg    = $id . '-' . time() . '.' . $file_image->extension();
            $laporan->file_laporan_kegiatan = $file_image->storeAs('file/file_kegiatan', $fileNameImg, "public");
            $laporan->save();

            return redirect()->back()->with('info', 'Laporan Activity Telah Berhasil Diupload');
        }

        return redirect()->back()->with('warning', 'Gagal upload');
    }
}
