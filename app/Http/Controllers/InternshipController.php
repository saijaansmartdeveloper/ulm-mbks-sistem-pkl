<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class InternshipController extends Controller
{

    public function uploadInternship (Request $request, $id)
    {
        $laporan = Activity::findOrFail($id);

        if ($request->hasFile('file_jurnal_magang')) {
            $file_image     = request()->file('file_jurnal_magang');
            $fileNameImg    = $id . '-' . time() . '.' . $file_image->extension();
            $laporan->file_jurnal_magang = $file_image->storeAs('file/file_jurnal_kegiatan', $fileNameImg, "public");
            $laporan->save();

            return redirect()->back()->with('info', 'File Journal Activity Sah Telah Berhasil Diupload');
        }

        if ($request->hasFile('file_laporan_magang')) {
            $file_image     = request()->file('file_laporan_magang');
            $fileNameImg    = $id . '-' . time() . '.' . $file_image->extension();
            $laporan->file_laporan_magang = $file_image->storeAs('file/file_kegiatan', $fileNameImg, "public");
            $laporan->save();

            return redirect()->back()->with('info', 'Laporan Activity Telah Berhasil Diupload');
        }

        return redirect()->back()->with('warning', 'Gagal upload');
    }
}
