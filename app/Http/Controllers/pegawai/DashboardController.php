<?php

namespace App\Http\Controllers\pegawai;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'pegawai');
    }

    public function index()
    {
        return Template::load($this->session['roles'], 'Dashboard', 'dashboard', 'view');
    }
}
