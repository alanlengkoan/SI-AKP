<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Operator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class OperatorController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function index()
    {
        return Template::load($this->session['roles'], 'Operator', 'operator', 'view');
    }

    public function det($id)
    {
        $id_operator = my_decrypt($id);

        $data = [
            'operator' => Operator::find($id_operator),
        ];

        return Template::load($this->session['roles'], 'Detail Operator', 'operator', 'det', $data);
    }

    public function get_data_dt()
    {
        $data = Operator::with(['toUser'])->orderBy('operator.id_operator', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('admin.operator.det', my_encrypt($row->id_operator)) . '" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i>&nbsp;Detail</a>
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_operator) . '" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                ';
            })
            ->make(true);
    }

    public function save(Request $request)
    {
        try {
            if ($request->id_operator === null) {
                // tambah
                $id_users = get_acak_id(User::class, 'id_users');

                $user = new User();
                $user->id_users = $id_users;
                $user->nama     = $request->nama;
                $user->email    = $request->email;
                $user->username = $request->username;
                $user->password = Hash::make('12345678');
                $user->roles    = 'operator';
                $user->active   = 'y';
                $user->save();

                $operator = new Operator();
                $operator->id_users = $id_users;
                $operator->kelamin  = $request->kelamin;
                $operator->by_users = $this->session['id_users'];
                $operator->save();
            }

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }

    public function del(Request $request)
    {
        try {
            $operator = Operator::find(my_decrypt($request->id));

            $user = User::find($operator->id_users);

            $user->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }
}
