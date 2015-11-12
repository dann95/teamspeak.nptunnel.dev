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
                        <td>{{ $char->name }}</td>
                        <td>{{ $char->vocation->name }}</td>
                        <td>{{ $char->lvl }}</td>
                        <td>{{ $char->world->name }}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- /content-panel -->
    </div><!-- /col-md-12 -->
</div><!-- /row -->