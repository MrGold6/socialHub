@extends('layout.template')
@section('content')
    <link rel="stylesheet" href="{{ asset('slick/styleSlider.css') }}">
    <link rel="stylesheet" href="{{ asset('slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('slick/slick-theme.css') }}">

{{--    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">--}}

    <div class="content container mb-4">
        <div>
            <center>
                <section class="regular slider bannerSlick">
                    @foreach($Images as $image)
                        <img src="{{ asset('ImagePost/'.$image->imageName) }}" alt="" class="postImg">
                    @endforeach
                </section>
                <div class="row">
                    <div class="col-12">
                        <p style="text-align: justify;">
                            {{ $post->text }}
                        </p>
                    </div>
                    <div class="likes">
                        <center>
                            <div style="display: flex">
                                <div style="display: flex">
                                    <span>Вподобань&nbsp;</span>
                                    <label class="ml-2" postId="{{ $post->id }}" id="likes">{{ $countLike }}</label>
                                </div>
                                &nbsp;
                                <i id="like" postId="{{ $post->id }}" class="ml-2 mt-1 {{ ($myLike == 1) ? 'fas' : 'far' }} fa-heart js-heart heart"></i>
                            </div>
                        </center>
                    </div>
                </div>
                <div class="row mb-4 mt-3" style="margin-left: 0.1%; margin-right: 0.1%">
                    <div class="col-12 comment">
                        <div class="row">
                            <div class="col-10">
                                <textarea aria-label="Добавьте комментарий..." required style="width: 100%" data-testid="post-comment-text-area" placeholder="Добавьте комментарий..." id="comment" name="comment" class="my-comment" autocomplete="off" autocorrect="off"></textarea>
                            </div>
                            <div class="col-1">
                                <button class="mt-1" style="background-color: transparent; color: #5281B9; border-color: transparent" id="createComment" idPost="{{ $post->id }}">
                                    Відправити
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </center>
        </div>
        @if(isset($comments))
            @include('evgen.comments', ['Comments' => $comments, 'postId' => 1])
        @endif
        @include('evgen.likePost')
    </div>
    <style>
        .arrowbtn {
            position: absolute;
            width: 40px;
            height: 40px;
            background: #fff;
            border: 2px solid #5281B9;
            border-radius: 100px;
            color: #5281B9;
            cursor: pointer;
            left: 50%;
            line-height: 100px;
            margin-left: -50px;
            transition: all 0.25s ease-in-out;
        }
        .arrowbtn:hover {
            background: white;
            border-color: white;
            color: #111;
        }
        .arrowbtn:after {
            position: absolute;
            display: inline-block;
            content: "";
            width: 15px;
            height: 15px;
            top: 50%;
            left: 50%;
        }
        .arrowbtn-right {
            bottom: 10px;
        }
        .arrowbtn-right:after {
            margin-left: -11.5px;
            margin-top: -7.75px;
            border-bottom: 2px solid;
            border-right: 2px solid;
            transform: rotateZ(315deg);
        }
    </style>
    <style>
        .vl {
            border-left: 2px solid #e6e6e6;
            height: 100%;

            padding-left: 2%;
        }
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
            border-radius: 5px;
            padding: 8px 0px 4px 10px;
            border-color: transparent;
            color: rgba(38,38,38, 1);
            height: 50px;
            max-height: 90px;
            resize: none;
        }
        /*box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.2);*/
        .comment:focus {
            text-decoration: none;
            outline: none;
            border: #fff;
        }
        input:hover,
        input:active,
        input:focus,
        button:focus,
        button:active,
        button:hover,
        textarea:focus,
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
            color: #666;
        }
        .comment {
            border-radius: 5px;
            border-color: transparent;
            padding: 15px 0px 5px 15px;
            box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.2);
        }
    </style>
    <script src="{{ asset('slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>
    <script>
        var slider = $(".slider").slick({
            dots: true,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000
        });
    </script>
    <script>
        $('body').delegate('#createComment', 'click', function () {
            let comment = $('#comment').val()
            let idPost = $(this).attr('idPost')
            $.ajax({
                url: '{{ route('createComment') }}',
                method: 'post',
                data: {
                    _token : $('meta[name="csrf-token"]').attr('content'),
                    comment: comment,
                    idPost: idPost
                },
                success: function (data) {
                    $('#createdComment').prepend(data)
                    $('#comment').val('')
                }
            })
        })
        $('body').delegate('#checkAnswer', 'click', function () {
            let id = 0, typeOfAnswer = 'mainComment', idMainComment = $(this).attr('idMainComment')

            if($(this).attr('idAnswerComment')) {
                id = $(this).attr('idAnswerComment')
                typeOfAnswer = 'answerComment'
                idMainComment = $(this).attr('idMainComment')
            }

            $.ajax({
                url: '{{ route('commentAnswer') }}',
                method: 'get',
                data: {
                    typeOfAnswer: typeOfAnswer,
                    idMainComment: idMainComment,
                    id: id
                },
                success: function (data) {
                    let where
                    if(id === 0)
                        where = '.' + typeOfAnswer + '-' + idMainComment
                    else
                        where = '.' + typeOfAnswer + '-' + id
                    $('div[class="idMainCommentCreate' + idMainComment + '"]').remove()
                    $(where).replaceWith(data)
                }
            })
        })
        $('body').delegate('#deleteComment', 'click', function () {
            let type = 'main'
            let id
            if($(this).attr('idAnswerComment')) {
                type = 'answer'
                id = $(this).attr('idAnswerComment')
            }
            else
                id = $(this).attr('idMainComment')

            $.ajax({
                url: '{{ route('deleteComment') }}',
                method: 'post',
                data: {
                    _token : $('meta[name="csrf-token"]').attr('content'),
                    type: type,
                    id: id
                },
                success: function () {
                    $('div[idMainComment="' + id + '"]').remove()
                }
            })
        })
        $('body').delegate('#createAnswer', 'click', function () {
            $(this).attr("disabled", true)
            let id = $(this).attr('idPost')
            let idMainComment = $(this).attr('idMainComment')
            let comment = '<div class="form-group">' +
                '<div class="row ml-1">' +
                '<input idMainComment="' + idMainComment + '" type="text" class="form-control" id="textAnswerComment" placeholder="Відповідь">' +
                '<button idMainComment="' + idMainComment + '" idPost="' + id + '" id="sendAnswerComment" style="width: 15%; background-color: transparent; border-color: transparent; color: #5281B9" class="ml-3">Відправити</button>'+
                '</div>'
            '</div>'

            $(this).parent().parent().parent().append(comment)
        })
        $('body').delegate('#sendAnswerComment', 'click', function () {
            let idMainComment = $(this).attr('idMainComment')
            let comment = $('input[idMainComment="' + idMainComment + '"]').val()
            $.ajax({
                url: '{{ route('createAnswerCommentMain') }}',
                method: 'post',
                data: {
                    _token : $('meta[name="csrf-token"]').attr('content'),
                    idMainComment: idMainComment,
                    comment: comment
                },
                success: function (data) {
                    data = "<div class='idMainCommentCreate" + idMainComment + "'>" + data + "</div>"
                    $('button[idMainComment="' + idMainComment + '"]').removeAttr('disabled')
                    $('input[idMainComment="' + idMainComment + '"]').parent().parent().parent().append(data)
                    $('input[idMainComment="' + idMainComment + '"]').parent().parent().remove()
                }
            })
        })
    </script>
    <script>
        $('body').delegate('#deleteAnswer', 'click', function () {
            let idAnswerComment = $(this).attr('idAnswerComment')
            $.ajax({
                url: '{{ route('deleteComment') }}',
                method: 'post',
                data: {
                    _token : $('meta[name="csrf-token"]').attr('content'),
                    id: idAnswerComment,
                    type: 'answer'
                },
                success: function () {
                    $('div[answerComment="' + idAnswerComment + '"]').remove()
                }
            })
        })
        $('body').delegate('#createAnswerToAnswer', 'click', function () {
            $(this).attr("disabled", true)
            let idAnswerComment = $(this).attr('idAnswerComment')
            let idMainComment = $(this).attr('idMainComment')
            let comment = '<div class="form-group">' +
                '<div class="row ml-1">' +
                '<input answerToComment="' + idAnswerComment + '" type="text" class="form-control" id="textAnswerComment" placeholder="Відповідь">' +
                '<button idMainComment="' + idMainComment + '" idAnswerComment="' + idAnswerComment + '" id="sendAnswerToAnswer" style="width: 15%; background-color: transparent; border-color: transparent; color: #5281B9" class="ml-3">Відправити</button>'+
                '</div>'
            '</div>'

            $(this).parent().parent().parent().append(comment)
        })
        $('body').delegate('#sendAnswerToAnswer', 'click', function () {
            let idAnswerComment = $(this).attr('idAnswerComment');
            let idMainComment = $(this).attr('idMainComment');
            let comment = $('input[answerToComment="' + idAnswerComment + '"]').val()

            $.ajax({
                url: '{{ route('createAnswerToAnswer') }}',
                method: 'post',
                data: {
                    _token : $('meta[name="csrf-token"]').attr('content'),
                    idAnswerComment: idAnswerComment,
                    idMainComment: idMainComment,
                    comment: comment
                },
                success: function (data) {
                    $('button[idAnswerComment="' + idAnswerComment + '"]').removeAttr('disabled')
                    $('input[answerToComment="' + idAnswerComment + '"]').parent().parent().parent().append(data)
                    $('input[answerToComment="' + idAnswerComment + '"]').parent().parent().remove()
                }
            })
        })
    </script>

@endsection
