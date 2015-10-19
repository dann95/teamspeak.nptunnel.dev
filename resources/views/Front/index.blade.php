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
                            <option value="10">10 slots</option>
                            <option value="15">15 slots</option>
                            <option value="25">25 slots</option>
                            <option value="50">50 slots</option>
                            <option value="100">100 slots</option>
                            <option value="150">150 slots</option>
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