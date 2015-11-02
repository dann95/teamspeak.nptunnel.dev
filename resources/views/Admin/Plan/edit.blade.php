@extends('Admin.Layout.default')
@section('title','Editar um plano')
@section('content')
    @if($plan)
        <div class="row mt">
            <div class="col-lg-6">
                <div class="form-panel">
                    <form class="form-horizontal style-form" method="POST" action="{{ route('plan.update' , ['id' => $plan->id]) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nome</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" value="{{ $plan->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Slots</label>
                            <div class="col-sm-10">
                                <input type="text" name="slots" class="form-control" value="{{ $plan->slots }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Preço</label>
                            <div class="col-sm-10">
                                <input type="text" name="price" class="form-control" value="{{ $plan->price }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                <select name="active" class="form-control">
                                    <option value="0"@if($plan->active == 0) selected @endif>Inativo</option>
                                    <option value="1"@if($plan->active == 1) selected @endif>Ativo</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9">

                            </div>
                            <div id="col-sm-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Atualizar plano</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- col-lg-12-->
        </div><!-- /row -->
    @else
        <h1>Plano inexistente!</h1>
    @endif
@endsection