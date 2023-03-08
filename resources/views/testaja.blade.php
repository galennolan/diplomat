@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')



          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Customer Report</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>
            </div>
            
          </div>
        <div class="row">
        <div class="col mb-3">
            <label class="font-weight-bold" for="exampleFormControlSelect1">Area</label>
            <select class="form-control" id="exampleFormControlSelect1">
            <option>Solo</option>
            <option>Karanganyar</option>
            <option>Wonogiri</option>
            <option>Sukoharjo</option>
            <option>Sragen</option>
            </select>
        </div>
        </div>

        <div class="row g-2">
        <div class="col-md-6 mb-3">
        <div class="form-floating">
          <label for="exampleFormControlInput1">Tanggal Transaksi</label>
          <input type="date" min="1" name="tgl" id="addnmbrg" class="form-control" id="exampleFormControlInput1" required >
          </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="form-floating">
              <label for="exampleFormControlInput1">Tanggal Transaksi</label>
              <input type="date" min="1" name="tgl" id="addnmbrg" class="form-control" id="exampleFormControlInput1" required >
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="card h-100">
        <canvas class="chart" id="myChart" width="400" height="200"></canvas>
        </div>
            </div>
            <div class="col-md-6 mb-3">
            <div class="card body">
        <canvas class="chart" id="myChart2" width="400" height="200"></canvas>
        </div>
            </div>
          </div>

          <div class="row ">
          <div class="col-md-6 mb-3">
            <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-sm table-bordered tables-striped" id="dataTable2" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                      <tr>
                        <th>Name</th>
                        <th>Diplomat Mild</th>
                        <th>A Mild</th>
                        <th>Class Mild</th>
                        <th>Magnum Mild</th>
                        <th>Pro Mild</th>
                        <th>U Mild</th>
                        <th>Others</th>
                        <th>Total</th>
                        <th>%</th>
                      </tr>
                      </thead>
                      <tbody>
                      <!-- @foreach($barang as $brg)
                      <tr>
                      <td>{{ $brg->kd_brg}}</td>
                      <td>{{ $brg->nm_brg}}</td>
                      <td>{{ number_format($brg->harga)}}</td>
                      <td>{{ number_format($brg->stok)}}</td>
                     
                      </tr>
                  @endforeach -->
                        <td>Mall</td>
                        <td>35</td>
                        <td>109</td>
                        <td>35</td>
                        <td>109</td>
                        <td>35</td>
                        <td>109</td>
                        <td>35</td>
                        <td>109</td>
                        <td>108%</td>
                      </tr>
                      <tr>
                        <td>WARTEG</td>
                        <td>109</td>
                        <td>35</td>
                        <td>109</td>
                        <td>35</td>
                        <td>109</td>
                        <td>35</td>
                        <td>109</td>
                        <td>108%</td>
                        <td>108%</td>
                      </tr>
                      <tr>
                      <td>SC</td>
                        <td>109</td>
                        <td>35</td>
                        <td>109</td>
                        <td>35</td>
                        <td>109</td>
                        <td>35</td>
                        <td>109</td>
                        <td>108%</td>
                        <td>108%</td>
                      </tr>
                      <tr>
                      <td>KANTOR</td>
                        <td>109</td>
                        <td>35</td>
                        <td>109</td>
                        <td>35</td>
                        <td>109</td>
                        <td>35</td>
                        <td>109</td>
                        <td>108%</td>
                        <td>108%</td>
                      </tr>
                      <tr>
                      <td>PA</td>
                        <td>109</td>
                        <td>35</td>
                        <td>109</td>
                        <td>35</td>
                        <td>109</td>
                        <td>35</td>
                        <td>109</td>
                        <td>108%</td>
                        <td>108%</td>
                      </tr>
                  </tbody>
                  <tfoot class="thead-light">
                      <tr>
                      <th>Total</th>
                      <th>600</th>
                      <th>600</th>
                      <th>600</th>
                      <th>679</th>
                      <th>679</th>
                      <th>679</th>
                      <th>109</th>
                      <th>109%</th>
                      <th>109%</th>
                      </tr>
                  </tfoot>
                  </tbody>
                  </table>
              </div>
        </div>
            </div>
            <div class="col-md-6 mb-3">
            <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-sm table-bordered tables-striped" id="dataTable" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                      <tr>
                      <th>Range Usia</th>
                      <th>Banyak</th>
                      <th>%</th>
                      </tr>
                      </thead>
                      <tbody>
                      <!-- @foreach($user as $us)
                      <tr>
                      <td>{{ $us->id}}</td>
                      <td>{{ $us->name}}</td>
                      <td>{{ $us->email}}</td>
                     
                      </tr>
                  @endforeach -->
                        <td>18-25 th</td>
                        <td>217</td>
                        <td>12%</td>
                      </tr>
                      <tr>
                        <td>26-30th</td>
                        <td>1380</td>
                        <td>76%</td>
                      </tr>
                      <tr>
                        <td>31-40th</td>
                        <td>203</td>
                        <td>11%</td>
                      </tr>
                      <tr>
                        <td>41-50th</td>
                        <td>14</td>
                        <td>1%</td>
                      </tr>
                      <tr>
                        <td>>50th</td>
                        <td>0</td>
                        <td>0%</td>
                      </tr>
                  </tbody>
                  <tfoot class="thead-light">
                      <tr>
                      <th>Total</th>
                      <th>1814</th>
                      <th>100%</th>
                      </tr>
                  </tfoot>
                  </tbody>
                  </table>
              </div>
        </div>
          </div>
        
        

<script>


var xValues = ["MALL", "WARTEG", "SC", "KANTOR", "PA"];
var yValues = [55, 49, 44, 24, 15,8];
var barColors = ["red", "green","blue","orange","brown"];

var aValues = ["18-25th", "26-30th", "31-40th", "41-50th", ">50th"];
var bValues = [217, 1380, 203, 14, 0];
var barColors = [
      'rgba(255, 99, 132, 0.5)',
      'rgba(255, 159, 64, 0.5)',
      'rgba(255, 205, 86, 0.5)',
      'rgba(75, 192, 192, 0.5)',
      'rgba(54, 162, 235, 0.5)',];


new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Venue"
    }
  }
});

new Chart("myChart2", {
  type: "bar",
  data: {
    labels: aValues,
    datasets: [{
      backgroundColor: barColors,
      data: bValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Umur"
    }
  }
});

new Chart("myChart3", {
  type: "bar",
  data: {
    labels: aValues,
    datasets: [{
      backgroundColor: barColors,
      data: bValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Umur"
    }
  }
});

new Chart("myChart4", {
  type: "bar",
  data: {
    labels: aValues,
    datasets: [{
      backgroundColor: barColors,
      data: bValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Umur"
    }
  }
});
</script>

@endsection