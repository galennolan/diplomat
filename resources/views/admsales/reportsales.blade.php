@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
 <h1 class="h3 mb-0 text-gray-800">Report All Female Presenter </h1>
 </div>
<hr>
<form id="dailyreport-form" method="POST" action="{{ route('reportsalesall.penjualan') }}">
  @csrf <div class="row g-2 bg-white">

                <div class="col-md-6 mb-3">
                  <div class="form-floating">
                        <label class="font-weight-bold" for="exampleFormControlSelect1">Rayon</label>
                        <select class="form-control" name="rayon" id="rayon" onchange="loadData()">
                            <option value="">Please select</option>
                            <option value="Klaten">Klaten</option>
                            <option value="Solo">SOLO</option>
                            <option value="Sragen">Sragen</option>
                            <option value="Boyolali">Boyolali</option>
                            <option value="Wonogiri">Wonogiri</option>
                            <option value="Yogyakarta">Yogyakarta</option>
                            <option value="Wonosari">Wonosari</option>
                            <option value="Bantul">Bantul</option>
                            <option value="Purwodadi">Purwodadi</option>
                            <option value="Salatiga">Salatiga</option>
                        </select>
                    </div>
                    </div>
     

                  <div class="col-md-6 mb-3">
                  <div class="form-floating">
                        <label class="font-weight-bold" for="exampleFormControlSelect1">Nama Sales</label>
                        <select class="form-control" name="namasales" id="namasales" onchange="loadData()">
                            <option value="">Please select</option>
                            @foreach($orang as $user)
                            <option value="{{ $user->name}}">{{ $user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                  </div>

                
                <div class="modal-footer">
                  <button id="submit-btn" type="submit" class="btn btn-primary">Submit</button>
                  </div>
</form>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<div class="card-body">
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: small; width: 100%; color:black">
    <thead class="thead-dark">
        <tr>
            <th>Tgl</th>
            <th>Rayon</th>
            <th>Nama Sales</th>
            <th>CC</th>
            <th>ECC</th>
            
        </tr>
        </thead>
        <tbody>
        @foreach($customer as $cust)
        <tr>
            <td>{{ $cust->created_date}}</td>
            <td>{{ $cust->rayon}}</td>
            <td>{{ $cust->namasales}}</td>
            <td>{{ $cust->CC}}</td>
            <td>{{ $cust->ECC}}</td>
           
            
        </tr>
    @endforeach
    </tbody>
        <tfoot class="table-dark">
        @php
            $total_cc = 0;
            $total_ecc = 0;
            foreach ($customer as $cust) {
                $total_cc += $cust->CC;
                $total_ecc += $cust->ECC;
            }
        @endphp
        <tr>
            <td colspan="3"><strong>Total:</strong></td>
            <td><strong>{{ $total_cc }}</strong></td>
            <td><strong>{{ $total_ecc }}</strong></td>
        </tr>
    </tfoot>
    </table>
</div>
</div>
</div>

<script>
function loadData() {
    // Get the selected area and sales name
    var area = document.getElementById("area").value;
    var namasales = document.getElementById("namasales").value;

    // Send an AJAX request to the controller to fetch the data
    $.ajax({
        url: "{{ route('reportsalesall.penjualan') }}",
        type: "POST",
        data: {
            area: area,
            namasales: namasales,
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            // Clear the table body
            $("#penjualan-table tbody").empty();

            // Iterate through the response data and append it to the table
            $.each(response, function(index, data) {
                var row = $("<tr>");
                $("<td>").text(data.namasales).appendTo(row);
                $("<td>").text(data.created_date).appendTo(row);
                $("<td>").text(data.CC).appendTo(row);
                $("<td>").text(data.ECC).appendTo(row);
                $("#penjualan-table tbody").append(row);
            });

            $("#penjualan-table").show();
        },

        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}


</script>




@endsection
