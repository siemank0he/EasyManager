@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 70px;">
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col"><p class="text-center m-0">Start</p></th>
        <th scope="col"><p class="text-center m-0">Stop</p></th>
        <th scope="col"><p class="text-center m-0">Data</p></th>
        <th scope="col"><p class="text-center m-0">Czas</p></th>
        <!-- <th scope="col"><p class="text-center m-0">Kto</p></th> -->
        <th scope="col"><p class="text-center m-0">Usuń</p></th>
        </tr>
    </thead>
    @foreach($hours as $hour)
    @php
        $dateDiff = (strtotime($hour->stop_work)-strtotime($hour->start_work)); 
                  
    @endphp
    
    <tbody>
        <tr>
        <td><p class="text-center m-0">{{ date('H:i', strtotime($hour->start_work)) }}</p></td>
        <td><p class="text-center m-0">{{ date('H:i', strtotime($hour->stop_work)) }}</p></td>
        <td><p class="text-center m-0">{{ date('d.m', strtotime($hour->dzien)) }}</p></td>
        <td><p class="text-center m-0">{{ date('G:i', $dateDiff).'h' }}</p></td>
        <!-- <td><p class="text-center m-0">{{ $hour->kto }}</p></td>  -->
        <td> 
            <form action="{{ url('/hours') . "/" . $hour->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="delete-hour-btn" style="border: none; width: 100%;" onclick="return confirm('Czy na pewno chcesz usunąć tą zawartość?')"><i class="fas fa-trash"></i></button>
            </form>
        </td>
        </tr>
    </tbody>
    
    @endforeach
    
    </table>
    <div class="fixed-bottom d-flex justify-content-center align-items-center w-100" style="margin-bottom: 30px;">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addhours"><i class="fas fa-plus"></i></button>
    <div class="text-center border-top border-bottom border-primary" style="width: 200px; height: 100%;"><p class="m-0 font-weight-bold">{{ $total }}</p></div>
    <a href="{{ url('/home') }}"><button type="button" class="btn btn-primary"><i class="fas fa-long-arrow-alt-left"></i></button></a>
    </div>

    <div class="modal fade" id="addhours" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dodaj nowe godziny</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/hours" method="POST">
        <label for="start_work">Godzina rozpoczęcia</label>
        <input type="time" class="form-control" id="start_work" name="start_work" required>
        <label for="stop_work">Godzina zakończenia</label>
        <input type="time" class="form-control" id="stop_work" name="stop_work" required>
        <label for="dzien">Data</label>
        <input type="date" class="form-control" id="dzien" name="dzien" required>
        <label for="dzien">Użytkownik</label>
        <input type="text" name="kto" class="form-control" id="kto" value="{{ Auth::user()->name }}">
        <div class="d-flex justify-content-center align-items-center" style="margin-top: 10px;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right: 10px;">Zamknij</button>
            <button type="submit" class="btn btn-primary" name="submit">Dodaj</button>
        </div>
        {!! csrf_field() !!}
      </form>
      </div>
    </div>
  </div>
</div>

<script>
$('#addhours').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>
    
</div>
@endsection