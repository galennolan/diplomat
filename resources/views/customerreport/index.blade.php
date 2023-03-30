@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')

<div class="container-fluid">


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
  <canvas class="chart" id="myChart1" width="400" height="200"></canvas>
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

var barColors1 = ["red", "green", "blue", "orange", "brown"];
var barColors2 = [  'rgba(255, 99, 132, 0.5)',  'rgba(255, 159, 64, 0.5)',  'rgba(255, 205, 86, 0.5)',  'rgba(75, 192, 192, 0.5)',  'rgba(54, 162, 235, 0.5)',];

var kat_umur = ["18-25th", "26-30th", "31-40th", "41-50th", ">50th"];
var bValues = {!! json_encode($umur) !!}; // use Laravel's json_encode to convert the PHP array to a JavaScript array
          new Chart("myChart2", {
            type: "bar",
            data: {
              labels: kat_umur,
              datasets: [{
                backgroundColor: barColors2,
                borderColor: 'black', // Add this property to set the color of the border
                borderWidth: 0.5, 
                label:'Kategori Usia',
                data: bValues
              }]
            },
            options: {
              scales: {
                         yAxes: [{
                              ticks: {
                          beginAtZero: true,
                          stepSize: 1
                      }
                    }]}
            }
          });

// Assume the `$venues` variable contains the data from the controller
var venues = {!! json_encode($venues) !!}; // Convert the PHP array to a JavaScript array

// Extract the venue names and counts from the `venues` array
var venueNames = venues.map(function(venue) { return venue.venue; });
var venueCounts = venues.map(function(venue) { return venue.count; });

new Chart("myChart1", {
  type: "bar",
  data: {
    labels: venueNames,
    datasets: [{
      backgroundColor: barColors2,
      label: 'Tempat ditemukannya',
      data: venueCounts
    }]
  },
  options: {
              scales: {
                         yAxes: [{
                              ticks: {
                          beginAtZero: true,
                          stepSize: 1
                      }
                    }]}
            }
          });

new Chart("myChart4", {
  type: "bar",
  data: {
    labels: aValues,
    datasets: [{
      backgroundColor: barColors2,
      data: bValues
    }]
  },
  options: {
    legend: { display: false },
    title: {
      display: true,
      text: "Umur"
    }
  }
});
</script>

<!-- /.container-fluid -->

@endsection