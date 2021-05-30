<?php

namespace App\Http\Controllers;

use App\Mail\UpdatedJournalNotification;
use App\Models\Journal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;

class JournalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student,lecturer');
    }

    public function index()
    {
        $user = Auth::guard('student')->user();

        $data = [
            'title'     => $user->nama_mahasiswa,
            'guard'     => $user->guard_name,
            'data'      => $user->activities()->first()
        ];

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
        $user   = Auth::guard('student')->user();

        $request->validate([
            'catatan_jurnal'            => 'required',
            'tanggal_jurnal'            => 'required',
            'file_dokumen_jurnal'       => 'nullable|max:5000',
            'file_image_jurnal'         => 'nullable|max:1024'
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
            'catatan_jurnal'        => $request->catatan_jurnal,
            'tanggal_jurnal'        => Carbon::parse($request->tanggal_jurnal)->format('Y-m-d'),
            'uuid'                  => Uuid::uuid4(),
            'kegiatan_uuid'         => $user->activities()->first()->uuid,
            'file_image_jurnal'     => $fileImage ?? null,
            'file_dokumen_jurnal'   => $fileDoc ?? null
        ]);

        // Mail::to($journal->activity()->first()->lecturer()->email)->send(new UpdatedJournalNotification($user->nama_mahasiswa . ' baru saja menambahkan jurnal kegiatan!', $journal, 'student'));

        return redirect()->route('public.journal.index')->with('success', 'Journal berhasil Dibuat');
    }

    public function show($id)
    {
        $user = Auth::guard('student')->user();

        $data = [
            'title'     => 'Detail Jurnal',
            'guard'     => $user->guard_name,
            'data'      => Journal::findOrFail($id),
            'user'      => $user
        ];

        return view("public.jurnal.show", $data);
    }

    // public function edit($id)
    // {
    //     $user   = Auth::guard('student')->user();

    //     $data = [
    //         'title'     => $user->nama_mahasiswa,
    //         'guard'     => 'student',
    //         'data'      => Journal::findOrFail($id)
    //     ];

    //     return view("public.jurnal.form", $data);
    // }

    // public function update(Request $request, $id)
    // {

    //     $user = Auth::guard('student')->user();

    //     $request->validate([
    //         'catatan_jurnal'            => 'required',
    //         'tanggal_jurnal'            => 'required',
    //     ]);

    //     $jurnal = Journal::find($id);
    //     $jurnal->catatan_jurnal = $request->catatan_jurnal;
    //     $jurnal->tanggal_jurnal = $request->tanggal_jurnal;
    //     $jurnal->status_jurnal  = 'resubmit';

    //     if ($request->hasFile('file_image_jurnal')) {
    //         $file_image     = request()->file('file_image_jurnal');
    //         $fileNameImg    = $user->nim_mahasiswa . '_' . time() . '.' . $file_image->extension();
    //         $jurnal->file_image_jurnal = $file_image->storeAs('file/file_image_jurnal', $fileNameImg, "public");
    //     }

    //     if ($request->hasFile('file_dokumen_jurnal')) {
    //         $file_doc       = request()->file('file_dokumen_jurnal');
    //         $fileNameDoc    = $user->nim_mahasiswa . '_' . time() . '.' . $file_doc->extension();
    //         $jurnal->file_dokumen_jurnal = $file_image->storeAs('file/file_dokumen_jurnal', $fileNameDoc, "public");
    //     }

    //     $jurnal->save();

    //     Mail::to($jurnal->activity()->first()->lecturer()->email)->send(new UpdatedJournalNotification($user->nama_mahasiswa . ' baru saja mengubah jurnal kegiatan!', $jurnal, 'student'));

    //     return redirect()->route('public.journal.index')->with('success', 'Journal berhasil Diperbarui');
    // }

    // public function destroy($id)
    // {
    //     //
    // }

    // public function verify($id)
    // {

    // }

    // public function print()
    // {
    //     abort(404);
    //     $user   = Auth::guard('student')->user();
    //     $data = [
    //         'title'     => $user->nama_mahasiswa,
    //         'guard'     => 'student',
    //         'data'      => null
    //     ];

    //     return view('public.jurnal.print', $data);
    // }

    // public function print_proc(Request $request)
    // {
    //     $from   = Carbon::parse($request->date_from)->toDateString();
    //     $to     = Carbon::parse($request->date_to)->toDateString();

    //     $user   = Auth::guard('student')->user();
    //     $data = [
    //         'title'     => $user->nama_mahasiswa,
    //         'guard'     => 'student',
    //         'data'      => [
    //             'from'      => $from,
    //             'to'        => $to,
    //             'journals'  => Journal::whereBetween('tanggal_jurnal', [$from, $to])->orderBy('tanggal_jurnal', 'asc')->get() ?? null
    //         ]
    //     ];


    //     return view('public.jurnal.print', $data);
    // }
}
