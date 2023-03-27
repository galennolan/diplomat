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
        <th>Nama</th>
        <th>kabupaten</th>
        <th>Provinsi</th>
        <th>No Hp</th>
        <th>nama sales</th>
        <th>Aksi</th>
        </tr>
    </thead>
        <tbody>
            @foreach($customer as $cust)
            <tr>
                <td>{{ $cust->namacust}}</td>
                <td>{{$cust->nama_kabupaten}}</td>
                <td>{{ $cust->nama_provinsi}}</td>
                <td>{{ $cust->no_hp}}</td>
                <td>{{ $cust->namasales}}</td>
                <td align="center"><a href="{{route('customer.edit',[$cust->id])}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Edit</a>
                <a href="#" onclick="return confirm('Yakin Ingin menghapus data?')" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
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
            <label class="font-weight-bold" for="exampleFormControlSelect1">1. Nama</label>
            <select class="form-control" id="name" name="name" >
            <option>Joko</option>
            <option>Waluyo</option>
            <option>Bambang</option>
            <option>Habibie</option>
            <option>Mahfud</option>
            </select>
        </div>     
            
            <div class="form-group">
            <label class="font-weight-bold" for="exampleFormControlInput1">2. Provinsi</label>
            <select style="width: 200px" class="productcategory" name="prod_cat_id" id="prod_cat_id">
                
                <option value="0" disabled="true" selected="true">-Select-</option>
                @foreach($Provinsi as $cat)
                    <option value="{{$cat->id}}">{{$cat->nama_provinsi}}</option>
                @endforeach

            </select>
   
            <label class="font-weight-bold" for="exampleFormControlInput1">  Kabupaten </label>
            <select style="width: 200px" class="nama_kabupaten" name="op" id="op">

                <option value="0" disabled="true" selected="true">Kabupaten</option>
            </select>

            </div>

            <div class="form-group">
            <label class="font-weight-bold" for="exampleFormControlInput1">3. Venue</label>
            <input type="text" name="venue" id="address" class="form-control">
            </div>

        <div class="form-group">
            <label class="font-weight-bold" for="exampleFormControlInput1">4. No Telp/Email/IG/FB</label>
            <input type="text" name="telp" id="telp" class="form-control">
        </div>

        <div class="form-group">
            <label class="font-weight-bold" for="jenis_kelamin">5. Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
            <option>Laki-laki</option>
            <option>Perempuan</option>
            </select>
        </div>
        
        <div class="form-group">
            <label class="font-weight-bold" for="exampleFormControlInput1">6. Umur</label>
            <input type="number" name="umur" id="addstok" class="form-control" id="exampleFormControlInput1" >
        </div>

        <div class="form-group">
            <label class="font-weight-bold" for="exampleFormControlSelect1">7. Pekerjaan</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="pekerjaan" id="inlineRadio1" value="Karyawan">
            <label class="form-check-label" for="inlineRadio1">Karyawan</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="pekerjaan" id="inlineRadio2" value="Mahasiswa">
            <label class="form-check-label" for="inlineRadio2">Mahasiswa</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="pekerjaan" id="inlineRadio2" value="PNS">
            <label class="form-check-label" for="inlineRadio2">PNS</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="pekerjaan" id="inlineRadio2" value="Wiraswasta">
            <label class="form-check-label" for="inlineRadio2">Wiraswasta</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="pekerjaan" id="inlineRadio3" value="3 (disabled)" disabled>
            <label class="form-check-label" for="inlineRadio3">3 (disabled)</label>
        </div>
        </div>

        <div class="form-group">
            <label class="font-weight-bold" for="merk_rokok">8. Rokok yang dikonsumsi selama ini</label>
            <select class="form-control" id="merk_rokok" name="merk_rokok">
            <option>Diplomat Mild</option>
            <option>Diplomat </option>
            <option>Dji Sam Soe </option>

            </select>
        </div>

        <div class="form-group">
            <label class="font-weight-bold" for="jml_beli">9. Jumlah Beli Rokok Pack</label>
            <input type="number" name="jml_beli" id="jml_beli" class="form-control">
        </div>
        
        <div class="form-group">
            <label class="font-weight-bold" for="exampleFormControlInput1">10. Diplomat MILD </label>
            <input type="number" name="diplomatmild" id="addstok" class="form-control" id="exampleFormControlInput1" >
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
 

 


<script type="text/javascript">
	$(document).ready(function(){

		$(document).on('change','.productcategory',function(){
			// console.log("hmm its change");

			var id=$(this).val();
			// console.log(cat_id);
			var div=$(this).parent();

			var op=" ";

			$.ajax({
				type:'get',
				url:'{!!URL::to('findProductName')!!}',
				data:{'id':id},
				success:function(data){
					//console.log('success');

					//console.log(data);

					//console.log(data.length);
					op+='<option value="0" selected disabled>chose kabupaten</option>';
					for(var i=0;i<data.length;i++){
					op+='<option value="'+data[i].id+'">'+data[i].nama_kabupaten+'</option>';
				   }

				   div.find('.nama_kabupaten').html(" ");
				   div.find('.nama_kabupaten').append(op);
				},
				error:function(){

				}
			});
		});

		
	});
</script>

@endsection
