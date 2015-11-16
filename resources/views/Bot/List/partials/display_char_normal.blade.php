@inject('vocations','NpTS\Domain\Bot\Models\Vocation')
@foreach($vocations->all() as $vocation)@foreach($chars->where('vocation_id',$vocation->id) as $char){!! $char->name !!}
@endforeach
@endforeach