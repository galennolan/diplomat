@extends('layouts.layout')
@section('content')
<form action="{{route('admin.update', [$user->id])}}" method="POST">
@csrf
    <input type="hidden" name="_method" value="PUT">
        <fieldset>
            <legend>Ubah Akses User</legend>
            <div class="form-group row">
            <div class="col-md-2">
                <label for="kode">Kode User</label>
                <input class="form-control" type="text" name="kode" value="{{$user->id}}" readonly>
            </div>
            <div class="col-md-5">
                <label for="user">Nama User</label>
                <input id="name" type="text" name="uname" class="form-control"  value="{{$user->name}}" readonly>
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-3">
                <label for="email">Email</label>
                <input id="email" type="text" name="email" class="form-control" value="{{$user->email}}" >
            </div>
            
         
            <div class="col-md-3">
                        <label for="Password">Password User</label>
                            
                                <input id="password" type="text" name="password" class="form-control" value="{{$user->password}}">
                            
                        </div>
                        
            <div class="col-md-2">
            @foreach ($user ->roles as $role)
                <label for="akses">Akses</label>
                <input id="akses" type="text" name="akses" class="form-control" value="{{$role->id}}"readonly>
            @endforeach
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-2">
                <label for="akses">Ubah Akses</label>
                <select id="roles" name="role" class="form-control" required>
                    <option value="1" {{$role->id == '1' ? 'selected' : ''}}>Admin</option>
                    <option value="3" {{$role->id == '3' ? 'selected' : ''}}>Admin Area</option>
                    <option value="4" {{$role->id == '4' ? 'selected' : ''}}>Team Leader</option>
                    <option value="2" {{$role->id == '2' ? 'selected' : ''}}>SPG</option>
                </select>
            </div>

            
            <div class="col-md-3">
                <label for="akses">Tentukan Area</label>
                <select id="area" name="area" class="form-control" required <?php if ($role->id == '1') echo 'disabled' ?>>
                    <option value="Solo" {{$user->area == 'Solo' ? 'selected' : ''}}>Solo</option>
                    <option value="Yogyakarta" {{$user->area == 'Yogyakarta' ? 'selected' : ''}}>Yogyakarta</option>
                    <option value="Semarang" {{$user->area == 'Semarang' ? 'selected' : ''}}>Semarang</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="akses">Tentukan Tim</label>
                <select id="tim" name="tim" class="form-control" required <?php if ($role->id == '1'||$role->id == '3') echo 'disabled' ?>>
                    <option value="" selected>{{$user->tim}}</option>
                    <option value="Solo1" {{$user->area == 'Solo1' ? 'selected' : ''}}>Solo1 </option>
                    <option value="Solo2"  {{$user->area == 'Solo2' ? 'selected' : ''}}>Solo2 </option>
                    <option value="Yogyakarta1" {{$user->area == 'Yogyakarta1' ? 'selected' : ''}}>Yogyakarta1 </option>
                    <option value="Yogyakarta2" {{$user->area == 'Yogyakarta2' ? 'selected' : ''}}>Yogyakarta2 </option>
                    <option value="Semarang" {{$user->area == 'Semarang' ? 'selected' : ''}}>Semarang</option>>
                </select>
            </div>

            @if (!in_array($role->id, [1, 3, 4]))
                <div class="col-md-3">
                    <label for="akses">Tim Leader</label>
                    <select id="tl" name="tl" class="form-control" required>
                    @php
                        $tl_name = DB::table('users')->select('name')->where('id', $user->tl)->first()->name ?? '';
                    @endphp
                    <option value="{{ $user->tl }}">{{ $tl_name }}</option>
                        @foreach($teamleader  as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

</fieldset>
            <div class="col-md-10">
             <input type="submit" class="btn btn-success btn-send" value="Ubah Akses">

                    <a href="{{ route('admin.index') }}"><input type="Button" class="btn btn-primary btn-send" value="Kembali"></a>

</div>
<hr>
</form>
@endsection