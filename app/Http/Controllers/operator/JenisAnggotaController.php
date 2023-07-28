<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\JenisAnggota;
use Illuminate\Http\Request;

class JenisAnggotaController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'operator');
    }

    public function get_all()
    {
        $response = JenisAnggota::select('id_jenis_anggota AS id', 'nama AS text')->orderBy('id_jenis_anggota', 'desc')->get();

        return response()->json($response);
    }
}
