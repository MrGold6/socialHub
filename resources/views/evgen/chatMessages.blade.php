@if(isset($messages) && count($messages) > 0)
    @foreach($messages as $message)
        @include('evgen.message', ['message' => $message])
    @endforeach
@endif
