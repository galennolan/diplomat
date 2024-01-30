@extends('layouts.layout')

@section('content')
@include('sweetalert::alert')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2 text-center">Sales Report </h1>
</div>
<form id="dailyreport-form" method="GET" action="{{ route('salesreport.penjualan') }}">


  @csrf <div class="row g-2">
  <div class="col-md-12 mb-3">
                  <div class="form-floating">
                        <label class="font-weight-bold" for="exampleFormControlSelect1">Area</label>
                        <select class="form-control" name="area" id="area" >
                        <option value="">Please select</option>
                    <?php if ($area == 'Semarang'): ?>
                        <option value="Semarang" selected>Semarang</option>
                    <?php elseif ($area == 'Solo'): ?>
                        <option value="Solo" selected>Solo</option>
                    <?php elseif ($area == 'Yogyakarta'): ?>
                        <option value="Yogyakarta" selected>Yogyakarta</option>
                    <?php else: ?>
                        <option value="Semarang">Semarang</option>
                        <option value="Solo">Solo</option>
                        <option value="Yogyakarta">Yogyakarta</option>
                    <?php endif; ?>
                        </select>
                    </div>
                    </div>
                  
                    
                  </div>


                  <div class="row g-2">
                  <div class="col-md-6 mb-3">
                  <div class="form-floating">
                    <label for="exampleFormControlInput1">Tanggal Mulai</label>
                    <input type="date" min="1" name="tanggalawal" id="tanggalawal" class="form-control"  required >
                    </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="form-floating">
                        <label for="exampleFormControlInput1">Tanggal Selesai</label>
                        <input type="date" min="1" name="tanggalakhir" id="tanggalakhir" class="form-control"  required >
                      </div>
                    </div>
                  </div>

                  
                        <div class="modal-footer">
                            <button id="submit-btn" type="submit" class="btn btn-primary">Submit</button>
                    
                                  <a href="{{ route('salesreport.export', ['area' => request()->input('area'), 'tanggalawal' => request()->input('tanggalawal'), 'tanggalakhir' => request()->input('tanggalakhir')]) }}" class="btn btn-success">Export to Excel</a>
                        </div>
               


</form>
<div class="col">
  <div class="card-body">
    <div class="table-responsive">

      <table class="table table-bordered table-striped"  style="font-size: xx-small; width: 100%; color:black">
        <thead class="thead-dark">
            <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Area</th>
            <th>Rayon</th>
            <th>Kab/Kec</th>
            <th>Venue</th>
            <th>Female Presenter</th>
            <th>Team Leader</th>
            <th>Nama Pelanggan</th>
            <th>Telp</th>
            <th>Gender</th>
            <th>Umur</th>
            <th>Pekerjaan</th>
            <th>Rokok yg dikonsumsi</th>
            <th>Pack</th>
            <th>Open Teartape</th>
            <th>Diplomat Mild</th>
            <th>Rasa</th>
            <th>Harga Diplomat</th>
            <th>Kemasan Diplomat</th>
            <th>Tempat Beli</th>
            <th>Beli Lagi</th>
            <th>Alasan Beli Lagi</th>
            </tr>
        </thead>
        <tbody>
                      
         
        @foreach($customer as $data)
            <tr>
            <td>{{ $data->row_number }}</td>
            <td>{{ date('d M Y', strtotime($data->created_at)) }}</td>
            <td>{{ $data->area }}</td>
            <td>{{ $data->rayon }}</td>
            <td>{{ $data->kab }}</td>
            <td>{{ $data->venue }}</td>
            <td>{{ $data->namasales}}</td>
            <td>{{ $data->teamleader}}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->telp }}</td>
            <td>{{ $data->jenis_kelamin }}</td>
            <td>{{ $data->umur }}</td>
            <td>{{ $data->pekerjaan }}</td>
            <td>{{ $data->rokok }}</td>
            <td>{{ $data->jml_beli }}</td>
            <td>{{$data->open }}</td>
            <td>{{ $data->pernahrasa }}</td>
            <td>{{ $data->rasadip }}</td>
            <td>{{ $data->hargadip  == 0 ? 'Mahal' : 'Terjangkau'}}</td>
            <td>{{ $data->kemasan }}</td>   
            <td>{{ $data->tempatbeli }}</td>             
            <td>{{ $data->akanbeli == 0 ? 'Tidak' : 'Ya' }}</td>
            <td>{{ $data->alasan }}</td>
            </tr>
            @endforeach
<!-- Display the pagination links -->
        
        </tbody>
        </table>
       
        <div class="d-flex justify-content-center">
              {{ $customer->appends(request()->except('page'))->links('vendor.sb') }}
      </div>


</div>
@endsection
