@extends('layout.template')

@section('content')
    <link rel = "stylesheet" type = "text/css" href="{{asset('anatoliy/styleAllGroups.css?5')}}" />

    <div class="container">

        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <form action="{{ route('searchGroupsByName') }}" class="d-flex mb-2 inpserach" method="post" enctype="multipart/form-data">
                    @csrf
                    <input class="form-control me-2" type="search" name="groupName" placeholder="Назва групи" aria-label="Search">
                    <input value="Пошук" class="btn btnok" type="submit">
                </form>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <a href="{{route('Groups')}}" class="btn btnmy" type="submit">Всі Групи</a>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <a href="{{route('myGroups')}}" class="btn btnmy" type="submit">Мої Групи</a>
            </div>
        </div>
        <div class="d-grid gap-2">
            <a href="{{route('CreateGroupView')}}" class="btn btn-create" type="button">Створити групу</a>
        </div>


        <div class="py-2">

            @foreach ($Groups as $group)

                <div class="row rowmain py-1 my-2">
                    <div class="col-xl-2 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                        @if(!empty($group->image))
                            <img style="width: 100px; border-radius: 100px;" src="{{ asset('ImageGroup/'.$group->image) }}">
                        @else
                            <img style="width: 100px; border-radius: 100px;" src="{{ URL::to('./img/camera.png') }}" alt="Group Photo">
                        @endif
                    </div>
                    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-xs-12 groupcontext ">
                        <h5 style="margin-top: 20px;"><a class="namegroups" href="{{route('Group', $group->id)}}">{{$group->title}}</a></h5>
                    </div>

                </div>



            @endforeach

        </div>
    </div>


@endsection
