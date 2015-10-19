@extends('Admin.Layout.default')
@section('title','Inserir um plano')
@section('content')
    <!-- INLINE FORM ELELEMNTS -->
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> Preencha o formulario</h4>
                <form class="form-inline" role="form" method="POST" action="{{ route('plan.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Nome do plano" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="slots" placeholder="Número de slots" value="{{ old('slots') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="price" placeholder="Preço" value="{{ old('price') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Criar</button>
                </form>
            </div><!-- /form-panel -->
        </div><!-- /col-lg-12 -->
    </div><!-- /row -->
@endsection