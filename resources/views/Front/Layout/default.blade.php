@extends('partials.base_layout')
@section('menu')
    <li class="sub-menu">
        <a href="{{ route('index') }}" >
            <i class="fa fa-desktop"></i>
            <span>Início</span>
        </a>
    </li>

    <li class="sub-menu">
        <a href="{{ route('planos') }}" >
            <i class="fa fa-cubes"></i>
            <span>Planos</span>
        </a>
    </li>
    <li class="sub-menu">
        <a href="{{ route('porque') }}" >
            <i class="fa fa-question-circle"></i>
            <span>Por que nos escolher?</span>
        </a>
    </li>

    <li class="sub-menu">
        <a href="javascript:;">
            <i class="fa fa-comments-o"></i>
            <span>Atendimento Online</span>
        </a>
    </li>
@endsection
