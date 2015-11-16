@inject('vocations','NpTS\Domain\Bot\Models\Vocation')
@foreach($vocations as $vocation)
    {{ $vocation->name }}
@endforeach