@extends('layout.template')
@section('content')
    <link rel = "stylesheet" type = "text/css" href="{{asset('anatoliy/styleSearch.css?2')}}" />
    <div class="container">
        <div class="py-2">
            <form action="{{ route('searchUsersByName') }}" class="d-flex mb-2 inpserach" method="post" enctype="multipart/form-data">
                    @csrf
                <input class="form-control me-2" type="search" name="firstName" placeholder="Ім'я користувача" aria-label="Search">
                <input value="Пошук" class="btn btnok" type="submit">

                <a href="{{route('searchPeoples')}}"  class="btn btnok" type="submit">Всі</a>
            </form>
            @foreach($notFriends as $notFriend)

                <div class="row rowmain py-1 my-2 ">
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-xs-12 text-center">
                        <a class="text-name" href="{{ route('user', $notFriend->id )}}">
                            @if(!empty($notFriend->image))
                                <img class="imguser" style="width: 100px; border-radius: 100px;" src="data:image/jpeg;base64,{{ base64_encode($notFriend->image) }}"/>
                            @else
                                <img class="imguser" style="width: 100px; border-radius: 100px;" src="{{ URL::to('./img/camera.png') }}" alt="User Photo">
                            @endif
                        </a>
                    </div>
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 pt-2 text-center">

                            <a class="text-name" href="{{ route('user', $notFriend->id )}}">
                                <h4 class="mt-2 name">{{$notFriend->firstName}} {{$notFriend->middleName}}</h4>
                            </a>

                            <span class="">{{$notFriend->email}}</span>
                        </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 pt-4 text-center">
                        <b class="name">День народження</b><br>
                        <i class="mt-0"><i class="fas fa-gift ikons"></i>{{$notFriend->birthday}} </i>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 pt-2 text-center">
                        @php($hasRequest=0)
                            @foreach ($requests as $request)
                                @if($request->idFirstUser == \Illuminate\Support\Facades\Auth::id() && $request->idSecondUser == $notFriend->id)
                                    @php($hasRequest=1)
                                    <form action="{{ route('removeFriend') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="firstUser" value="{{ \Illuminate\Support\Facades\Auth::id() }}">
                                        <input type="hidden" name="secondUser" value="{{ $request->idSecondUser  }}">
                                        <button type="submit" class="btn text-center  mt-4 btn-outline-danger">Відмінити запит</button>
                                    </form>
                                @endif
                            @endforeach



                        @if($hasRequest!=1)
                            <form action="{{ route('makeFriends') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="firstUser" value="{{ \Illuminate\Support\Facades\Auth::id() }}">
                                <input type="hidden" name="secondUser" value="{{ $notFriend->id }}">

                                <button type="submit" class="btn text-center btnok mt-4"><i class="fas fa-user-plus"></i>Додати до друзів</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
