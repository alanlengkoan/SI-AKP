<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\AsalSuratKeputusan;
use Illuminate\Http\Request;

class AsalSuratKeputusanController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'operator');
    }

    public function get_all()
    {
        $response = AsalSuratKeputusan::select('id_asal_surat_keputusan AS id', 'nama AS text')->orderBy('id_asal_surat_keputusan', 'desc')->get();

        return response()->json($response);
    }
}
