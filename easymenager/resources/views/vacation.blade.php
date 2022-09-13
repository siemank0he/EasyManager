@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 70px;">
    <div class="card">
        <div class="card-header">
        Złóż nowy wniosek
        </div>
        <div class="card-body">
            <form method="POST" action="/vacation">
                @csrf
                <div class="d-flex justify-content-between">
                    <div class="form-group" style="width: 49%;">
                        <label class="text-dark text-white" for="od_kiedy">Od kiedy</label>
                        <input type="date" class="form-control" id="od_kiedy" name="od_kiedy" placeholder="od kiedy">
                    </div>
        
                    <div class="form-group" style="width: 49%;">
                        <label class="text-dark text-white" for="do_kiedy">Do kiedy</label>
                        <input type="date" class="form-control" id="do_kiedy" name="do_kiedy" placeholder="do kiedy">
                    </div>
                </div>

                <div class="form-group">
                    <label class="text-dark text-white" for="notka">Notatka:</label>
                    <input type="text" class="form-control" id="notka" name="notka" required>
                </div>
                <div class="form-group d-none">
                    <label class="text-dark text-white" for="ktownioskuje">Kto wnioskuje</label>
                    <input type="text" class="form-control" id="ktownioskuje" name="ktownioskuje" value="{{ Auth::user()->name }}">
                </div>
                <div class="form-group d-flex justify-content-center align-items-center">
                <button style="cursor:pointer" name="dodaj" id="dodaj" type="submit" class="btn btn-success">Dodaj</button>
              </div>
            </form>
        </div>
    </div>
    @if ((Auth::user()->is_admin) == 'Administrator')
    @php
        $username = Auth::user()->name;
        $vacations = DB::table('vacation')->orderBy('id', 'desc')->get();
    @endphp
    <div class="card" style="margin-top: 20px;">
        <div class="card-header">
            <p style="margin: 0px;">Wnioski o urlop/wolne</p>
        </div>
        <div class="card-body d-flex justify-content-center flex-wrap" style=" overflow: scroll; max-height: 300px;">
            
            @foreach ($vacations as $vacation)
            @if (($vacation->status) == 'Wysłano')
                <div class="card" style="margin: 10px; width: 300px;">
                    <div class="card-header text-center">
                        <div class="d-none">{{ $id = $vacation->id }}</div>
                        <h6 style="margin: 0px;">Użytkownik: <span class="text-success"><b>{{ $vacation->ktownioskuje }}</b></span></h6>
                    </div>
                    <div class="card-body">
                        <h6 class="text-center">od: <span class="text-success text-center"><b>{{ $vacation->od }}</b></span> do: <span class="text-success"><b>{{ $vacation->do }}</b></span></h6>
                        <h6 class="text-center">{{ $vacation->notka }}</h6>
                    </div>
                    <div class="card-footer d-flex flex-row justify-content-center">
                        
                        <form action="{{ url('/vacation') . "/" . $vacation->id  }}" method="POST">
                        @csrf
                            <button name="update" class="btn btn-success" style="height: 25px; display: flex; justify-content: center; align-items: center; margin-right: 10px;" id="btn_status update" onclick="return confirm('Na pewno chcesz zatwierdzić wniosek {{ $vacation->ktownioskuje }}?')">Zatwierdź</button>
                        </form>
                        <form action="{{ url('/vacation') . "/" . $vacation->id  }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" style="height: 25px; display: flex; justify-content: center; align-items: center;" onclick="return confirm('Czy na pewno chcesz usunąć wniosek {{ $vacation->ktownioskuje }}?')">Usuń</button>
                        </form>
                    </div>
                </div>
            @endif
            @endforeach
        </div>
    </div>
    @endif

    <div class="card" style="margin-top: 15px;">
        <div class="card-header">
        Twoje wnioski
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="text-align: center;" scope="col">Od kiedy</th>
                    <th style="text-align: center;" scope="col">Do kiedy</th>
                    <th style="text-align: center;" scope="col">Notka</th>
                    <th style="text-align: center;" scope="col">Status</th>
                  </tr>
                </thead>
                @php
                    $username = Auth::user()->name;
                    $vacations = DB::table('vacation')->orderBy('id', 'desc')->where('ktownioskuje', $username)->get();
                @endphp
                <tbody>
                @foreach ($vacations as $vacation)
                
                <tr>
                    <td style="text-align: center;">{{ $vacation->od }}</td>
                    <td style="text-align: center;">{{ $vacation->do }}</td>
                    <td style="text-align: center;">{{ $vacation->notka }}</td>
                    @if (($vacation->status) == 'Wysłano')
                    <td class="text-danger" style="text-align: center;"><b>{{ $vacation->status }}</b></td>
                    @elseif (($vacation->status) == 'Akceptowano!')
                    <td class="text-success" style="text-align: center;"><b>{{ $vacation->status }}</b></td>    
                    @endif
                    
                </tr>
                @endforeach
                </tbody>
              </table>
        </div>
    </div>

    
    
</div>
@endsection