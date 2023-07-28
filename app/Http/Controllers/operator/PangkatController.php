<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\Pangkat;
use Illuminate\Http\Request;

class PangkatController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'operator');
    }

    public function get_all()
    {
        $response = Pangkat::select('id_pangkat AS id', 'nama AS text')->orderBy('id_pangkat', 'desc')->get();

        return response()->json($response);
    }
}
