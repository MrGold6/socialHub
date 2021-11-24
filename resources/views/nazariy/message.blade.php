@extends('layout.template')
@section('content')
    <link rel="stylesheet" href="{{ asset('nazariy/style.css?23') }}">
    <div class="content">
        <ul class="messages__container">
            @foreach ($Message as $message)
                <li class="messages__item__container">
                    <a href="#">
                        <div class="messages__item__img__container">
                            <div class="messages__item__img__wrapper">
                                @if( !empty($message-> image ) )
                                    <img class="messages_user_img" src="data:image/jpeg;base64,{{ base64_encode($message->image) }}" alt="{{$message->firstName}}">
                                @else
                                    <img class="messages_user_img" src="{{ URL::to('./img/camera.png') }}" alt="{{$message->firstName}}">
                                @endif
                            </div>
                        </div>

                        <div class="messages__item__content">
                            <div class="messages__item__content__wrapper">
                                @if(Carbon\Carbon::now()->format('d-m-Y') != date('d-m-Y', strtotime($message->messageCreate)))
                                    <div class="messages__item__content__date">
                                        {{ date('d-m-Y', strtotime($message->messageCreate)) }}
                                    </div>
                                @else
                                    <div class="messages__item__content__date">
                                        {{ date('H:i', strtotime($message->messageCreate)) }}
                                    </div>
                                @endif

                                <div class="messages__item__content__name__container">
                                    <span class="messages__item__content__name__wrapper">
                                        {{ $message->firstName }}  {{ $message->lastName }}
                                    </span>
                                </div>


                                <div class="messages__item__content__preview__container">
                                    <span class="messages__item__content__preview">{{ $message->message }}</span>
                                </div>
                            </div>
                        </div>


                    </a>


                </li>
            @endforeach
        </ul>
    </div>
@endsection
