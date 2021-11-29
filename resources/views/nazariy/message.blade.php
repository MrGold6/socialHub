@extends('layout.template')
@section('content')
    <link rel="stylesheet" href="{{ asset('nazariy/style.css?23') }}">
    <div class="content">
        <ul class="messages__container">

            {{--            {{ dd($Message); }}--}}


            @foreach ($Message['message'] as $message)
                @foreach ($Message['user'] as $user)
                    @if($message->idChat == $user->idChat)
                        <li class="messages__item__container">
                            <a href="#">
                                <div class="messages__item__img__container">
                                    <div class="messages__item__img__wrapper">
                                        @if( !empty($user->image ) )
                                            <img class="messages_user_img" src="data:image/jpeg;base64,{{ base64_encode($user->image) }}" alt="{{$user->firstName}}">
                                        @else
                                            <img class="messages_user_img" src="{{ URL::to('./img/camera.png') }}" alt="{{$user->firstName}}">
                                        @endif
                                    </div>
                                </div>

                                <div class="messages__item__content">
                                    <div class="messages__item__content__wrapper">
                                        @if(Carbon\Carbon::now()->format('d-m-Y') != date('d-m-Y', strtotime($message->created_at)))
                                            <div class="messages__item__content__date">
                                                {{ date('d-m-Y', strtotime($message->created_at)) }}
                                            </div>
                                        @else
                                            <div class="messages__item__content__date">
                                                {{ date('H:i', strtotime($message->created_at)) }}
                                            </div>
                                        @endif

                                        <div class="messages__item__content__name__container">
                                            <span class="messages__item__content__name__wrapper">
                                                {{ $user->firstName }}  {{ $user->lastName }}
                                            </span>
                                        </div>


                                        <div class="messages__item__content__preview__container">
                                            <span class="messages__item__content__preview">{{ $message->message }}</span>
                                        </div>
                                    </div>
                                </div>


                            </a>


                        </li>
                    @endif
                @endforeach
            @endforeach
        </ul>
    </div>
@endsection
