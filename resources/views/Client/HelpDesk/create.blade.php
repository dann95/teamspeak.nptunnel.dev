@inject('categories','NpTS\Domain\HelpDesk\Models\QuestionCategory')
@extends('Client.Layout.default')
@section('title','Fazer um ticket de suporte')
@section('content')
    <div class="container">
    <form method="POST" action="{{ route('account.help.store') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <select name="category_id" class="form-control">
                @foreach($categories->all() as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input class="form-control" name="title" placeholder="Titulo">
        </div>
        <div class="form-group">
            <textarea name="body" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">responder</button>
    </form>
    </div>
@endsection