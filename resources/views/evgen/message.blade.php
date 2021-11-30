<div class="message">
    @if(\Illuminate\Support\Facades\Auth::id() == $message->ownerMessage)
        <div {{-- Вирівняти по правому краю --}}>
            <div class="row">
                <div class="col-1">

                </div>
                <div class="col-9">
                    <div class="alert alert-info">
                        {{ $message->message }}
                    </div>
                </div>
                <div class="col-1">
                    <a href="{{ route('user', [$message->ownerMessage]) }}" style="text-decoration: none;">
                        @if(!empty($message->ownerImage))
                        <img style="width: 50px; border-radius: 50%;" src="data:image/jpeg;base64,{{ base64_encode($message->ownerImage) }}"/>
                        @else
                        <img style="width: 50px; border-radius: 50%;" src="{{ URL::to('./img/camera.png') }}">
                        @endif
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-1">
                <a href="{{ route('user', [$message->ownerMessage]) }}" style="text-decoration: none;">
{{--                    <img style="width: 52px; border-radius: 100px;" src="data:image/jpeg;base64,{{ base64_encode($user->image) }}"/>--}}
                    @if(!empty($user->image))
                        <img style="width: 50px; border-radius: 50%;" src="data:image/jpeg;base64,{{ base64_encode($user->image) }}"/>
                    @else
                        <img style="width: 50px; border-radius: 50%;" src="{{ URL::to('./img/camera.png') }}">
                    @endif
                </a>
            </div>
            <div class="col-9">
                <div class="alert alert-secondary">
                    {{ $message->message }}
                </div>
            </div>
        </div>
    @endif
</div>
