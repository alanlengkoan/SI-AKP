<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\JenisSkpp;
use Illuminate\Http\Request;

class JenisSkppController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'operator');
    }

    public function get_all()
    {
        $response = JenisSkpp::select('id_jenis_skpp AS id', 'nama AS text', 'kode AS kode')->orderBy('id_jenis_skpp', 'desc')->get();

        return response()->json($response);
    }
}
