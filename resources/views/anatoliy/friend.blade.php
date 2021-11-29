@extends('layout.template')
@section('content')
   <link rel = "stylesheet" type = "text/css" href="{{asset('anatoliy/styleFriend.css?2')}}" />
   <div>

            <div class="container">

                <div class="tab">
                    <button class="tablinks btnunder3" onclick="openCity(event, 'Tokyo')">Запити в друзі</button>
                    <button class="tablinks btnunder2" onclick="openCity(event, 'Paris')" id="defaultOpen">Мої друзі</button>
                </div>

                <div id="Paris" class="tabcontent">
                    <div class="py-2">

                        @foreach($friends as $friend)

                                <div class="row rowmain py-1 my-2">
                                    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-xs-12 text-center">
                                        <a href="{{ route('user', [$friend->id]) }}" >
                                            <img class="imguser" style="width: 100px; border-radius: 100px;" src="data:image/jpeg;base64,{{ base64_encode($friend->image) }}"/>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 pt-3 text-center">
                                        <a href="{{ route('user', [$friend->id]) }}" style="text-decoration: none;">
                                            <h4 class="mt-0 name">{{$friend->firstName}} {{$friend->middleName}}</h4>
                                        </a>
                                        {{$friend->email}}
                                    </div>

                                    <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 col-xs-12 pt-4 text-center">
                                        <b class="name">День народження</b><br>
                                        <i class="mt-0"><i class="fas fa-gift ikons"></i>{{$friend->birthday}} </i>

                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-xs-12 pt-4 text-center">

                                        <div class="dropdown ">
                                            <span class="btn-treedots">. . .</span>
                                            <div class="dropdown-content">
                                                <a href="{{ route('chat', $friend->id) }}" class="txt"><i class="far fa-comments ikons py-1 "></i>Написати</a><br>
                                                <a href="{{route('DeleteRequest',  $friend->id)}}" class=" text-danger py-1 txt"><i class="fas fa-trash-alt text-danger ikonsdel"></i>Видалити</a><br>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            @endforeach

                    </div>

                </div>


                <div id="Tokyo" class="tabcontent">
                    <div class="py-1 my-2">
                        @foreach($requestsFriends as $requestFriend)
                        <div class="row rowmain py-1 my-1">
                            <div class="col-xl-2 col-lg-2 col-md-5 col-sm-12 col-xs-12 text-center">
                                <a href="{{ route('user', [$requestFriend->id]) }}">
                                    @if(!empty($requestFriend->image))
                                        <img class="imguser" style="width: 100px; border-radius: 100px;" src="data:image/jpeg;base64,{{ base64_encode($requestFriend->image) }}"/>
                                    @else
                                        <img class="imguser" style="width: 100px; border-radius: 100px;" src="{{ URL::to('./img/camera.png') }}" alt="User Photo">
                                    @endif
                                </a>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-7 col-sm-12 col-xs-12 pt-3 text-center">
                                <a href="{{ route('user', [$requestFriend->id]) }}" style="text-decoration: none;">
                                  <h4 class="mt-0 name">{{$requestFriend->firstName}} {{$requestFriend->middleName}}</h4>
                                </a>
                                {{$requestFriend->email}}
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 pt-4 text-center">
                                <b class="name">День народження</b><br>
                                <i class="mt-0"><i class="fas fa-gift ikons"></i>{{$requestFriend->birthday}} </i>

                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 pt-2 text-center">
                                    <a href="{{route('ConfirmRequest',  $requestFriend->id)}}" type="button" class="btn text-center btnok"><i class="far fa-check-circle"></i>Прийняти запит</a>
                                    <a href="{{route('DeleteRequest',  $requestFriend->id)}}" type="button" class="btn text-center text-danger my-1 btnno"><i class="far text-danger fa-times-circle"></i>Відхилити запит</a>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>

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





