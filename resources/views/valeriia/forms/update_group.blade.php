@extends('layout.template')

@section('content')
    <link rel = "stylesheet" type = "text/css" href="{{asset('anatoliy/style_create_group.css?2')}}" />

    <div class="content">
        <div class="row">


            <div class="col-xl-7 col-lg-10 col-md-10 col-sm-10 mx-auto p-3 pt-3">
                <div class="card card_form">
                    <div class="card-body ">
                        <legend class="card-title text-center text_style">Група</legend>
                        <form action="{{ route('UpdateGroup') }}" method="post"  enctype="multipart/form-data">
                            @csrf

                            <input class="form-control" style="color: #5281b9;" type="hidden" name="id" maxlength="20" value="{{$Group->id}}" required>

                            <div class="row mb-3">
                                <label class="col-sm-6 col-form-label ln text_style">Назва:</label>
                                    <input class="form-control" style="color: #5281b9;" type="text" name="title"  value="{{$Group->title}}" required>
                            </div>

                            <div class="row mb-5">
                                <label class="col-sm-6 col-form-label ln text_style">Опис:</label>
                                    <input class="form-control" style="color: #5281b9;" type="text" name="description" value="{{$Group->description}}" required>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6 col-form-label ln text_style">Власник групи:</label>
                                <div class="col-sm-6">
                                    <select name="idUserOwner" style="color: #5281b9;" class="form-select">
                                        @foreach($Users as $user)
                                            <option  value="{{ $user->id }}" @if($user->id == $Group->idUserOwner) selected @endif>{{ $user->lastName }} {{ $user->firstName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6 col-form-label ln text_style">Фото  @if($Group->image !=null)  @endif:</label>
                                    <input id="image" class="form-control" style="color: #5281b9;" type="file" name="upload_file" >
                            </div>

                            <center><input type="submit" class="btn btn_create" value="Редагування"></center>
                        </form>

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
