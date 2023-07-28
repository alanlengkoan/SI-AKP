<!-- begin:: base -->
@extends('admin/base')
<!-- end:: base -->

<!-- begin:: css local -->
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset_admin('my_assets/datatables/1.11.3/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset_admin('my_assets/datatables-responsive/2.2.9/css/responsive.dataTables.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset_admin('css/plugins/select2.min.css') }}" />
@endsection
<!-- end:: css local -->

<!-- begin:: content -->
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- begin:: breadcrumb -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">{{ $title }}</h5>
                        </div>
                        {{ Breadcrumbs::render('admin.operator.det', $operator) }}
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: breadcrumb -->
        <!-- begin:: body -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                    </div>
                    <div class="card-body border-top pro-det-edit collapse show" id="pro-det-edit-1">
                        <div class="form-group row">
                            <label class="col-sm-3 font-weight-bolder">Nama</label>
                            <div class="col-sm-9">
                                {{ $operator->toUser->nama }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 font-weight-bolder">Email</label>
                            <div class="col-sm-9">
                                {{ $operator->toUser->email }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 font-weight-bolder">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                {{ ($operator->kelamin === 'L' ? 'Laki - laki' : 'Perempuan') }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 font-weight-bolder">Username</label>
                            <div class="col-sm-9">
                                {{ $operator->toUser->username }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 font-weight-bolder">Foto</label>
                            <div class="col-sm-9">
                                <img src="{{ ($operator->foto === null) ? '//placehold.co/150' : asset_upload('picture/'.$operator->foto) }}" alt="{{ $operator->nama }}" width="150" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: body -->
    </div>
</div>
@endsection
<!-- end:: content -->

<!-- begin:: js local -->
@section('js')
@endsection
<!-- end:: js local -->