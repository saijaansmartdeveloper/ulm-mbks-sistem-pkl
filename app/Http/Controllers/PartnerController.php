<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:partner');
    }

    public function index()
    {
        $user   = Auth::guard('partner')->user();

        $data = [
            'title' => 'Welcome, ' . $user->pamong_mitra,
            'guard' => $user->guardname,
            'data'  => [
                'jumlah_bimbingan'  => $user->activities()->first() == null ? 0 : ($user->activities()->first()->student()->count() ?? 0),
                'jumlah_jurnal'     => $user->activities()->first() == null ? 0 : ($user->activities()->first()->journals()->count() ?? 0),
                'jumlah_monev'      => $user->activities()->first() ?? 0,
                'persentase_jurnal' => "0 %",
                'persentase_monev'  => "0 %",
                'journals' => $user->activities()->first() ?? [],
                'monev' => $user->activities()->first() ?? [],
            ],
            'user'  => $user
        ];


        return view("public.partner.index", $data);
    }

    public function show($id)
    {
        if (! (Auth::guard('student')->check() || Auth::guard('lecturer')->check() || Auth::guard('partner')->check()))
        {
            abort(403);
        }

        $user   = Auth::guard('partner')->user() ?? Partner::findOrFail($id);

        $data = [
            'title'     => 'Profile ' . $user->pamong_mitra,
            'guard'     => $user->guardName(),
            'data'      => $user,
            'user'      => $user
        ];

        return view('public.student.show', $data);
    }
}
