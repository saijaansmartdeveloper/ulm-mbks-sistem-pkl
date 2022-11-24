<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Models\Comment;
use App\Models\Journal;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\UpdatedJournalNotification;

class JournalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student,lecturer,partner,web');
    }

    public function index()
    {
        $user = Auth::guard('student')->user();

        $data = [
            'title'     => 'Hari ini, ' . $user->nama_mahasiswa,
            'guard'     => $user->guard_name,
            'data'      => $user->activities()->first()
        ];

        // dd($data["data"]);

        return view("public.jurnal.index", $data);
    }

    public function create()
    {
        $user = Auth::guard('student')->user();

        $data = [
            'title'     => $user->nama_mahasiswa,
            'guard'     => $user->guard_name,
            'data'      => null
        ];

        return view("public.jurnal.form", $data);
    }


    public function store(Request $request)
    {
        $text_resource =  explode("\r\n",$request->catatan_jurnal);
        $text_edited = "";
        foreach($text_resource as $subtext){
            $text_edited = $text_edited." ".$subtext;
        }

        // dd($request->catatan_jurnal,$text_edited);

        $user   = Auth::guard('student')->user();

        $request->validate([
            'catatan_jurnal'            => 'required',
            'tanggal_jurnal'            => 'required',
            'file_dokumen_jurnal'       => 'nullable|max:5000',
            'file_image_jurnal'         => 'nullable|max:1024'
        ],[
            'catatan_jurnal.required'   => 'Catatan Jurnal Tidak Boleh Kosong',
            'tanggal_jurnal.required'   => 'Tanggal Jurnal Tidak Boleh Kosong',
            'file_dokumen_jurnal.max'   => 'File Tidak Boleh Lebih Dari 5Mb',
            'file_image_jurnal.max'     => 'Gambar Tidak Boleh Lebih Dari 1Mb'
        ]);

        if ($request->hasFile('file_image_jurnal')) {
            $file_image     = $request->file('file_image_jurnal');
            $fileNameImg    = $user->nim_mahasiswa . '_' . time() . '.' . $file_image->extension();
            $fileImage      = $file_image->storeAs('file/file_image_jurnal', $fileNameImg, "public");
        }

        if ($request->hasFile('file_dokumen_jurnal')) {
            $file_doc       = $request->file('file_dokumen_jurnal');
            $fileNameDoc    = $user->nim_mahasiswa . '_' . time() . '.' . $file_doc->extension();
            $fileDoc        = $file_doc->storeAs('file/file_dokumen_jurnal', $fileNameDoc, "public");
        }

        $journal = Journal::create([
            'catatan_jurnal'        => $text_edited,
            // 'catatan_jurnal'        => $request->catatan_jurnal,
            'tanggal_jurnal'        => Carbon::parse($request->tanggal_jurnal)->format('Y-m-d'),
            'uuid'                  => Uuid::uuid4(),
            'kegiatan_uuid'         => $user->activities()->first()->uuid,
            'file_image_jurnal'     => $fileImage ?? null,
            'file_dokumen_jurnal'   => $fileDoc ?? null
        ]);

        // Disabled
        // Mail::to($user->activities()->first()->lecturer()->first()->email)->queue(new UpdatedJournalNotification($user->activities()->first()->lecturer()->first(),$journal->uuid));

        return redirect()->route('public.student.journal')->with('success', 'Journal berhasil Dibuat');
    }

    public function show($prefix, $id)
    {
        // if (! (Auth::guard($prefix)->check()))
        // {
        //     return redirect()->route('public.user.form_login');
        // }

        $user = Auth::guard($prefix)->user();

        $data = [
            'title'     => 'Detail Jurnal',
            'guard'     => $user == null ? 'student' : $user->guard_name,
            'data'      => Journal::findOrFail($id),
            'user'      => $user
        ];

        return view("public.jurnal.show", $data);
    }

    public function print($prefix, Request $request)
    {
        if (! (Auth::guard($prefix)->check()))
        {
            abort(403);
        }

        $user = Auth::guard($prefix)->user();

        if ($request->isMethod('post')) {
            $from   = $request->from ?? null;
            $to     = $request->to ?? null;

            $journal = Journal::where('kegiatan_uuid', $user->activities()->first()->uuid)->orderBy('tanggal_jurnal', 'asc')->get();

            if ($from != null && $to != null) {
                $journal = Journal::where('kegiatan_uuid', $user->activities()->first()->uuid)->whereBetween('tanggal_jurnal', array($from, $to))->orderBy('tanggal_jurnal', 'asc')->get();
            }

            $data = [
                'from'      => $from,
                'to'        => $to,
                'journals'  => $journal
            ];

            try {
                $pdf = PDF::loadView('public.jurnal.pdf.pdf', ['data' => $data]);
                // $pdf->setWarnings(false);
                return $pdf->stream();
            } catch (\Throwable $th) {
                //throw $th;
            }
        }

        $data = [
            'title'     => 'Hari ini, ' . $user->nama_mahasiswa,
            'guard'     => $user->guard_name,
            'data'      => $data ?? null,
            'user'      => $user
        ];

        return view('public.jurnal.print', $data);
    }

    public function store_comment(Request $request)
    {
        if (! (Auth::guard('lecturer')->check()))
        {
            abort(403);
        }

        $comment = Comment::create([
            'uuid'              => Uuid::uuid4(),
            'komentar_jurnal'   => $request->komentar_jurnal != null ?  $request->komentar_jurnal : "",
            'status_updated'    => $request->status_jurnal,
            'jurnal_uuid'       => $request->jurnal_uuid,
            'dosen_uuid'        => $request->dosen_uuid
        ]);

        if ($comment) {
            $jurnal = Journal::find($request->jurnal_uuid);
            $jurnal->status_jurnal = $request->status_jurnal;
            $jurnal->save();
        }

        return redirect()->back()->with('success', 'Komentar Berhasil Ditambahkan');

    }

    public function edit($preix, $uuid)
    {
        $user   = Auth::guard('student')->user();

        $data = [
            'title'     => 'Detail Jurnal',
            'guard'     => $user->guard_name,
            'data'      => Journal::findOrFail($uuid),
            'user'      => $user
        ];

        return view("public.jurnal.form", $data);
    }

    public function update(Request $request, $id)
    {

        $user = Auth::guard('student')->user();

        $request->validate([
            'catatan_jurnal'            => 'required',
            'tanggal_jurnal'            => 'required',
        ]);

        $jurnal = Journal::find($id);
        $jurnal->catatan_jurnal = $request->catatan_jurnal;
        $jurnal->tanggal_jurnal = $request->tanggal_jurnal;
        $jurnal->status_jurnal  = 'resubmit';

        if ($request->hasFile('file_image_jurnal')) {
            $file_image     = request()->file('file_image_jurnal');
            $fileNameImg    = $user->nim_mahasiswa . '_' . time() . '.' . $file_image->extension();
            $jurnal->file_image_jurnal = $file_image->storeAs('file/file_image_jurnal', $fileNameImg, "public");
        }

        if ($request->hasFile('file_dokumen_jurnal')) {
            $file_doc       = request()->file('file_dokumen_jurnal');
            $fileNameDoc    = $user->nim_mahasiswa . '_' . time() . '.' . $file_doc->extension();
            $jurnal->file_dokumen_jurnal = $file_image->storeAs('file/file_dokumen_jurnal', $fileNameDoc, "public");
        }

        $jurnal->save();

        // disabled
        // Mail::to($jurnal->activity()->first()->lecturer()->email)->send(new UpdatedJournalNotification($user->nama_mahasiswa . ' baru saja mengubah jurnal kegiatan!', $jurnal, 'student'));

        return redirect()->route('public.student.journal')->with('success', 'Jurnal berhasil Diperbarui');
    }

    public function update_status_any($prefix, Request $request)
    {
        if ($prefix == 'lecturer') {
            $journal = Journal::whereIn('uuid', $request->ids)->update(['status_jurnal' => 'accepted']);

            return redirect()->back()->with('success', 'Pembaruan Status Jurnal Berhasil Dilakukan');
        } else if ($prefix == 'partner') {
            $journal = Journal::whereIn('uuid', $request->ids)->update(['tanggal_verifikasi_jurnal' => Carbon::today()]);

            return redirect()->back()->with('success', 'Pembaruan Status Jurnal Berhasil Dilakukan');
        }
    }

    public function destroy($id)
    {
        $journal = Journal::findOrFail($id);
        $journal->delete();

        return redirect()->route('public.student.journal')->with('success', 'Jurnal Telah Dihapus');
    }

    public function destroy_comment($prefix, $id)
    {
        $journal = Comment::findOrFail($id);
        $journal->delete();

        return redirect()->back()->with('success', 'Jurnal Telah Dihapus');
    }

}
