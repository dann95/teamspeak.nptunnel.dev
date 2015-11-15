[b][size=16]Enemy List[/size][/b]
@foreach($chars as $char)
    @include('Bot.List.partials.display_char_normal')
@endforeach