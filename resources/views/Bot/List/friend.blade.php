[img]http://i.imgur.com/o07OdqI.png[/img]
@if(count($chars) > 48)
    @include('Bot.List.partials.display_char_min')
@else
    @include('Bot.List.partials.display_char_normal')
@endif
atualizado {{ (new \DateTime())->format('d/m/Y H:i:s') }}
[url=http://www.nptunnel.com/r2d2]Friend list gerada por r2d2[/url]