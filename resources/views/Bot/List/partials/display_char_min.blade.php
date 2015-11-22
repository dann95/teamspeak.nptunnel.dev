@inject('vocations','NpTS\Domain\Bot\Models\Vocation')
@foreach($vocations->all() as $vocation)@foreach($chars->where('vocation_id',$vocation->id) as $char)({{ $vocation->short_name }}) {{ $char->lvl }} [url={!! $char->url !!}]{!! $char->name !!}[/url] [{{ $char->changesLvl }}] {{ date("[H:i]",time()-$char->online_since->timestamp) }}
@endforeach
@if(count($chars->where('vocation_id',$vocation->id)))

@endif
@endforeach