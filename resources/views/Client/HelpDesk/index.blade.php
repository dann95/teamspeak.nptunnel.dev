@extends('Client.Layout.default')
@section('title','Helpdesk')
@section('content')
    <div class="col-md-6 list-category text-primary">
        <a href="{{ route('account.help.create') }}" class="btn btn-primary pull-right">criar ticket</a><br>
        <h3 class="title">
            Meus tickets
            <a href="#" class="btn btn-xs btn-primary pull-right">{{ count($auth->user()->questions()->get()) }} tickets</a>
        </h3>

        <div class="list-group">
            @foreach($auth->user()->questions()->get() as $question)
            <a href="{{ route('account.help.show', ['id' => $question->id]) }}" class="list-group-item"><div class="truncate pull-left"><strong>{{ $question->created_at->diffForHumans() }}</strong> {{ $question->title }}</div><span class="badge">{{ count($question->answers()->get()) }} respostas</span></a>
            @endforeach
        </div>


    </div>
@endsection
