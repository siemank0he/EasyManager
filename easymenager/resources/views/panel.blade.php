@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 70px;">
    @if ((Auth::user()->is_admin) == 'Administrator')
    <div class="card text-white">
        <div class="card-header bg-success d-flex justify-content-between align-items-center">
          <p class="font-weight-bold" style="margin: 0;">Użytkownicy</p>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" style="height: 25px; display: flex; justify-content: center; align-items: center;">
            Dodaj
           </button>
           <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header bg-success">
                  <h5 class="modal-title" id="exampleModalLabel">Dodawanie użytkownika</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: white;" aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="/panel">
                    @csrf
                    <div class="form-group">
                      <label class="text-dark text-white" for="name">Nazwa:</label>
                      <input type="text" class="form-control" id="name" name="name">
                  </div>
           
                  <div class="form-group">
                      <label class="text-dark text-white" for="email">E-mail:</label>
                      <input type="email" class="form-control" id="email" name="email">
                  </div>
           
                  <div class="form-group">
                      <label class="text-dark text-white" for="password">Hasło:</label>
                      <input type="password" class="form-control" id="password" name="password">
                  </div>
                  <div class="form-group">
                    <label class="text-dark text-white" for="password">zł/h:</label>
                    <input type="number" class="form-control" id="zarobki" name="zarobki" value="0">
                  </div>
                  <div class="form-group d-flex justify-content-center align-items-center">
                    <button style="cursor:pointer" type="submit" class="btn btn-success">Dodaj</button>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body" style="overflow-x: scroll;">
            
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="text-align: center;" scope="col">ID</th>
                    <th style="text-align: center;" scope="col">Nazwa</th>
                    <th style="text-align: center;" scope="col">E-mail</th>
                    <th style="text-align: center;" scope="col">Rola</th>
                    <th style="text-align: center;" scope="col">Godziny</th>
                    <th style="text-align: center;" scope="col">zł/h</th>
                    <th style="text-align: center;" scope="col">Akcja</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                  <tr>
                   
                    <td style="text-align: center;">{{ $user->id }}</td>
                    <td style="text-align: center;">{{ $username = $user->name }}</td>
                    <td style="text-align: center;">{{ $user->email }}</td>
                    <td style="text-align: center;">{{ $user->is_admin }}</td>
                    
                    @php
                        $total = DB::table('hours')->where('kto', $username)->select(DB::raw("SEC_TO_TIME( SUM( TIME_TO_SEC(total))) as suma"))->value('suma');
                        $getdata = DB::table('hours')->where('kto', $username)->select('total');
                        
                        
                    @endphp
                    <td style="text-align: center;">{{ $total }}</td>
                    <td style="text-align: center;">{{ $user->zarobki }} zł/h</td>
                    <td style="display: flex; justify-content: center; items-align: center;">
                    
                        @if(($user->name) == Auth::user()->name)
                        
                        @else
                        <form action="{{ url('/panel') . "/" . $user->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" style="height: 25px; display: flex; justify-content: center; align-items: center;" onclick="return confirm('Czy na pewno chcesz usunąć {{Auth::user()->name}}?')">Usuń</button>
                        </form>
                        
                        @endif
                    </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>
              
            <div></div>
        </div>
      </div>
          
    @endif 
</div>
@endsection