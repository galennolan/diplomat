@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')
<form action="{{route('supplier.update', [$supplier->kd_supp])}}" method="POST">
 @csrf
 <input type="hidden" name="_method" value="PUT">
 <fieldset>
 <legend>Ubah Data Supplier</legend>
 <div class="form-group row">
 <div class="col-md-5">
 <label for="Kode_supplier">Kode Supplier</label>
 <input class="formcontrol" type="text" name="addkdsupp" value="{{$supplier->kd_supp}}" readonly>
 </div>
 <div class="col-md-5">
 <label for="nama_supplier">Nama Supplier</label>
 <input id="addnmsupp" type="text" name="addnmsupp" class="formcontrol" value="{{$supplier->nm_supp}}">
 </div>
 <div class="col-md-5">
 <label for="alamat">Alamat</label>
 <input id="addalamat" type="text" name="addalamat" class="formcontrol" value="{{$supplier->alamat}}">
 </div>
 <div class="col-md-5">
 <label for="tel">Telepon</label>
 <input id="addtel" type="text" name="addtel" class="formcontrol" value="{{$supplier->telepon}}">
 </div>
 </fieldset>
 <div class="col-md-10">
 <input type="submit" class="btn btn-success btn-send" value="Update">
 <a href="{{ route('supplier.index') }}"><input type="Button" class="btn-primary btn-send" value="Kembali"></a>
 </div>
 <hr>
</form>
@endsection