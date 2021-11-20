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
    <link rel = "stylesheet" type = "text/css" href="{{asset('anatoliy/styleRegister.css')}}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
<div class="container">
    <div class="row px-3">
        <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
            <div class="img-left d-none d-md-flex"></div>

            <div class="card-body">
                <h4 class="title text-center mt-4">
                    Реєстрація в <span class="nethubreg"><b class="netreg">Net</b><b class="hubreg">Hub</b></span>
                </h4>
                <form method="POST" action="{{ route('register') }}" class="form-box px-3">
                    @csrf
                    <div class="form-input">
                        <span><i class="fa fa-user"></i></span>
                        <input type="text" name="firstName" placeholder="Ім'я" required>
                    </div>
                    <div class="form-input">
                        <span><i class="fa fa-user"></i></span>
                        <input type="text" name="lastName" placeholder="Прізвище" required>
                    </div>
                    <div class="form-input">
                        <span><i class="fa fa-user"></i></span>
                        <input type="text" name="middleName" placeholder="По-батькові" required>
                    </div>
                    <div class="form-input">
                        <span><i class="fa fa-envelope"></i></span>
                        <input type="email" name="email" placeholder="Email Адреса" tabindex="10" required>
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

                    <div class="form-input">
                        <span><i class="fa fa-calendar-alt"></i></span>
                        <input type="date" name="birthday" placeholder="Дата народження" required>
                    </div>

                    <div class="mb-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="cb2" name="" required>
                            <label class="custom-control-label" for="cb2">Даю згоду на обробку персональних даних</label>
                        </div>
                    </div>

                    <hr class="my-4">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-block text-uppercase">
                            Зареєструватись
                        </button>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('login') }}" class="forget-link">
                            Вже зареєстровані?
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
