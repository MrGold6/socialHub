@extends('layout.template')
@section('content')
   <link rel = "stylesheet" type = "text/css" href="{{asset('anatoliy/styleFriend.css')}}" />
   <div>

            <div class="container">

                <div class="tab">
                    <button class="tablinks btnunder3" onclick="openCity(event, 'Tokyo')">Пошук</button>
                    <button class="tablinks btnunder2" onclick="openCity(event, 'Paris')">Запити в друзі</button>
                    <button class="tablinks btnunder1" onclick="openCity(event, 'London')" id="defaultOpen">Мої друзі</button>
                </div>

                <div id="London" class="tabcontent">
                    <div class="py-2">

                        @foreach($friends as $friend)

                                <div class="rowmain py-1 my-2">
                                    <a href="{{ route('user', [$friend->id]) }}">
                                    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-xs-12 text-center">
                                        <img class="imguser" style="width: 100px; border-radius: 100px;" src="data:image/jpeg;base64,{{ base64_encode($friend->image) }}"/>
                                    </div>
                                    </a>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 pt-3 text-center">
                                        <h4 class="mt-0">{{$friend->firstName}} {{$friend->middleName}}</h4>
                                        {{$friend->email}}
                                    </div>

                                    <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 col-xs-12 pt-4 text-center">
                                        <b>День народження</b><br>
                                        <i class="mt-0"><i class="fas fa-gift ikons"></i>{{$friend->birthday}} </i>

                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-xs-12 pt-4 text-center">

                                        <div class="dropdown ">
                                            <span class="btn-treedots">. . .</span>
                                            <div class="dropdown-content">
                                                <a href="#" class="txt"><i class="far fa-comments ikons py-1 "></i>Написати</a><br>
                                                <a href="{{route('DeleteRequest',  $friend->id)}}" class=" text-danger py-1 txt"><i class="fas fa-trash-alt text-danger ikonsdel"></i>Видалити</a><br>
                                                <a href="#" class=" text-danger txt"><i class="fas fa-ban text-danger ikonsblock py-1 "></i>Блокувати</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>



                            @endforeach

                    </div>

                </div>




                @foreach($requestsFriends as $requestFriend)

                <div id="Paris" class="tabcontent">
                    <div class="py-2">
                        <div class="rowmain py-1 my-1">
                            <a href="{{ route('user', [$requestFriend->id]) }}">
                                <div class="col-xl-2 col-lg-2 col-md-5 col-sm-12 col-xs-12 text-center">
                                    <img class="imguser" style="width: 100px; border-radius: 100px;" src="data:image/jpeg;base64,{{ base64_encode($requestFriend->image) }}"/>
                                </div>
                            </a>

                            <div class="col-xl-3 col-lg-3 col-md-7 col-sm-12 col-xs-12 pt-3 text-center">
                                <h4 class="mt-0">{{$requestFriend->firstName}} {{$requestFriend->middleName}}</h4>
                                {{$requestFriend->email}}
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 pt-4 text-center">
                                <b>День народження</b><br>
                                <i class="mt-0"><i class="fas fa-gift ikons"></i>{{$requestFriend->birthday}} </i>

                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 pt-2 text-center">
                                    <a href="{{route('ConfirmRequest',  $requestFriend->id)}}" type="button" class="btn text-center btnok"><i class="far fa-check-circle"></i>Прийняти запит</a>
                                    <a href="{{route('DeleteRequest',  $requestFriend->id)}}" type="button" class="btn text-center text-danger my-1 btnno"><i class="far text-danger fa-times-circle"></i>Відхилити запит</a>
                            </div>
                        </div>


                    </div>
                </div>

                @endforeach


                @foreach($notFriends as $notFriend)
                <div id="Tokyo" class="tabcontent">

                    <div class="py-2">

                        <form class="d-flex mb-2">
                            <input class="form-control inpserach me-2" type="search" placeholder="Ім'я користувача" aria-label="Search">
                            <button class="btn btnok" type="submit">Пошук</button>
                        </form>

                        <div class="rowmain py-1 my-1">
                            <div class="col-xl-1 col-lg-1 col-md-6 col-sm-6 col-xs-6 text-center">
                                <img class="imguser" style="width: 100px; border-radius: 100px;" src="data:image/jpeg;base64,{{ base64_encode($notFriend->image) }}"/>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6 pt-2 text-center">
                                <h4 class="mt-2">{{$notFriend->firstName}} {{$notFriend->middleName}}</h4>
                                {{$notFriend->email}}
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 pt-4 text-center">
                                <b>День народження</b><br>
                                <i class="mt-0"><i class="fas fa-gift ikons"></i>{{$notFriend->birthday}} </i>

                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 pt-2 text-center">
                                <button type="button" class="btn text-center btnok mt-4"><i class="fas fa-user-plus"></i>Додати до друзів</button>
                            </div>
                        </div>

                    </div>

                </div>
                @endforeach

           <script>
               function openCity(evt, cityName) {
                   // Declare all variables
                   var i, tabcontent, tablinks;

                   tabcontent = document.getElementsByClassName("tabcontent");
                   for (i = 0; i < tabcontent.length; i++) {
                       tabcontent[i].style.display = "none";
                   }

                   tablinks = document.getElementsByClassName("tablinks");
                   for (i = 0; i < tablinks.length; i++) {
                       tablinks[i].className = tablinks[i].className.replace(" active", "");
                   }

                   document.getElementById(cityName).style.display = "block";
                   evt.currentTarget.className += " active";
               }
               document.getElementById("defaultOpen").click();
           </script>


   </div>
@endsection





