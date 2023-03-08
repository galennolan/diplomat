@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')



          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Daily Report Performance Female Presenter</h1>            
          </div>
        <div class="row g-2">
          <div class="col-md-6 mb-3">
          <div class="form-floating">
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

          <div class="col-md-6 mb-3">
          <div class="form-floating">
              <label class="font-weight-bold" for="exampleFormControlSelect1">Female Presenter</label>
              <select class="form-control" id="exampleFormControlSelect1">
              <option>Jeni</option>
              <option>Ines</option>
              <option>Uut</option>
              <option>Evelyn</option>
              <option>Vee</option>
              </select>
          </div>
          </div>

        </div>

        <div class="row g-2">
        <div class="col-md-6 mb-3">
        <div class="form-floating">
          <label for="exampleFormControlInput1">Tanggal Mulai</label>
          <input type="date" min="1" name="tgl" id="addnmbrg" class="form-control" id="exampleFormControlInput1" required >
          </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="form-floating">
              <label for="exampleFormControlInput1">Tanggal Selesai</label>
              <input type="date" min="1" name="tgl" id="addnmbrg" class="form-control" id="exampleFormControlInput1" required >
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card h-100">
              <canvas class="chart" id="myChart" width="600" height="200"></canvas>
            </div>
          </div>
          </div>

          <div class="row ">
          <div class="col-md-6 mb-3">
            <div class="card-body h-100">
            <label class="control-label font-weight-bold" for="inputTableName">ECC (Efektivitas Customer Contact)</label>
              <div class="table-responsive">
                  <table class="table table-sm table-bordered tables-striped" id="dataTable2" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                      <tr>
                      <th>Day</th>
                      <th>Target</th>
                      <th>Achievement</th>
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
                  @endforeach
                  <tr> -->
                        <td>7 Feb</td>
                        <td>35</td>
                        <td>109</td>
                        <td>108%</td>
                      </tr>
                      <tr>
                        <td>8 Feb</td>
                        <td>35</td>
                        <td>111</td>
                        <td>108%</td>
                      </tr>
                      <tr>
                        <td>9 Feb</td>
                        <td>35</td>
                        <td>100</td>
                        <td>108%</td>
                      </tr>
                      <tr>
                        <td>10 Feb</td>
                        <td>35</td>
                        <td>99</td>
                        <td>108%</td>
                      </tr>
                  </tbody>
                  <tfoot class="thead-light">
                      <tr>
                      <th>Day</th>
                      <th>Target</th>
                      <th>Achievement</th>
                      <th>%</th>
                
                      </tr>
                    </tfoot>
                  </table>
              </div>
        </div>
            </div>
            <div class="col-md-6 mb-3">
            <div class="card-body ">
              
            <label class="control-label font-weight-bold" for="inputTableName">Pack Selling</label>
              <div class="table-responsive">
                  <table class="table table-sm table-bordered tables-striped" id="dataTable" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                      <tr>
                      <th>Day</th>
                      <th>Target</th>
                      <th>Achievement</th>
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
                  <td>7 Feb</td>
                        <td>35</td>
                        <td>109</td>
                        <td>108%</td>
                      </tr>
                      <tr>
                        <td>8 Feb</td>
                        <td>35</td>
                        <td>111</td>
                        <td>108%</td>
                      </tr>
                      <tr>
                        <td>9 Feb</td>
                        <td>35</td>
                        <td>100</td>
                        <td>108%</td>
                      </tr>
                      <tr>
                        <td>10 Feb</td>
                        <td>35</td>
                        <td>99</td>
                        <td>108%</td>
                      </tr>
                  </tbody>
                  <tfoot class="thead-light">
                      <tr>
                      <th>Total</th>
                      <th>600</th>
                      <th>679%</th>
                      <th>109%</th>
                
                      </tr>
                  </tfoot>
                  </tbody>
                  </table>
              </div>
        </div>
          </div>
        
          
        

<script>


var xValues = ["7 Feb", "8 Feb", "9 Feb", "10 Feb", "11 Feb"];
var yValues = [55, 49, 44, 24, 15,8];
var barColors = [
      'rgba(255, 99, 132, 0.5)',
      'rgba(255, 159, 64, 0.5)',
      'rgba(255, 205, 86, 0.5)',
      'rgba(75, 192, 192, 0.5)',
      'rgba(54, 162, 235, 0.5)',];

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