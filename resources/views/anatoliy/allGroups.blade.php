@extends('layout.template')
@section('content')
    <link rel = "stylesheet" type = "text/css" href="{{asset('anatoliy/styleAllGroups.css?1')}}" />

    <div class="container">

        <form class="d-flex mb-2">
            <input class="form-control inpserach me-2" type="search" placeholder="Пошук по групам" aria-label="Search">
            <button class="btn btnok" type="submit">Пошук</button>
        </form>

        <div class="d-grid gap-2">
            <button class="btn btn-create" type="button">Створити групу</button>
        </div>

        <div class="py-2">

            @foreach($groups as $group)

                <div class="row rowmain py-1 my-2">
                    <div class="col-xl-2 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                            <img style="width: 100px; border-radius: 100px;" src="{{ asset('ImagePost/'.$group->image) }}">

                    </div>
                    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-xs-12 groupcontext ">
                        <h5 class="text-left">{{$group->title}}</h5>
                        <span class="text-left">Учасників: <i>here count members</i></span>
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
