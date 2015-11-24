<div class="row mt">
    <div class="col-md-12">
        <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Vocação</th>
                    <th>Level</th>
                    <th>Server</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($chars as $char)
                    <tr>
                        <td>{{ $char->id }}</td>
                        <td>{{ $char->name }} @if($char->wasDeleted)<span class="badge bg-important">deletado</span>@endif</td>
                        <td>{{ $char->vocation->name }}</td>
                        <td>{{ $char->lvl }}</td>
                        <td>{{ $char->world->name }}</td>
                        <td>
                            <div class="pull-right">
                            <a href="{{ route("account.virtual.bot.char.edit" , ['id' => $vserver_id , 'char_id' => $char->id]) }}"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                            <a href="{{ route("account.virtual.bot.{$position}.del" , ['id' => $vserver_id , 'char_id' => $char->id]) }}"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- /content-panel -->
    </div><!-- /col-md-12 -->
</div><!-- /row -->