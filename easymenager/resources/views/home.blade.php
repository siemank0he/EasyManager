@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 70px;">
    <div class="row">
        @if ((Auth::user()->is_admin) == 'Administrator')
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('/panel') }}" class="card bg-primary text-white border-left-primary shadow h-100 py-2 important-blue">
                <div class="card-body important-blue">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5 font-weight-bold text-white text-uppercase mb-1">użytkownicy</div>
                        <div class="text-xs mb-0 font-weight-light text-gray-800">Narzędzie administracyjne</div>
                    </div>
                    <div class="col-auto">
                        <i class="fab fa-font-awesome-flag"></i>
                    </div>
                    </div>
                </div>
            </a>
        </div>
        @endif 
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('/hours') }}" class="card bg-success text-white border-left-primary shadow h-100 py-2 important-green">
                <div class="card-body important-green">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5 font-weight-bold text-white text-uppercase mb-1">godziny pracy</div>
                        <div class="text-xs mb-0 font-weight-light text-gray-800">40H</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-stopwatch fa-2x text-gray-300"></i>
                    </div>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('/vacation') }}" class="card bg-danger text-white border-left-primary shadow h-100 py-2 important-red">
                <div class="card-body important-red">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5 font-weight-bold text-white text-uppercase mb-1">URLOP / WOLNE</div>
                        <div class="text-xs mb-0 font-weight-light text-gray-800">Złóż wniosek o urlop/wolne</div>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-calendar-alt fa-2x text-gray-300"></i>
                    
                    </div>
                    </div>
                </div>
            </a>
        </div>    
    </div>
</div>
@endsection
