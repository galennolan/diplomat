@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
 <h1 class="h3 mb-0 text-gray-800">Diplomat Mild Customer Data Form</h1>
 </div>

<hr>

<div class="card-header py-3" align="right">
<button type="button" class="btn btn-sm btn-danger shadow-sm" data-toggle="modal" data-target="#exampleModalScrollable">
<i class="fas fa-plus fa-sm text-white-50"></i> Tambah
</button>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<div class="card-body">
<div class="table-responsive">
    <table class="table table-bordered tables-striped" id="dataTable" width="100%" cellspacing="0">
    <thead class="thead-dark">
        <tr>
        <th>Area</th>
        <th>Rayon</th>
        <th>Diplomat Mild Rasa</th>
        <th>Rasa</th>
        <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($barang as $brg)
        <tr>
        <td>{{ $brg->kd_brg}}</td>
        <td>{{ $brg->nm_brg}}</td>
        <td>{{ number_format($brg->harga)}}</td>
        <td>{{ number_format($brg->stok)}}</td>
        <td align="center"><a href="{{route('barang.edit',[$brg->kd_brg])}}" class=" btn btn-sm btn-success shadow-sm">
        <i class="fas fa-edit fa-sm text-white-50"></i> Edit</a>
        <a href="/barang/hapus/{{$brg->kd_brg}}" onclick="return confirm('Yakin Ingin menghapus data?')" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
        <i class="fas fa-trash-alt fa-sm text-white-50"></i> Hapus</a>
        </td>
        </tr>
    @endforeach
    </tbody>
    </table>
</div>
</div>
</div>
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Diplomat Mild Customer Data Form
</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
        <form action="#" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="font-weight-bold" for="exampleFormControlSelect1">1. Area</label>
            <select class="form-control" id="exampleFormControlSelect1">
            <option>Solo</option>
            <option>Karanganyar</option>
            <option>Wonogiri</option>
            <option>Sukoharjo</option>
            <option>Sragen</option>
            </select>
        </div>

        <div class="form-group">
            <label class="font-weight-bold"  for="exampleFormControlSelect1">2. Rayon</label>
            <select class="form-control" id="exampleFormControlSelect1">
            <option>Solo</option>
            <option>Karanganyar</option>
            <option>Wonogiri</option>
            <option>Sukoharjo</option>
            <option>Sragen</option>
            </select>
        </div>

            <div class="form-group">
                <label class="font-weight-bold" for="exampleFormControlInput1">3. Kabupaten / Kecamatan</label>
                <input type="text" name="addkdbrg" id="addkdbrg" class="form-control" maxlegth="5" id="exampleFormControlInput1" >
            </div>

        <div class="form-group">
            <label class="font-weight-bold" for="exampleFormControlSelect1">4. Venue</label>
            <select class="form-control" id="exampleFormControlSelect1">
            <option>Pusat Perbelanjaan</option>
            <option>PA</option>
            <option>Warung</option>
            <option>Cafe</option>
            <option>Toko Kelontong</option>
            </select>
        </div>
            <div class="form-group">
                <label class="font-weight-bold" for="exampleFormControlInput1">5. Nama Pelanggan</label>
                <input type="text" name="addkdbrg" id="addkdbrg" class="form-control" maxlegth="5" id="exampleFormControlInput1" >
            </div>
        <div class="form-group">
            <label class="font-weight-bold" for="exampleFormControlInput1">6. No Telp/Email/IG/FB</label>
            <input type="text" name="addnmbrg" id="addnmbrg" class="form-control" id="exampleFormControlInput1" >
        </div>

        <div class="form-group">
            <label class="font-weight-bold" for="exampleFormControlSelect1">7. Jenis Kelamin</label>
            <select class="form-control" id="exampleFormControlSelect1">
            <option>Laki-laki</option>
            <option>Perempuan</option>
            </select>
        </div>
        
        <div class="form-group">
            <label class="font-weight-bold" for="exampleFormControlInput1">8. Umur</label>
            <input type="number" name="addstok" id="addstok" class="form-control" id="exampleFormControlInput1" >
        </div>

        <div class="form-group">
            <label class="font-weight-bold" for="exampleFormControlSelect1">9. Pekerjaan</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
            <label class="form-check-label" for="inlineRadio1">Karyawan</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <label class="form-check-label" for="inlineRadio2">Mahasiswa</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <label class="form-check-label" for="inlineRadio2">PNS</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <label class="form-check-label" for="inlineRadio2">Wiraswasta</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
            <label class="form-check-label" for="inlineRadio3">3 (disabled)</label>
        </div>
        </div>

        <div class="form-group">
            <label class="font-weight-bold" for="exampleFormControlSelect1">10. Rokok yang dikonsumsi selama ini</label>
            <select class="form-control" id="exampleFormControlSelect1">
            <option>Diplomat Mild</option>
            <option>Diplomat </option>
            </select>
        </div>

        <div class="form-group">
            <label class="font-weight-bold" or="exampleFormControlInput1">11. Jumlah Beli Rokok Pack</label>
            <input type="number" name="addharga" id="addharga" class="form-control" id="exampleFormControlInput1" >
        </div>
        
        <div class="form-group">
            <label class="font-weight-bold" for="exampleFormControlInput1">12. Diplomat MILD </label>
            <input type="number" name="addstok" id="addstok" class="form-control" id="exampleFormControlInput1" >
        </div>
   
    
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
            <input type="submit" class="btn btn-danger btn-send" value="Simpan">
        </div>
 </div>

 </form>
 </div>
 </div>
 </div>

@endsection
