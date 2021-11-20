@extends('layout.template')

@section('content')
    <div class="content">
        <div class="row">


            <div class="col-xl-7 col-lg-10 col-md-10 col-sm-10 mx-auto p-3 pt-3">
                <div class="card card_form shadow">
                    <div class="card-body ">
                        <legend class="card-title text-center">Група</legend>
                        <form action="{{ route('UpdateGroup') }}" method="post"  enctype="multipart/form-data">
                            @csrf

                            <input class="form-control" type="hidden" name="id" maxlength="20" value="{{$Group->id}}" required>

                            <div class="row mb-3">
                                <label class="col-sm-6 col-form-label ln">Назва:</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="title"  value="{{$Group->title}}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6 col-form-label ln">Опис:</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="description" value="{{$Group->description}}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6 col-form-label ln">Власник групи:</label>
                                <div class="col-sm-6">
                                    <select name="idUserOwner" class="form-select">
                                        @foreach($Users as $user)
                                            <option value="{{ $user->id }}" @if($user->id == $Group->idUserOwner) selected @endif>{{ $user->lastName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-6 col-form-label ln">Фото  @if($Group->image !=null) + @endif:</label>
                                <div class="col-sm-6">
                                    <input id="image" class="form-control"  type="file" name="upload_file" >
                                </div>
                            </div>

                            <center><input type="submit" class="btn btn-warning" value="Редагування"></center>
                        </form>

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
