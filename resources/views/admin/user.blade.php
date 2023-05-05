@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data SDM Pixel</h1>
</div>
<hr>
<div class="card-header py-3" align="right">
    <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus"></i>Tambah</button>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="20%" cellspacing="0" style="font-size: 12px; width: 100%; color:black">
                <thead>
                    <tr align="center">
                        <th width="2%">No</th>
                        <th width="4%">User</th>
                        <th width="4%">Area</th>
                        <th width="4%">Tim</th>
                        <th width="4%">Role</th>
                        <th width="4%">TIm Leader</th>
                        <th width="20%">Ubah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $row)
                    <tr>
                        <td>{{$row->id}}</td>
                        <td>{{$row->name}}</td>
                        <td style="text-align:center">{{$row->area}}
                        @foreach ($row->roles as $r)
                        @if($r->name === 'admin')
                            <i class="fas fa-window-close" style="color: #ff0000; font-size: 1.2em; display: block; margin: 0 auto ;text-align: center;"></i>
                        @endif
                        @endforeach

                        <td>{{$row->tim}}
                        
                        @if($row->hasRole('admin')||$row->hasRole('adminarea'))
                            <i class="fas fa-window-close" style="color: #0275d8; font-size: 1.2em; display: block; margin: 0 auto ;text-align: center;"></i>
                        @endif
                   
                        </td>
                        
                        <td>
                     
                        @if($row->hasRole('admin'))
                            <i class="fas fa-user-tie" style="color: #ff0000; font-size: 1.2em; display: block; margin: 0 auto ;text-align: center;"></i>
                        @elseif($row->hasRole('adminarea'))
                        <i class="fas fa-user" style="color: #fffffff; font-size: 1.2em; display: block; margin: 0 auto ;text-align: center;"></i>
                        @elseif($row->hasRole('TL'))
                        <i class="fas fa-user-friends" style="color: #5cb85c; font-size: 1.2em; display: block; margin: 0 auto ;text-align: center;"></i>
                        @else
                        @foreach ($row->roles as $r)
                        {{ $r->name === 'user' ? 'SPG' : $r->name }}
                        @endforeach
                        @endif
                        </td>
                        
                        <td>{{$row->teamleader}}
                        @if($row->hasRole('admin')||$row->hasRole('adminarea')||$row->hasRole('TL'))
                            <i class="fas fa-window-close" style="color: #0275d8; font-size: 1.2em; display: block; margin: 0 auto ;text-align: center;"></i>
                        @endif
                        </td>
                        <td align="center">
                            <a href="{{route( 'admin.edit',[$row->id])}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                <i class="fas fa-edit fa-sm text-white-50"></i>
                            </a>
                            <a href="/admin/hapus/{{ $row->id }}" onclick="return confirm('Yakin Ingin menghapus data?')" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                <i class="fas fa-trash-alt fa-sm text-white-50"></i> 
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- modal add data-->
<div class="modal inmodal fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <form name="frm_add" id="frm_add" class="form-horizontal" action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data User</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-lg-20 control-label">Nama User</label>
                        <div class="col-lg-10">
                            <input type="text" name="username" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-20 control-label">Email User</label>
                        <div class="col-lg-10">
                            <input type="email" name="email" required class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-20 control-label">Password User</label>
                            <div class="col-lg-10">
                                <input id="password" required placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                    <div class="form-group">
                        <label class="col-lg-20 control-label">Roles/Akses</label>
                        <div class="col-lg-10">
                            <select id="roles" name="roles" class="form-control" required>
                                <option value="">--Pilih Roles--</option>
                                <?php if (auth()->user()->hasRole('TL')): ?>
                                    <option value="USER" selected>SPG</option>
                                <?php elseif (auth()->user()->hasRole('adminarea')): ?>
                                    <option value="adminarea">adminarea</option>
                                    <option value="tl">Team Leader</option>
                                    <option value="USER">SPG</option>
                                <?php else: ?>
                                    <option value="ADMIN">Admin</option>
                                    <option value="adminarea">adminarea</option>
                                    <option value="tl">Team Leader</option>
                                    <option value="USER">SPG</option>
                                <?php endif; ?>
                               
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-20 control-label">Area</label>
                        <div class="col-lg-10">
                            <select id="area" name="area" class="form-control" required>
                                <option value="">--Pilih Area--</option>
                                <?php if (auth()->user()->hasRole('TL')): ?>
                                    <option value="{{auth()->user()->area}}" selected>{{auth()->user()->area}}</option>
                                <?php elseif (auth()->user()->hasRole('adminarea')): ?>
                                    <option value="{{auth()->user()->area}}" selected>{{auth()->user()->area}}</option>
                                <?php else: ?>
                                    <option value="Solo" >Solo</option>
                                    <option value="Yogyakarta" >Yogyakarta</option>
                                    <option value="Semarang">Semarang</option>>
                                <?php endif; ?>
                               
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-20 control-label">Tim</label>
                        <div class="col-lg-10">
                            <select id="tim" name="tim" class="form-control" required>
                                <option value="">Please select</option>
                            <?php if (auth()->user()->area == 'Solo'): ?>
                                <option value="Solo1">Solo1</option>
                                <option value="Solo2" selected>Solo2</option>
                            <?php elseif (auth()->user()->area == 'Yogyakarta'): ?>
                                <option value="Yogyakarta1" selected>Yogyakarta1</option>
                                <option value="Yogyakarta2">Yogyakarta2</option>
                            <?php elseif (auth()->user()->area == 'Semarang'): ?>
                                <option value="Semarang" selected>Semarang</option>
                                <option value="Salatiga">Salatiga</option>
                            <?php else: ?>
                                <option value="Solo1">Solo1</option>
                                <option value="Solo2" selected>Solo2</option>
                                <option value="Yogyakarta1" selected>Yogyakarta1</option>
                                <option value="Yogyakarta2">Yogyakarta2</option>
                                <option value="Semarang" selected>Semarang</option>
                                <option value="Salatiga">Salatiga</option>
                            <?php endif; ?>
                               
                            </select>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                    
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
