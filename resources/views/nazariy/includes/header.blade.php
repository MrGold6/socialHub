<div class="header_wrap" style="box-shadow:  0 2px 1px -2px gray;">
    <div class="container">
        <div class="my-container">
            <div class="header_wrapper">

                <a href="{{route('home')}}" style="text-decoration: none; color: inherit;">
                    <div class="header_logo_container">
                        <span style="margin-left: 8px; font-size: 30px; background-color: #ffffff; padding: 2px; font-family: 'Cooper Black', sans-serif; font-size: 20px;"><b style="color: #5281b9; margin-right: 2px;">Net</b><b style="background-color: #5281b9; border-radius: 5px; color: #ffffff; padding-left: 3px; padding-right: 3px;">Hub</b></span>
                    </div>
                </a>

                <div class="header_user_container">
                    <a class="header_user_link">
                        <span class="header_user_name">{{ Auth::user()->firstName }}</span>
                        @if( !empty(Auth::user()-> image ) )
                            <img class="header_user_img" src="data:image/jpeg;base64,{{ base64_encode(Auth::user()->image) }}" alt="Profile Image">
                        @else
                            <img class="header_user_img" src="{{ URL::to('./img/camera.png') }}" alt="Nazariy">
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
