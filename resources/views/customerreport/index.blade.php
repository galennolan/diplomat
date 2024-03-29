@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')

<div class="container-fluid">


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Customer Report @if(Auth::user()->hasRole('adminarea'))  {{Auth::user()->area}}@endif </h1>

  
</div>
<form id="dailyreport-form" method="POST" action="{{ route('customerreport.penjualan') }}">
  @csrf 

@if(Auth::user()->hasRole('admin'))  
<div class="row g-2">
<div class="col-md-12 mb-3">
<div class="form-floating">
      <label class="font-weight-bold" for="exampleFormControlSelect1">Area</label>
      <select class="form-control" name="area" id="area" >
          <option value="">Please select</option>
          <option value="Solo" >Solo</option>
          <option value="Yogyakarta" >Yogyakarta</option>
          <option value="Semarang">Semarang</option>>
      </select>
  </div>
  </div>
</div>
@endif

<div class="row g-2">
<div class="col-md-6 mb-3">
<div class="form-floating">
  <label for="exampleFormControlInput1">Tanggal Mulai</label>
  <input type="date" name="tanggalawal" id="tanggalawal" class="form-control" required value="{{ old('tanggalawal') }}">

  </div>
  </div>
  <div class="col-md-6 mb-3">
    <div class="form-floating">
      <label for="exampleFormControlInput1">Tanggal Selesai</label>
      <input type="date" name="tanggalakhir" id="tanggalakhir" class="form-control" required value="{{ old('tanggalakhir') }}">
    </div>
  </div>
</div>

<div class="modal-footer">
<button id="submit-btn" type="submit" class="btn btn-primary">Submit</button>
</div>
</form>             

<hr>
<div class="row">
  <div class="col-md-6 mb-3">
    <label class="control-label font-weight-bold" for="inputTableName">Venue</label>
    <div class="card body">
      <canvas class="chart" id="eccCcChart" width="400" height="200"></canvas>
    </div>
  </div>
  <div class="col-md-6 mb-3">
    <label class="control-label font-weight-bold" for="inputTableName">Umur</label>
    <div class="card body">
      <canvas class="chart" id="myChart" width="400" height="200"></canvas>
    </div>
  </div>
</div>




<div class="row">
  <div class="col-md-6 mb-3">
 
    <div class="card-body">
    <label class="control-label" style=" width: 100%; color:black">Tabel Venue</label>
  
    <div class="table-responsive">
      <table class="table table-sm table-bordered table-striped" id="dataTable9" width="100%" cellspacing="0" style="font-size: small; width: 100%; color:black">
        <thead class="thead-dark">
          <tr>
            <th>Venue</th>
            @foreach ($rokokList as $rokok)
              <th>{{ $rokok }}</th>
            @endforeach
            <th>Total</th>
            <th>%</th> <!-- Add Percentage column -->
          </tr>
        </thead>
        <tfoot class="thead-dark">
          <tr>
            <th>Total</th>
            @php
            $totalRokok = array_fill(0, count($rokokList), 0);
            $totalAll = 0;
            @endphp
            @foreach ($venuerokok as $row)
              @php
              $totalAll += $row->count;
              for ($i = 0; $i < count($rokokList); $i++) {
                if ($row->rokok == $rokokList[$i]) {
                  $totalRokok[$i] += $row->count;
                  break;
                }
              }
              @endphp
            @endforeach
            @foreach ($totalRokok as $total)
              <th>{{ $total }}</th>
            @endforeach
            <th>{{ $totalAll }}</th>
            <th>100%</th> <!-- Add 100% in Percentage column -->
          </tr>
        </tfoot>
        <tbody>
          @php
          $currentVenue = null;
          @endphp
          @foreach ($venuerokok as $row)
            @if ($row->venue != $currentVenue)
              @php
              $currentVenue = $row->venue;
              $total = 0;
              @endphp
              <tr>
                <td>{{ $row->venue }}</td>
                @foreach ($rokokList as $rokok)
                  @php
                  $count = $rokokCounts[$rokok][$currentVenue] ?? 0;
                  $total += $count;
                  @endphp
                  <td>{{ $count }}</td>
                @endforeach
                <td>{{ $total }}</td>
                <td>{{ number_format($total / $totalAll * 100, 1) }}%</td> <!-- Calculate and display percentage -->
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
    </div>

    </div>
  </div>

  <div class="col-md-6 mb-3">
  <div class="card-body">

  <label class="control-label" style=" width: 100%; color:black">Tabel Usia</label>
    <div class="table-responsive">
      <table class="table table-sm table-bordered table-striped" id="dataTable4" width="100%" cellspacing="0" style="font-size: small; width: 100%; color:black">
        <thead class="thead-dark">
          <tr>
            <th>Range Usia</th>
            <th>Banyak</th>
            <th>Percentage</th>
          </tr>
        </thead>
        <tbody>
        @php
                $totalCount = 0;
            foreach ($umur as $ageGroup) {
              $totalCount += $ageGroup->count;
            }
            @endphp  
          @foreach($umur as $row)
          <tr>
            <td>{{ $row->umur }}</td>
            <td>{{ $row->count }}</td>
            <td>
            @if($totalCount > 0)
            {{ round(($row->count / $totalCount) * 100, 1) }}%
            @else
            0%
            @endif
          </td>
          </tr>
        @endforeach                       
      </tbody>
        <tfoot class="thead-dark">
          <tr>
            <th>Total</th>
            <th>{{ $totalCount }}</th>
      <th>100%</th>
           
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<hr>
<!-- chart pekerjaan dan rokok merk lain -->

<div class="col-md-6 mb-3">
<label class="control-label font-weight-bold" for="inputTableName">Pekerjaan</label>
  <div class="card-body">
    <canvas class="chart" id="myChart3" width="400" height="200"></canvas>
  </div>
</div>

<div class="col-md-6 mb-3">
<label class="control-label font-weight-bold" for="inputTableName">Rokok Merk Lain</label>
  <div class="cardbody">
    <canvas class="chart" id="myChart4" width="100%" height="200"></canvas>
  </div>
</div>


           

<!-- table pekerjaan dan rokok merk lain -->

  <div class="col-md-6 mb-3">
    <div class="card-body">
    <label class="control-label font-weight-italic" for="inputTableName">Tabel Pekerjaan</label>

      <div class="table-responsive">
        <table class="table table-sm table-bordered table-striped" id="dataTable6" width="100%" cellspacing="0" style="font-size: small; width: 100%; color:black">
          <thead class="thead-dark">
            <tr>
              <th>Name</th>
              <th>Amount</th>
              <th>%</th>
            </tr>
          </thead>
          <tbody>
            @php
              $total = 0;
              foreach ($pekerjaan as $kerja) {
                $total += $kerja->jml_pekerjaan;
              }
            @endphp
            @foreach ($pekerjaan as $kerja)
              <tr>
                <td>{{ $kerja->pekerjaan }}</td>
                <td>{{ $kerja->jml_pekerjaan }}</td>
                <td>{{ round(($kerja->jml_pekerjaan / $total) * 100, 1) }}%</td>
              </tr>
            @endforeach
          </tbody>
          <tfoot class="thead-dark">
            <tr>
              <th>Total</th>
              <th>{{ $total }}</th>
              <th>100%</th>
            </tr>
          </tfoot>

        </table>
      </div>
    </div>
  </div>

  <div class="col-md-6 mb-3">
    <div class="card-body">
    <label class="control-label font-weight-italic" for="inputTableName">Tabel Rokok Merk lain</label>
      <div class="table-responsive">
        <table class="table table-sm table-bordered table-striped" id="dataTable5" width="100%" cellspacing="0" style="font-size: small; width: 100%; color:black">
          <thead class="thead-dark">
            <tr>
              <th>Name</th>
              <th>Amount</th>
              <th>%</th>
            </tr>
          </thead>
          <tbody>
            @php
              $totalnya = 0;
              foreach ($merklain as $ML) {
                $totalnya += $ML->count_others;
              }
            @endphp 
            @foreach ($merklain as $ML)
              <tr>
                <td>{{ $ML->rokok }}</td>
                <td>{{ $ML->count_others }}</td>
                <td>{{ round(($ML->count_others / $total) * 100, 1) }}%</td>
              </tr>
            @endforeach
          </tbody>
          <tfoot class="thead-dark">
            <tr>
              <th>Total</th>
              <th>{{ $totalnya }}</th>
              @if($total > 0)
                <th>{{ round(($totalnya / $total) * 100, 1) }}%</th>
              @else
                <th>0%</th>
              @endif
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>





<script>
  // Chart 1
  const jml = {!! $jumlah !!};
  const tpt = {!! $tpt !!};
  
  const chart1Data = {
    labels: tpt,
    datasets: [{
      label: 'Venue',
      data: jml,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)'
      ],
      borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)'
      ],
      borderWidth: 1
    }]
  };
  
  const chart1Options = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    },
    legend: {
      display: true,
      position: 'top'
    }
  };
  
  const chart1 = new Chart(document.getElementById('eccCcChart'), {
    type: 'bar',
    data: chart1Data,
    options: chart1Options
  });
  
  // Chart 2
  const countumur = {!! $countumur !!};
  const ss = {!! $ss !!};
  
  const chart2Data = {
    labels: ss,
    datasets: [{
      label: 'Umur',
      data: countumur,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)'
      ],
      borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)'
      ],
      borderWidth: 1
    }]
  };
  
  const chart2Options = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    },
    legend: {
      display: true,
      position: 'top'
    }
  };
  
  const chart2 = new Chart(document.getElementById('myChart'), {
    type: 'bar',
    data: chart2Data,
    options: chart2Options
  });

  // Chart 3
  const jmlpekerjaan = {!! $jmlpekerjaan !!};
  const namapekerjaan = {!! $namapekerjaan !!};
  
  const chart3Data = {
    labels: namapekerjaan,
    datasets: [{
      label: 'Pekerjaan',
      data: jmlpekerjaan,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)'
      ],
      borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)'
      ],
      borderWidth: 1
    }]
  };
  
  const chart3Options = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    },
    legend: {
      display: true,
      position: 'top'
    }
  };
  
  const chart3 = new Chart(document.getElementById('myChart3'), {
    type: 'bar',
    data: chart3Data,
    options: chart3Options
  });

  
  // Chart 4
  const JMLrokoklain = {!! $JMLrokoklain !!};
  const rokoklain = {!! $rokoklain !!};
  
  const chart4Data = {
    labels: rokoklain,
    datasets: [{
      label: 'Rokok Merk Lain',
      data: JMLrokoklain,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)'
      ],
      borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)'
      ],
      borderWidth: 1
    }]
  };
  

  const chart4Options = {
  animation: {
    duration: 1000,
    easing: 'easeInOutQuad'
  },
  maintainAspectRatio: false,
    scales: {
        yAxes: [{
          
            ticks: {
              suggestedMin: 0, // start at zero
                beginAtZero: true
            },
        }]
    },
    legend: {
        display: true,
        position: 'bottom'
    }
};
  
  const chart4 = new Chart(document.getElementById('myChart4'), {
    type: 'bar',
    data: chart4Data,
    options: chart4Options
  });
</script>



<!-- /.container-fluid -->

@endsection