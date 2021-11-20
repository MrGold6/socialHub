<div>
    <div id="createdComment">
    </div>
    @foreach($Comments as $comment)
        <div id="{{ $comment->id }}" class="mt-1 mb-4 comment" idMainComment="{{ $comment->id }}">
            <div class="row">
                <div class="col-md-1">
                    <div style="height: 52px; width: 52px;" class="mt-2">
                        <img style="width: 52px; border-radius: 100px;" src="data:image/jpeg;base64,{{ base64_encode($comment->image) }}"/>
                    </div>
                    <p class="ml-1 mt-1">
                        {{ $comment->firstName }}
                    </p>
                </div>
                <div class="col-md-11">
                    <p>
                        {{ $comment->comment }}
                    </p>
                    <div class="row">
                        @if($comment->idUser == \Illuminate\Support\Facades\Auth::id())
                            <div class="col-md-2">
                                <button id="deleteComment" idMainComment="{{ $comment->id }}" style="background-color: transparent; border-color: transparent">
                                    <p style="margin-top: -1%;">
                                        Видалити
                                    </p>
                                </button>
                            </div>
                        @endif
                        <div class="col-md-2">
                            <button id="createAnswer" idMainComment='{{ $comment->id }}' idPost="{{ $postId }}" style="background-color: transparent; border-color: transparent">
                                <p style="margin-top: -1%;">
                                    Відповісти {{-- idMainComment = id / idAnswerComment = 0 якщо це комент до посту, а не до коменту --}}
                                </p>
                            </button>
                        </div>
                    </div>
                    @if($comment->countAnswer > 0)
                        <div class="mainComment-{{ $comment->id }}">
                            <button style="background-color: transparent; border-color: transparent">
                                <p id="checkAnswer" idMainComment='{{ $comment->id }}'>
                                    Переглянути відповіді ({{ $comment->countAnswer }})
                                </p>
                            </button>
                        </div>
                    @endif
                </div>
                </div>
            </div>
    @endforeach
</div>
