@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 70px;">
    <div class="d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <img src="/uploads/avatars/{{ $user->avatar }}" class="shadow" style="height: 150px; width: 150px; border-radius: 50%; margin-bottom: 20px;">
            <h1>{{ $user['name'] }}</h1>
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <a href="{{ route('user.edit') }}" style="margin: 5px;">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editprofile">Edytuj profil</button>
            </a>
            <a href="{{ route('password.edit') }}" style="margin: 5px;">
                <button type="button" class="btn btn-primary">Zmiana hasła</button>
            </a>
            
        </div>
    </div>

    

    <script>
        $('#addavatar').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
        })
    </script>
</div>
<script type="text/javascript">
    document.title = 'Profil {{ $user['name'] }}';
</script>
@endsection