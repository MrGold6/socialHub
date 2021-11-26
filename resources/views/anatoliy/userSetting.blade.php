@extends('layout.template')
@section('content')
    <link rel = "stylesheet" type = "text/css" href="{{asset('anatoliy/styleSetting.css?3')}}" />

    <div class="container">

        <form action="{{ route('UpdateUser') }}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-xs-12 upload-btn-wrapper text-center">
                    <img class="" style="width: 300px; border-radius: 15px;" src="data:image/jpeg;base64,{{ base64_encode($user->image) }}"/><br />
                       <div class="cont">
                           <input type="file" class="form-text" name="image"/>
                       </div>
                    <a class="btnDang px-3"  onclick='document.location="{{ route('deletePhoto') }}"'>Видалити фото</a>
                </div>

                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-xs-12 text-center">

                    <label style="color: #526bb9; font-size: 25px" class="mt-2">Ім'я: </label>
                    <br /><input class="inputname datainfo" name="firstName" type="text" value="{{$user->firstName}}">
                    <br />
                    <label style="color: #526bb9; font-size: 25px" class="mt-2">Прізвище: </label>
                    <br /> <input class="inputname datainfo" name="middleName" type="text" value="{{$user->middleName}}">
                    <br />
                    <label style="color: #526bb9; font-size: 25px" class="mt-2">По-батькові: </label>
                    <br /> <input class="inputname datainfo" name="lastName" type="text" value="{{$user->lastName}}">
                    <br />
                    <label style="color: #526bb9; font-size: 25px" class="mt-2">Дата народження: </label>
                    <br /> <input class="inputname datainfo" name="birthday" type="date" value="{{$user->birthday}}">
                    <br />
                    <label style="color: #526bb9; font-size: 25px" class="mt-2">Емейл: </label>
                    <br /> <input class="inputname datainfo" name="email" type="email" value="{{$user->email}}">
                    <br />
                    <br />
                    <center><input type="submit" class="btn btn-warning" value="Редагування"></center>

                </div>

            </div>

        </form>
    </div>

@endsection
