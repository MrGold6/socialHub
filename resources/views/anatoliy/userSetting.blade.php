@extends('layout.template')
@section('content')
    <link rel = "stylesheet" type = "text/css" href="{{asset('anatoliy/styleSetting.css?7')}}" />

    <div class="container">

        <form class="formsetting" action="{{ route('UpdateUser') }}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 upload-btn-wrapper text-center">
                    @if(!empty($user->image))
                        <img class="" style="width: 300px; border-radius: 15px;" src="data:image/jpeg;base64,{{ base64_encode($user->image) }}"/><br />
                    @else
                        <img class="" style="width: 300px; border-radius: 15px;" src="{{ URL::to('./img/camera.png') }}" alt="User Photo">
                    @endif
                    <div class="cont">
                        <input type="file" class="form-text" name="image"/>
                    </div>
                    <a onclick='document.location="{{ route('deletePhoto') }}"'>
                        <button class="btnDang px-3" onclick="event.preventDefault()">Видалити фото</button>
                    </a>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="text-cnter">
                        <p><label style="color: #526bb9; font-size: 25px" class="">Ім'я: </label></p>

                        <input class="inputname datainfo " type="text" name="firstName" value="{{$user->firstName}}">
                    </div>

                    <div class="text-cnter">
                        <p><label style="color: #526bb9; font-size: 25px" class="mt-2">Прізвище: </label></p>

                        <input class="inputname datainfo" type="text" name="middleName" value="{{$user->middleName}}">
                    </div>

                    <div class="text-cnter">
                        <p><label style="color: #526bb9; font-size: 25px" class="mt-2">По-батькові: </label></p>
                        <input class="inputname datainfo" type="text" name="lastName" value="{{$user->lastName}}">
                    </div>

                    <div class="text-cnter">
                        <p><label style="color: #526bb9; font-size: 25px" class="mt-2">E-mail: </label></p>
                        <input class="inputname datainfo" type="email" name="email" value="{{$user->email}}">
                    </div>

                    <div class="text-cnter">
                        <p><label style="color: #526bb9; font-size: 25px" class="mt-2">День народження: </label></p>
                        <input class="inputname datainfo" type="date" name="birthday" value="{{$user->birthday}}">
                    </div>


                    <div class="text-cnter">
                        <input type="submit" class="btn btn-siniy" value="Змінити данні">
                    </div>
                </div>

            </div>

        </form>
    </div>

@endsection
