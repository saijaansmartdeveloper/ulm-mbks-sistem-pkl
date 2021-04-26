<?php

namespace App\Http\Controllers;

use App\Models\Magang;
use Illuminate\Http\Request;

class InternshipController extends Controller
{

    public function uploadInternship (Request $request, $id)
    {
        $laporan = Magang::findOrFail($id);

        if ($request->hasFile('file_jurnal_magang')) {
            $file_image     = request()->file('file_jurnal_magang');
            $fileNameImg    = $id . '-' . time() . '.' . $file_image->extension();
            $laporan->file_jurnal_magang = $file_image->storeAs('file/file_jurnal_magang', $fileNameImg, "public");
            $laporan->save();

            return redirect()->back()->with('info', 'File Jurnal Magang Sah Telah Berhasil Diupload');
        }

        if ($request->hasFile('file_laporan_magang')) {
            $file_image     = request()->file('file_laporan_magang');
            $fileNameImg    = $id . '-' . time() . '.' . $file_image->extension();
            $laporan->file_laporan_magang = $file_image->storeAs('file/file_laporan_magang', $fileNameImg, "public");
            $laporan->save();

            return redirect()->back()->with('info', 'Laporan Magang Telah Berhasil Diupload');
        }

        return redirect()->back()->with('warning', 'Gagal upload');
    }
}
