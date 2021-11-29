@extends('layout.template')

@section('content')
    <link rel = "stylesheet" type = "text/css" href="{{asset('anatoliy/styleGroup.css?8')}}" />

    <div class="content">
        <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-xs-8 ">
                <div class="divName">
                    <h2 class="nameGroup">{{$Group->title}}</h2>
                    <h5>{{$Group->description}}</h5>
                        <div class="divdown">
                            <span >Учасників: {{$UsersCount}}</span>
                            <li>
                                <a class="countSub" href="{{route('GroupUsers', $Group->id)}}">
                                Показати учасників
                                </a>
                            </li>
                        </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
                @if(!empty($Group->image))
                    <img class="card-img" style="border-radius: 30px;" src="{{ asset('ImageGroup/'.$Group->image) }}"  alt="Group Photo">
                @else
                    <img class="card-img" style="border-radius: 30px;" src="{{ URL::to('./img/camera.png') }}" alt="User Photo">
                @endif
            </div>
        </div>

            @if(Auth::user()->id!=$Group->idUserOwner)
                @if(!$isGroupUser)
                    <a class="countSubExit" href="{{route('CreateGroupUser', [$Group->id, Auth::user()->id])}}">
                        <span>Вступити в групу</span>
                    </a>
                @endif
                @if($isGroupUser)
                    <div class="exitbtn">
                        <div class="align-btn">
                        <a class="countSubExit" href="{{route('DeleteUserGroup', [$Group->id, Auth::user()->id])}}">
                            <span>Вийти з групи</span>
                        </a>
                        </div>
                    </div>
                @endif
            @endif

            @if(Auth::user()->id==$Group->idUserOwner)
                <hr style="color:#5281b9; height: 2px; margin-top: 10px;">
                <div class="row text-center">

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12 my-3">
                        <a class="btncrud" href="{{ route('CreatePostView', $Group->id)}}">
                            <span class="bnt_create_post">Створити пост</span>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12 my-3">
                        <a class="btncrud" href="{{route('UpdateGroupView', $Group->id)}}">
                            <span class="bnt_create_post">Оновити данні</span>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12 my-3">
                        <a class="btncrud" href="{{route('DeletePhoto', $Group->id)}}">
                            <span class="bnt_delete_post">Видалити фото</span>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12 my-3">
                        <a class="btncrud" href="{{route('DeleteGroup', $Group->id)}}">
                            <span class="bnt_delete_post">Видалити групу</span>
                        </a>
                    </div>

                </div>
            @endif
        </div>
    </div>
            @foreach ($Posts as $post)
                <div class="content">
                @include('nazariy.includes.post', ['post' => $post])
                </div>
            @endforeach


@endsection
