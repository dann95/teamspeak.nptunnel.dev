@if($errors->any())
@foreach($errors->all() as $error)
    <div class="alert alert-danger"><b>Ooops!</b> {{ $error }}</div>
@endforeach
@endif