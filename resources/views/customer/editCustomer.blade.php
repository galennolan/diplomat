@extends('layouts.layout')

@section('content')
@include('sweetalert::alert')
<form action="{{route('customer.update', [$customer->id])}}" method="POST">
    @csrf
    @method('PUT')
    <fieldset>
        <legend>Ubah Data Customer</legend>
        <div class="form-group row">
            <div class="col-md-5">
                <label for="id">Kode Customer</label>
                <input class="form-control" type="text" name="id" value="{{$customer->id}}" readonly>
            </div>
            <div class="col-md-5">
                <label for="name">Nama Customer</label>
                <input id="addnmbrg" type="text" name="name" class="form-control" value="{{$customer->name}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-5">
                <label for="Harga">Harga</label>
                <input id="addharga" type="text" name="addharga" class="form-control" value="{{$customer->address}}">
            </div>
            <div class="col-md-5">
                <label for="Stok">Stok</label>
                <input id="addstok" type="text" name="addstok" class="form-control" value="{{$customer->venue}}">
            </div>
   
        </div>
    </fieldset>
    <div class="col-md-10">
        <input type="submit" class="btn btn-success btn-send" value="Update">
        <a href="{{ route('customer') }}"><input type="Button" class="btn-primary btn-send" value="Kembali"></a>
    </div>
    <hr>
</form>
@endsection
