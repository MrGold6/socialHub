@extends('layout.template')

@section('content')
    <div class="content">
        <div class="row">


            <div class="col-xl-7 col-lg-10 col-md-10 col-sm-10 mx-auto p-3 pt-3">
                <div class="card card_form shadow">
                    <div class="card-body ">
                        <legend class="card-title text-center">Пост</legend>
                        <form action="{{ route('CreatePost') }}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="idOwner" value="{{$Group->idUserOwner}}">
                            <input type="hidden" name="idGroup" value="{{$Group->id}}">

                            <div class="row mb-3">
                                <label class="col-sm-6 col-form-label ln">Текст:</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="text" required>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit" name="commentB">Create</button>

                            </form>

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
