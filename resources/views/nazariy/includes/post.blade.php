@if(!isset($post->idGroup) || $post->idGroup == 0)

    <a style="text-decoration: none;" href="{{ route('user', (isset($post->userId) ? $post->userId : $post->idOwner)) }}">
        <div style="display: inline-flex; align-items: center;">
            @if( !empty($post->image ) )
                <img class="messages_user_img" src="data:image/jpeg;base64,{{ base64_encode($post->image) }}" alt="{{$post->firstName}}">
            @else
                <img class="messages_user_img" src="{{ URL::to('./img/camera.png') }}" alt="{{$post->firstName}}">
            @endif
            <p style="margin: 0px 10px; text-decoration: none;"><b>{{$post->lastName}}  {{$post->firstName}}  {{$post->middleName}}</b></p>
        </div>

    </a>
@endif

@if(isset($post->idGroup) && $post->idGroup != 0)
    <a href="{{route('Group', $post->idGroup)}}" style="text-decoration: none;">
        <p><b>{{$post->titleGroup}}</b></p>
    </a>
@endif

    <center>
        <center>
            @if(!empty(asset('ImagePost/'.$post->id.'.jpg')))
                    <img src="{{ asset('ImagePost/'.$post->id.'.jpg') }}" class="image" width="450px"  alt="">

            @endif
        </center>

        @if((isset($post->userId) ? $post->userId : $post->idOwner) == \Illuminate\Support\Facades\Auth::id())
        <form action="{{ route('deletePost') }}" method="post" enctype="multipart/form-data">
            @csrf

                <input type="hidden" name="post" value="{{ $post->id }}">

                <button type="submit" class="post_delete_btn"  title=" ">
                    <i class="fas fa-times"></i>
                </button>

        </form>
        @endif
        <div class="post_wrapper">
            <p style="padding: 0 15px 5px 15px; text-align: justify;">
                {{$post->text}}
            </p>
            <p class="text-center showmore">
                <a class="ashow" href="{{ route('currentPost', [$post->id]) }}" style="text-decoration: none;">
                    <span style="color: #5281b9" class="first">Переглянути більше </span>
                    <span class="second"><i class="fas fa-chevron-down " style="color: #5281b9; font-size: 25px;"></i></span>
                </a>
            </p>
        </div>
        </center>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');
        .fas {
            color: red;
        }
        .comment {
            text-align: left;
            display: inline-flexbox;
        }

        .post_description_wrap {
            display: flex;
            justify-content: space-between;
        }

        .showmore{
            margin-top: 10px;
        }

        .ashow:hover .first{
            display: none;
        }

        .ashow .second{
            display: none;
        }

        .ashow:hover .second{
            display: inline;
        }

        .post_wrapper {
            max-width: 675px;
            margin: 0 auto;
        }


        .user-name {
            color: rgba(38,38,38);
            font-weight: 600;
            font-size: 14px;
        }

        .user-comment {
            color: rgba(38,38,38);
            font-weight: 400;
            font-size: 14px;
            margin-left: 10px;
        }

        .user-comment-delete {
            border: 0;
            color: red;
            padding: 0;
            position: relative;
            appearance: none;
            background: 0 0;
            font-weight: 600;
            text-align: center;
            text-transform: inherit;
            text-overflow: ellipsis;
            width: auto;
            font-size: 14px;
            line-height: 18px;
            margin-left: 30px;
        }

        .my-comment {
            background: 0 0;
            border: 0;
            color: rgba(38,38,38);
            display: flex;
            flex-grow: 1;
            max-height: 80px;
            resize: none;
            height: 100px;
            width: 350px;
        }

        .comment:focus {
            text-decoration: none;
            outline: none;
            border: #fff;
        }
        textarea:hover,
        input:hover,
        textarea:active,
        input:active,
        textarea:focus,
        input:focus,
        button:focus,
        button:active,
        button:hover,
        label:focus,
        .btn:active,
        .btn.active
        {
            outline:0px !important;
            -webkit-appearance:none;
            box-shadow: none !important;
        }

        .comment-wrapper {
            display: inline-flex;
        }

        .comment-btn {
            border: 0;
            color: rgba(0,149,246);
            padding: 0;
            position: relative;
            appearance: none;
            background: 0 0;
            font-weight: 600;
            text-align: center;
            text-transform: inherit;
            text-overflow: ellipsis;
            width: auto;
            font-size: 14px;
            line-height: 18px;
        }

        .form-control {
            width: 50%;
        }

        .comment-form {
            display: block;
            text-align: left;
        }

        h4 {
            text-align: left;
        }

        .heart {
            cursor: pointer;
        }

        .pulse {
            animation: pulse .5s;
        }




        a.control_prev, a.control_next {
            position: absolute;
            top: 40%;
            z-index: 999;
            display: block;
            padding: 4% 3%;
            width: auto;
            height: auto;
            background: #2a2a2a;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            font-size: 18px;
            opacity: 0.8;
            cursor: pointer;
        }

        a.control_prev:hover, a.control_next:hover {
            opacity: 1;
            -webkit-transition: all 0.2s ease;
        }

        a.control_prev {
            border-radius: 0 2px 2px 0;
        }

        a.control_next {
            right: 0;
            border-radius: 2px 0 0 2px;
        }

        .slider_option {
            position: relative;
            margin: 10px auto;
            width: 160px;
            font-size: 18px;
        }



        .title {
            padding: 10px;
        }
        .post {
            border-radius: 5px;
        }
        .comment {
            border-radius: 5px;
        }
        .likes {
            font-size: 20px;
            text-align: left;
            font-weight: 300;
            color: #666;
            margin-right: 20px;
        }
        img {
            border-radius: 4px;
            width: 90%;
            margin-bottom: 20px;
        }

        p {
            font-family: 'Ubuntu', sans-serif;
            font-size: 18px;
            font-weight: 400;
            line-height: 28.8px;
            color: #666;
        }
    </style>
