@extends('layout.template')

@section('content')
    <div class="content">
        <div class="row">


            <div class="col-xl-7 col-lg-10 col-md-10 col-sm-10 mx-auto p-3 pt-3">
                <div class="card card_form shadow">
                    <div class="card-body ">
                        <legend class="card-title text-center">Група</legend>
                        <form action="{{ route('CreateGroup') }}" method="post"  enctype="multipart/form-data">
                            @csrf

                            <input class="form-control" type="hidden" name="idUserOwner" value="{{Auth::user()->id}}" readonly>

                            <div class="row mb-3">
                                <label class="col-sm-6 col-form-label ln">Назва:</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="title"  required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6 col-form-label ln">Опис:</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="description" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6 col-form-label ln">Фото:</label>
                                <div class="col-sm-6">
                                    <input id="image" class="form-control"  type="file" name="upload_file" >
                                </div>
                            </div>

                            <center><input type="submit" class="btn btn-success" value="Створення"></center>
                        </form>

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
