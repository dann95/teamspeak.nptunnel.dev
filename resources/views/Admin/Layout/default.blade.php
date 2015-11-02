@extends('partials.base_layout')
@section('menu')
    <li class="sub-menu">
        <a href="{{ route('admin.index') }}" >
            <i class="fa fa-desktop"></i>
            <span>Início</span>
        </a>
    </li>

    <li class="sub-menu">
        <a href="javascript:;" >
            <i class="fa fa-cubes"></i>
            <span>Planos</span>
        </a>
        <ul class="sub">
            <li><a  href="{{ route('plan.index') }}">Listar</a></li>
            <li><a  href="{{ route('plan.create') }}">Inserir</a></li>
        </ul>
    </li>

    <li class="sub-menu">
        <a href="javascript:;" >
            <i class="fa fa-server"></i>
            <span>Servers</span>
        </a>
        <ul class="sub">
            <li><a  href="{{ route('server.index') }}">Listar</a></li>
            <li><a  href="{{ route('server.create') }}">Inserir</a></li>
        </ul>
    </li>

    <li class="sub-menu">
        <a href="javascript:;" >
            <i class="fa fa-male"></i>
            <span>Clientes</span>
        </a>
        <ul class="sub">
            <li><a  href="{{ route('client.index') }}">Listar</a></li>
        </ul>
    </li>

    <li class="sub-menu">
        <a href="javascript:;" >
            <i class="fa fa-sitemap"></i>
            <span>Virtual Servers</span>
        </a>
        <ul class="sub">
            <li><a  href="{{ route('virtual.index') }}">Listar</a></li>
        </ul>
    </li>
    <li class="sub-menu">
        <a href="javascript:;" >
            <i class="fa fa-life-saver"></i>
            <span>Helpdesk</span>
        </a>
        <ul class="sub">
            <li><a  href="#">Não Visualizados</a></li>
            <li><a  href="#">Em Aberto</a></li>
            <li><a  href="#">Financeiro</a></li>
            <li><a  href="#">Suporte</a></li>
        </ul>
    </li>



@endsection
