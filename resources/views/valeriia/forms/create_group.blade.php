@extends('layout.template')

@section('content')
    <link rel = "stylesheet" type = "text/css" href="{{asset('anatoliy/style_create_group.css?1')}}" />

    <div class="content">
        <div class="row">


            <div class="col-xl-7 col-lg-10 col-md-10 col-sm-10 mx-auto p-3 pt-3">
                <div class="card card_form">
                    <div class="card-body ">
                        <legend class="card-title text-center text_style">Група</legend>
                        <form action="{{ route('CreateGroup') }}" method="post"  enctype="multipart/form-data">
                            @csrf

                            <input class="form-control" type="hidden" style="color: #5281b9;" name="idUserOwner" value="{{Auth::user()->id}}" readonly>

                            <div class="row mb-3">
                                <label class="col-sm-6 col-form-label ln text_style">Назва:</label>
                                    <input class="form-control" style="color: #5281b9;" type="text" name="title"  required>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6 col-form-label ln text_style">Опис:</label>
                                    <input class="form-control" style="color: #5281b9;" type="text" name="description" required>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6 col-form-label ln text_style">Фото:</label>
                                    <input id="image" class="form-control" style="color: #5281b9;" type="file" name="upload_file" required>
                            </div>

                            <center><input type="submit" class="btn btn_create" value="Створити"></center>
                        </form>

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
