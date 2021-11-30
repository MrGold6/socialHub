@extends('layout.template')
@section('content')
    <div class="chat">
        <div class="chatHeader">
            <div class="row">
                <div class="col-1">
                    <img style="width: 52px; border-radius: 100px;" src="data:image/jpeg;base64,{{ base64_encode($user->image) }}"/>

                </div>
                <div class="col-11">
                    <h4>{{ $user->firstName.' '.$user->middleName }}</h4>
                </div>
            </div>
        </div>
        <div class="contentChat">
            <div style="overflow-y: auto; overflow-x: hidden" class="allMessage">
                @include('evgen.chatMessages', ['messages' => $messages])
            </div>
            <div style="width: 100%;" class="sendMessage mt-2">
                <form style="margin-right: 5%;">
                    <input type="text" class="form-control" id="message" placeholder="Повідомлення.." value="" required="">
                    <input type="submit" id="sendMessage" class="btn btn-primary mt-2 mb-2" style="width: 100%" value="Відправити">
                </form>
            </div>
        </div>
    </div>
    <style>
        ::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }
        .allMessage {
            scrollbar-width: none;
        }
        html {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .chat {
            border-radius: 4px;
            background-color: white;
            padding: 15px;
            min-height: 87vh;
            position: relative;

        }
        .contentChat {
            position: absolute;
            bottom: 0;
            width: 100%;
            {{--background-image: url('{{ asset('chatBackground/Background.jpg') }}');--}}
        }
        .allMessage {
            height: 65vh;
        }
        .message {
            padding: 5px;
        }
    </style>
    <script>
        var lastMessageId = {{ isset($messages[count($messages) - 1]) ? ($messages[count($messages) - 1]->messageId) : 0 }};
        let refreshChat;
        setRefreshInterval()
        scroll({{ count($messages) * 100 }} + 'px')
        $('#sendMessage').click(function () {
            event.preventDefault();
            clearInterval(refreshChat)
            let message = $('#message').val();
            $('#message').val('');
            setTimeout(() => {
                if(message) {
                    $.ajax({
                        url: '{{ route('sendMessage') }}',
                        method: 'post',
                        data: {
                            _token : $('meta[name="csrf-token"]').attr('content'),
                            chat: {{ $chat }},
                            message: message
                        },
                        success: function (data) {
                            refresh(data)
                            setRefreshInterval()
                        }
                    })
                }
            }, 500)
        })
        function setRefreshInterval() {
            refreshChat = setInterval(function () {
                $.ajax({
                    url: '{{ route('refreshChat') }}',
                    method: 'post',
                    data: {
                        _token : $('meta[name="csrf-token"]').attr('content'),
                        lastMessageId: lastMessageId,
                        userId: {{ $user->id }},
                        chat: {{ $chat }}
                    },
                    success: function (data) {
                        if(data)
                            refresh(data)
                    }
                })
            }, 1000)
        }
        function refresh(data) {
            $('.allMessage').append(data[0])
            $('#message').val('')
            scroll('150px')
            lastMessageId = data[1]
        }
        function scroll(scroll) {
            $('.allMessage').animate({scrollTop: '+=' + scroll}, 150)
        }
    </script>
@endsection
