@extends('layout.template')

@section('content')
    <link rel = "stylesheet" type = "text/css" href="{{asset('anatoliy/styleAllGroups.css?5')}}" />

    <div class="container">

        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <form class="d-flex mb-2">
                    <input class="form-control inpserach me-2" type="search" placeholder="Пошук по групам" aria-label="Search">
                    <a class="btn btnok" type="submit">Пошук</a>

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
                            <img style="width: 100px; border-radius: 100px;" src="{{ URL::to('./img/camera.png') }}" alt="User Photo">
                        @endif
                    </div>
                    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-xs-12 groupcontext ">
                        <h5 class="text-left"><a class="namegroups" href="{{route('Group', $group->id)}}">{{$group->title}}</a></h5>
                        <span class="text-left">Учасників: 1</span>
                    </div>

                    <div class="col-xl-2 col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-4">
                        <div class="dropdown">
                            <span class="btn-treedots">. . .</span>
                            <div class="dropdown-content">
                                <a href="" class="txt"><i class="far fa-plus-square ikonsdel"></i>Вступити</a><br>
                                <a href="#" class="pt-1 text-danger txt"><i class="fas fa-external-link-square-alt text-danger ikonsblock py-1 "></i>Покинути</a>
                            </div>
                        </div>
                    </div>

                </div>



            @endforeach

        </div>
    </div>


@endsection
