@extends('layout.template')

@section('content')
    <link rel = "stylesheet" type = "text/css" href="{{asset('anatoliy/styleGroupUsers.css?2')}}" />



        <div class="row">
            @foreach ($Users as $user)

                <div class="row rowmain py-1 my-2">
                    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-xs-12 text-center">
                        <a href="{{ route('user', [$user->id]) }}">
                            @if(!empty($user->image))
                                <img class="imguser" style="width: 100px; border-radius: 100px;" src="data:image/jpeg;base64,{{ base64_encode($user->image) }}"/>
                            @else
                                <img class="imguser" style="width: 100px; border-radius: 100px;" src="{{ URL::to('./img/camera.png') }}" alt="User Photo">
                            @endif
                        </a>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 pt-3 ">
                        <h4 class="mt-0 name">{{$user->firstName}} {{$user->lastName}}</h4>
                        {{$user->email}}
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 pt-4 text-center">
                        <b class="name">День народження</b><br>
                        <i class="mt-0"><i class="fas fa-gift ikons"></i>{{$user->birthday}} </i>

                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-xs-12 pt-4">
                        <div class="bnt">
                            <a class="deletebtn" href="{{route('DeleteGroupUsers', $user->id)}}">
                                Видалити
                            </a>
                        </div>
                    </div>

                </div>


            @endforeach
        </div>

@endsection

