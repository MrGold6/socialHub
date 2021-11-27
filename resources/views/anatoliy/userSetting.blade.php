@extends('layout.template')
@section('content')
    <link rel = "stylesheet" type = "text/css" href="{{asset('anatoliy/styleSetting.css?4')}}" />

    <div class="container">

        @foreach($settings as $setting)
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 upload-btn-wrapper text-center">
                    <img class="" style="width: 300px; border-radius: 15px;" src="data:image/jpeg;base64,{{ base64_encode($setting->image) }}"/><br />
                    <input type="file" class="form-text" />
                    <button class="btnDang px-3">Видалити фото</button>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="text-cnter">
                        <p><label style="color: #526bb9; font-size: 25px" class="">Ім'я: </label></p>

                        <input class="inputname datainfo " type="text" value="{{$setting->firstName}}">
                    </div>

                    <div class="text-cnter">
                        <p><label style="color: #526bb9; font-size: 25px" class="mt-2">Прізвище: </label></p>

                        <input class="inputname datainfo" type="text" value="{{$setting->middleName}}">
                    </div>

                    <div class="text-cnter">
                        <p><label style="color: #526bb9; font-size: 25px" class="mt-2">По-батькові: </label></p>
                        <input class="inputname datainfo" type="text" value="{{$setting->lastName}}">
                    </div>

                    <div class="text-cnter">
                        <p><label style="color: #526bb9; font-size: 25px" class="mt-2">E-mail: </label></p>
                        <input class="inputname datainfo" type="email" value="{{$setting->email}}">
                    </div>

                    <div class="text-cnter">
                        <p><label style="color: #526bb9; font-size: 25px" class="mt-2">День народження: </label></p>
                        <input class="inputname datainfo" type="date" value="{{$setting->birthday}}">
                    </div>

                    <div class="text-cnter">
                        <a class="btn btn-siniy" href="#" role="button">Змінити данні</a>
                    </div>
                </div>

            </div>
        @endforeach

    </div>

@endsection
