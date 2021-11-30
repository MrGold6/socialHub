@extends('layout.template')
@section('content')
    <link rel = "stylesheet" type = "text/css" href="{{asset('anatoliy/styleSetting.css?3')}}" />

    <div class="container">

        @foreach($settings as $setting)
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-xs-12 upload-btn-wrapper text-center">
                    <img class="" style="width: 300px; border-radius: 15px;" src="data:image/jpeg;base64,{{ base64_encode($setting->image) }}"/><br />
                       <div class="cont">
                           <input type="file" class="form-text" />
                       </div>
                    <button class="btnDang px-3">Видалити фото</button>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-xs-12 text-center">
                    <label style="color: #526bb9; font-size: 25px" class="mt-2">Ім'я: </label>
                    <br /><input class="inputname datainfo" type="text" value="{{$setting->firstName}}">
                    <br />
                    <label style="color: #526bb9; font-size: 25px" class="mt-2">Прізвище: </label>
                    <br /> <input class="inputname datainfo" type="text" value="{{$setting->middleName}}">
                    <br />
                    <label style="color: #526bb9; font-size: 25px" class="mt-2">По-батькові: </label><br />
                    <input class="inputname datainfo" type="text" value="{{$setting->lastName}}">
                </div>

            </div>
        @endforeach

    </div>

@endsection
