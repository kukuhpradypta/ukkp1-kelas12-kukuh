@extends('template.template')
@section('headcss')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <style>
        .oioi:hover {
            -ms-transform: scale(1.05);
            /* IE 9 */
            -webkit-transform: scale(1.05);
            /* Safari 3-8 */
            transform: scale(1.05);
        }

    </style>
@endsection
@section('content')
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <a href="catatanperjalanan" style="text-decoration: none">
                <div class="card oioi border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div style="font-size: 20px"
                                    class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Journey Note</div>
                                {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div> --}}
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <a href="catatanperjalanan" style="text-decoration: none">
                <div class="card oioi border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div style="font-size: 20px"
                                    class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Journey Data</div>
                                {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div> --}}
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-database fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
