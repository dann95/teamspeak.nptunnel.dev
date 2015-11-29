@extends('Client.Layout.default')
@section('title','Instalar o TsBOT')
@section('content')
    <div class="container">
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h2 class="form-login-heading">Siga os passos</h2>
                    <form class="form-horizontal style-form" method="POST" action="{{ route('account.virtual.bot.install' , ['id' => $id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <h2>Gere um Login Server Query conforme as imagens:</h2>
                                <img src="{{ url('img/tutorial/r2d2/1.png') }}">
                                <span class="help-block">Na parte superior do teamspeak vá em settings -> identities (ou pressione <b>CONTROL</b> + <b>i</b>.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <img src="{{ url('img/tutorial/r2d2/2.png') }}">
                                <span class="help-block">Na parte superior da nova janela aberta , clique em add.</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <img src="{{ url('img/tutorial/r2d2/3.png') }}">
                                <span class="help-block">Insira um nome para a identidade e um nickname, esses não são relevantes no comportamento do robô.</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <img src="{{ url('img/tutorial/r2d2/4.png') }}">
                                <span class="help-block">Na aba superior do TeamSpeak, vá em Connections e clique em Connect (ou pressione <b>CONTROL</b> + <b>s</b>) .</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <img src="{{ url('img/tutorial/r2d2/5.png') }}">
                                <span class="help-block">Insira o ip e a senha (caso haja) , e clique no botão no canto inferior "more"</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <img src="{{ url('img/tutorial/r2d2/6.png') }}">
                                <span class="help-block">Em Identity selecione a identidade que você criou recentemente.</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <img src="{{ url('img/tutorial/r2d2/7.png') }}"><br><br>
                                <img src="{{ url('img/tutorial/r2d2/8.png') }}"><br><br>
                                <img src="{{ url('img/tutorial/r2d2/9.png') }}">
                                <span class="help-block"><a target="_blank" href="{{ route('account.virtual.keys', ['id' => $id]) }}">Gere uma prilege key no painel e use ela.</a></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <img src="{{ url('img/tutorial/r2d2/10.png') }}">
                                <span class="help-block">No menu do teamspeak selecione tools e ServeQuery Login.</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <img src="{{ url('img/tutorial/r2d2/11.png') }}">
                                <span class="help-block">insira um nome para Login.</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <img src="{{ url('img/tutorial/r2d2/12.png') }}">
                                <span class="help-block">Você recebera um login e senha, guarde pois ira usar no próximo passo</span>
                            </div>
                        </div>

                        <h2 class="form-login-heading">Com os dados em mãos, preencha:</h2>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nome do Robô</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                <span class="help-block">Nome que ficara visivel para todos no teamspeak.</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Login</label>
                            <div class="col-sm-10">
                                <input type="text" name="login" class="form-control" value="{{ old('login') }}">
                                <span class="help-block">Login gerado nos passos acima.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="text" name="password" class="form-control" value="{{ old('password') }}">
                                <span class="help-block">Password gerado nos passos acima.</span>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-sm-9">

                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-check"></i> Instalar o robô r2d2</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- col-lg-12-->
        </div><!-- /row -->
    </div>
@endsection