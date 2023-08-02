<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function index()
    {
        return Template::load('admin', 'Users', 'users', 'view');
    }

    public function get_data_dt()
    {
        $data = User::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('active', function ($row) {
                $status = ($row->active == 'y') ? '<i class="fa fa-check"></i>&nbsp;<span>Aktif</span>' : '<i class="fa fa-times"></i>&nbsp;<span>Tidak Aktif</span>';
                $button = ($row->active == 'y') ? 'btn-success' : 'btn-danger';

                return '
                    <button type="button" id="sts" data-id="' . my_encrypt($row->id_users) . '" class="btn btn-sm ' . $button . '">' . $status . '</button>
                ';
            })
            ->addColumn('action', function ($row) {
                return '<button type="button" id="res-pass" data-id="' . my_encrypt($row->id_users) . '" class="btn btn-sm btn-warning"><i class="fa fa-undo"></i>&nbsp;<span>Reset Password</span></button>';
            })
            ->rawColumns(['active', 'action'])
            ->make(true);
    }

    public function save(Request $request)
    {
        try {
            $id_users = get_acak_id(User::class, 'id_users');

            User::create([
                'id_users' => $id_users,
                'nama'     => $request->nama,
                'email'    => $request->email,
                'username' => $request->username,
                'password' => Hash::make('12345678'),
                'roles'    => $request->roles,
                'active'   => 'y',
                'by_users' => $this->session['id_users'],
            ]);

            $response = ['status' => true, 'title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['status' => false, 'title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return Response::json($response);
    }

    public function active(Request $request)
    {
        try {
            $data = User::find(my_decrypt($request->id));
            $data->active = ($data->active == 'y') ? 'n' : 'y';
            $data->save();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Ubah!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Ubah!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
        }
        return Response::json($response);
    }

    public function reset_password(Request $request)
    {
        try {
            $data = User::find(my_decrypt($request->id));
            $data->password = Hash::make('12345678');
            $data->save();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Kembalikan!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Kembalikan!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
        }
        return Response::json($response);
    }
}
