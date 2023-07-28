<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'operator');
    }

    public function get_all()
    {
        $response = Jabatan::select('id_jabatan AS id', 'nama AS text')->orderBy('id_jabatan', 'desc')->get();

        return response()->json($response);
    }
}
