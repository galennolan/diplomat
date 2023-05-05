@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')


<div class="d-sm-flex align-items-center justify-content-between mb-4">
 <h1 class="h3 mb-0 text-gray-800">Diplomat Mild Customer Data Last 30 days</h1>
 </div>

<hr>
@if(!auth()->user()->hasRole('admin'))
<div class="card-header py-3" align="right">
<a href="{{ route('sales.index') }}" class="btn btn-sm btn-danger shadow-sm">
    <i class="fas fa-plus fa-sm text-white-50"></i> Tambah
</a>
</div>
@endif

<div class="d-sm-flex align-items-center justify-content-between mb-4">
<div class="card-body">
<div class="table-responsive">
    <table class="table table-bordered tables-striped" id="dataTable" width="100%" cellspacing="0">
    <thead class="thead-dark">
        <tr>
        <th>Tanggal</th>
        <th>nama Cust</th>
        <th>No Hp</th>
        <th> sales</th>
        <th>jenis_kelamin</th>
        @if(!auth()->user()->hasRole('user'))
        <th>Ubah</th>
        @endif

        </tr>
    </thead>
        <tbody>
            @foreach($customer as $cust)
            <tr>
                <td>{{ date('d/m/y', strtotime($cust->created_at)) }}</td>

                <td>{{ $cust->namacust}}</td>
                <td>{{ $cust->telp}}</td>
                <td>{{ $cust->namasales}}</td>
                <td>{{ $cust->jenis_kelamin}}</td>
                @if(!auth()->user()->hasRole('user'))
                <td align="center">
                            <a href="{{route( 'customer.edit',[$cust->idcust])}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                <i class="fas fa-edit fa-sm text-white-50"></i>
                            </a>
                            <a href="/customer/hapus/{{ $cust->idcust }}" onclick="return confirm('Yakin Ingin menghapus data?')" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                <i class="fas fa-trash-alt fa-sm text-white-50"></i> 
                            </a>
                        </td>@endif
            </tr>
    @endforeach
        </tbody>
    </table>
</div>
</div>
</div>



@endsection
