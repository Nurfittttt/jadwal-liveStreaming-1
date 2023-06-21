@extends('layouts.app-master')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div> -->

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area" >
                        <canvas id="myChart" style="width: 20px" ></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card" style="width: 24rem;">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Jadwal Live Streaming</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                        </div>
                    </div>
                    {{-- <h6 class="m-0 font-weight-bold text-primary">Jadwal Live Streaming</h6> --}}
                    <div class="card-body">
                      <h1 class="card-title text-center">{{ $formattedDate }}</h1>
                      {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                    </div>
                    {{-- @foreach ($jadwalRecord as $item) --}}
                        <ul class="list-group list-group-flush text-center">
                            @if ($jadwalRecord == null)
                                <li class="list-group-item">Tidak Ada Jadwal</li>
                            @else
                            @foreach ($jadwalRecord as $item)
                                <li class="list-group-item">Acara ke {{ $loop->iteration }}</li>
                                <li class="list-group-item">{{ $item->title }}</li>
                                <li class="list-group-item">{{ $item->description }}</li>
                                <li class="list-group-item">{{ $item->jam_acara }}</li>
                            @endforeach
                                    
                            @endif
                        
                          
                        </ul>
                    {{-- @endforeach --}}
                  </div>
            </div>
        </div>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
<script type="text/javascript">
  
    var labels =  {{ Js::from($labels) }};
    var users =  {{ Js::from($data) }};
  
    const data = {
        labels: labels,
        datasets: [{
            label: 'Grafik live streaming perbulan',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: users,
        }]
    };
  
    const config = {
        type: 'line',
        data: data,
        options: {}
    };
  
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
  
</script>

@endsection
