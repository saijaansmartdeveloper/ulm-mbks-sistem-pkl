<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
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
            'guard' => 'partner',
            'data'  => [
                'magang' => Kegiatan::where('mitra_uuid', $user->uuid)->get()
            ]
        ];

        return view("public.partner.index", $data);
    }

    public function guidance()
    {

    }
}
