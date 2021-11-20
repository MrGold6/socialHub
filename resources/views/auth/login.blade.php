<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="http://fonts.cdnfonts.com/css/cooper-black" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel = "stylesheet" type = "text/css" href="{{asset('anatoliy/style.css')}}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<div class="container">
    <div class="row px-3">
        <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
            <div class="img-left d-none d-md-flex"></div>

            <div class="card-body">
                <h4 class="title text-center mt-4">
                    Ввійдіть в <span class="nethublog"><b class="netlog">Net</b><b class="hublog">Hub</b></span>
                </h4>
                <form class="form-box px-3" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-input">
                        <span><i class="fa fa-envelope"></i></span>
                        <input type="email" name="email" placeholder="Email" tabindex="10" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-input">
                        <span><i class="fa fa-key"></i></span>
                        <input type="password" name="password" placeholder="Пароль" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="cb1" name="">
                            <label class="custom-control-label" for="cb1">Запам'ятати мене</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-block text-uppercase">
                            Ввійти
                        </button>
                    </div>

                    <div class="text-center">
                        <a href="#" class="forget-link">
                            Забули пароль?
                        </a>
                    </div>

                    <div class="text-center mt-3 mb-1">
                        або ввійдіть за допомогою
                    </div>

                    <div class="row mb-3">
                        <div class="col-xl-4 col-lg-4 col-xs-12 py-1"  >
                            <a href="#" class="btn btn-block btn-social btn-facebook">
                                <b>Facebook</b>
                            </a>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-xs-12 py-1">
                            <a href="#" class="btn btn-block btn-social btn-google">
                                <b>Google</b>
                            </a>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-xs-12 py-1">
                            <a href="#" class="btn btn-block btn-social btn-twitter">
                                <b>Twitter</b>
                            </a>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="text-center mb-2">
                        Ще не зареєстровані?
                        <a href="{{ route('register') }}" class="register-link">
                            Зареєструватись зараз
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
