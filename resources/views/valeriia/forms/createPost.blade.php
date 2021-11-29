@extends('layout.template')

@section('content')
    <link rel = "stylesheet" type = "text/css" href="{{asset('anatoliy/style_create_group.css?2')}}" />

    <div class="content">
        <div class="row">
            <div class="col-xl-7 col-lg-10 col-md-10 col-sm-10 mx-auto p-3 pt-3">
                <div class="card card_form">
                    <div class="card-body ">
                        <legend class="card-title text-center text_style">Пост</legend>
                        <form action="{{ route('CreatePost') }}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="idOwner" value="{{$Group->idUserOwner}}">
                            <input type="hidden" name="idGroup" value="{{$Group->id}}">

                            <div class="row mb-3">
                                <label class="col-sm-6 col-form-label ln text_style">Фото:</label>
                                <input id="image" class="form-control" style="color: #5281b9;" type="file" name="upload_file" >
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6 col-form-label ln text_style">Текст:</label>
                                    <input class="form-control" style="color: #5281b9;" type="text" name="text" required>
                            </div>
                            <div class="text-center">
                            <button class="btn btn_create" type="submit" name="commentB">Створити</button>
                            </div>
                            </form>

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
