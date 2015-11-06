@extends('Client.Layout.default')
@section('title','Ticket # 1')
@section('content')
    <div class="container">
        <a href="{{ route('account.help.index') }}" class="btn btn-primary pull-right">Voltar</a><br><br>
        <div class="post-comments">



            <div class="row">
                <!-- comment -->
                <div class="media">
                    <!-- first comment -->

                    <div class="media-heading">
                        <span class="label label-info">{{ $question->id }}</span> {{ $question->user->name }} {{ $question->created_at->diffForHumans() }}
                    </div>

                    <div class="panel-collapse collapse in" id="collapseOne">

                        <div class="media-left">

                        </div>
                        <!-- media-left -->


                        <div class="media-body">
                            <p>
                                 {!! BBCode::parse($question->body) !!}
                            </p>
                            <div class="comment-meta">

                            </div>
                            <!-- comment-meta -->
                        </div>
                    </div>
                    <!-- comments -->

                </div>
                <!-- /comment -->
            </div>

            @foreach($question->answers()->get() as $answer)
                <div class="row">
                    <!-- comment -->
                    <div class="media">
                        <!-- first comment -->

                        <div class="media-heading">
                            <span class="label label-info">{{ $answer->id }}</span> {{ $answer->user->name }} {{ $answer->created_at->diffForHumans() }}
                        </div>

                        <div class="panel-collapse collapse in" id="collapseOne">

                            <div class="media-left">

                            </div>
                            <!-- media-left -->


                            <div class="media-body">
                                <p>
                                    {!! BBCode::parse($answer->body) !!}
                                </p>
                                <div class="comment-meta">
                                    @if($answer->user->is_admin)
                                    <hr>
                                    {!! $answer->user->signature !!}
                                    @endif
                                </div>
                                <!-- comment-meta -->
                            </div>
                        </div>
                        <!-- comments -->

                    </div>
                    <!-- /comment -->
                </div>
                <br>
            @endforeach

        </div>
        <!-- post-comments -->

        <hr>
        <form method="POST" action="{{ route('account.help.answer' , ['id' => $question->id]) }}">
            {{ csrf_field() }}
            <div class="form-group">
                <textarea name="comment" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">responder</button>
        </form>


    </div>
@endsection