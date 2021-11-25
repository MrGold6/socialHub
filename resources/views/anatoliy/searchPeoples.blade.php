@extends('layout.template')
@section('content')
    <link rel = "stylesheet" type = "text/css" href="{{asset('anatoliy/styleSearch.css?1')}}" />
    <div class="container">
        <div class="py-2">

            <form class="d-flex mb-2 inpserach">
                <input class="form-control me-2" type="search" placeholder="Ім'я користувача" aria-label="Search">
                <button class="btn btnok" type="submit">Пошук</button>
            </form>
            @foreach($notFriends as $notFriend)
                <div class="row rowmain py-1 my-2 ">
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-xs-12 text-center">
                        <img class="imguser" style="width: 100px; border-radius: 100px;" src="data:image/jpeg;base64,{{ base64_encode($notFriend->image) }}"/>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 pt-2 text-center">
                        <h4 class="mt-2">{{$notFriend->firstName}} {{$notFriend->middleName}}</h4>
                        {{$notFriend->email}}
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 pt-4 text-center">
                        <b>День народження</b><br>
                        <i class="mt-0"><i class="fas fa-gift ikons"></i>{{$notFriend->birthday}} </i>

                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 pt-2 text-center">
                        <button type="button" class="btn text-center btnok mt-4"><i class="fas fa-user-plus"></i>Додати до друзів</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
