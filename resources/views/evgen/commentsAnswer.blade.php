<div class="ml-5">
    @foreach($Comments as $comment)
        <div id="{{ $comment->id }}" answerComment="{{ $comment->id }}" class="vl">
            <div class="row">
                <div class="col-md-1">
                    <div style="height: 50px; width: 50px; border-radius: 50px;" class="mt-2">
                        <img style="width: 50px; border-radius: 100px;" src="data:image/jpeg;base64,{{ base64_encode($comment->image) }}"/>
                    </div>
                </div>
                <div class="col-md-11">
                    <div class="ml-2">
                        <p>
                            {{ $comment->firstName }} - {{ $comment->comment }}
                        </p>
                        <div class="row">
                            @if($comment->idUser == \Illuminate\Support\Facades\Auth::id())
                                <div class="col-md-2">
                                    <button id="deleteAnswer" idAnswerComment="{{ $comment->id }}" idMainComment="{{ $comment->id }}" style="background-color: transparent; border-color: transparent">
                                        <p style="margin-top: -1%;">
                                            Видалити
                                        </p>
                                    </button>
                                </div>
                            @endif
                            <div class="col-md-2">
                                <button id="createAnswerToAnswer" idMainComment="{{ $comment->idMainComment }}" idAnswerComment="{{ $comment->id }}" style="background-color: transparent; border-color: transparent">
                                    <p>
                                        Відповісти
                                    </p>
                                </button>
                            </div>
                        </div>
                        @if($comment->countAnswer > 0)
                            <div class="answerComment-{{ $comment->id }}">
                                <button style="background-color: transparent; border-color: transparent">
                                    <p id="checkAnswer" idAnswerComment='{{ $comment->id }}' idMainComment='{{ $comment->idMainComment }}'>
                                        Переглянути відповіді ({{ $comment->countAnswer }})
                                    </p>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
