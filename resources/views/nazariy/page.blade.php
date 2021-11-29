@extends('layout.template')
@section('content')
    <link rel="stylesheet" href="{{ asset('nazariy/style.css?15') }}">
    <div class="content">
        <div class="page_info">
            <div class="page_info__wrap">
                <div class="page_info__top">
                    @if(!empty($User->image))
                        <img class="page_user_img" src="data:image/jpeg;base64,{{ base64_encode($User->image) }}" alt="User Photo">
                    @else
                        <img class="page_user_img" src="{{ URL::to('./img/camera.png') }}" alt="User Photo">
                    @endif
                    <div class="page__user__info">
                        <h1 class="page_title">{{$User->firstName}} {{$User->lastName}}</h1>
                        <div class="page__user__info__container">
                            <div class="page__user__info__inner">
                                <span class="page__user__info__text">Дата народження</span>
                                <span class="page__user__info__value">{{$User->birthday}}</span>
                            </div>

                            <div class="page__user__info__inner">
                                <span class="page__user__info__text">Електронна пошта</span>
                                <span class="page__user__info__value">{{$User->email}}</span>
                            </div>



                        </div>
                    </div>

                </div>

                <div class="page_info__middle">
                    <a href="{{ route('friends', $User->id) }}">
                        <button  class="setting_button message-btn" style="width: 70px; border: none; margin-right: 20px;" >Друзі</button>
                    </a>


                    @if($User->id == \Illuminate\Support\Facades\Auth::id() )
                        <a class="setting_button" href="{{route('userSettings')}}">Налаштування акаунта</a>
                    @else

                        {{--     If they are friends     --}}
                        @if($Friend['confirm'] != '[]')

                            @foreach ($Friend['confirm'] as $friend)
                                @if(($friend->firstUser == \Illuminate\Support\Facades\Auth::id() && $friend->secondUser == $User->id) || ($friend->secondUser == \Illuminate\Support\Facades\Auth::id() && $friend->firstUser == $User->id))
                                    <form action="{{ route('removeFriend') }}" method="post" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="firstUser" value="{{ $friend->firstUser }}">
                                        <input type="hidden" name="secondUser" value="{{ $friend->secondUser }}">

                                        <input type="submit" class="setting_button" style="width: 160px; border: none; background-color: #af212b;" value="Видалити з друзів">
                                    </form>
                                @endif
                            @endforeach
                        @endif
                        {{--     If send request    --}}
                        @if($Friend['confirmToBeFriend'] != '[]')
                            @foreach ($Friend['confirmToBeFriend'] as $friend)
                                @if($friend->firstUser == $User->id)

                                    <form action="{{ route('confirmToBeFriend') }}" method="post" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="firstUser" value="{{ $friend->firstUser }}">

                                        <input type="submit" class="setting_button" style="width: 150px; border: none;" value="Прийняти в друзі">
                                    </form>
                                @endif
                            @endforeach
                        @endif


                        @if($Friend['sendToBeFriend'] != '[]')
                            @foreach ($Friend['sendToBeFriend'] as $friend)
                                @if($friend->secondUser == $User->id)

                                    <form action="{{ route('sendToBeFriend') }}" method="post" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="secondUser" value="{{ $friend->secondUser }}">

                                        <input type="submit" class="setting_button" style="width: 150px; border: none;" value="Запит надіслано">
                                    </form>
                                @endif
                            @endforeach
                        @endif


                        @if($Friend['all'] == '[]')
                            <form action="{{ route('makeFriends') }}" method="get" enctype="multipart/form-data">
                                <input type="hidden" name="firstUser" value="{{ \Illuminate\Support\Facades\Auth::id() }}">
                                <input type="hidden" name="secondUser" value="{{ $User->id }}">

                                <input type="submit" class="setting_button" style="width: 150px; border: none;" value="Додати в друзі">
                            </form>
                        @endif




                        {{--                    @foreach ($Friend as $friend)--}}
                        {{--                        {{ $friend }}--}}
                        {{--                    @endforeach--}}
                        <a href="{{ route('chat', $User->id) }}">
                            <button  class="setting_button message-btn" style="width: 250px; border: none;" >Написати повідомлення</button>
                        </a>

                    @endif


                </div>
            </div>
        </div>
    </div>

    @if($User->id == \Illuminate\Support\Facades\Auth::id() )
        <div class="content">
            <form action="{{ route('createPost') }}" method="post" enctype="multipart/form-data">
                @csrf
                <textarea id="textarea__user" name="text" required placeholder="Що у вас нового?"></textarea>
                <div class="post_align">
                    <input type="file" class="post_img_selector" name="image" title=" ">
                    <input type="submit" class="post_send_btn" style="width: 100%;" value="Додати">
                </div>
            </form>
        </div>
        @include('evgen.likePost')
    @endif




    @foreach ($Posts as $post)
        <div class="content">
            @include('nazariy.includes.post', ['post' => $post])
        </div>
    @endforeach


@endsection
