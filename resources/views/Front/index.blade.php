@extends('Client.Layout.default')
@section('title','Comprar um Servidor')
@section('content')
    <!-- INLINE FORM ELELEMNTS -->
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> Selecione seu servidor</h4>
                <form class="form-inline" role="form" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <select class="form-control">
                            @foreach($planos as $plano)
                            <option value="{{ $plano->id }}">{{ $plano->slots }} slots ({{ $plano->name }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nome do Server">
                    </div>
                    <button type="submit" class="btn btn-success">comprar</button>
                </form>
            </div><!-- /form-panel -->
        </div><!-- /col-lg-12 -->
    </div><!-- /row -->
@endsection