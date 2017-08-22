@extends("layouts.app")

@section("content")

<div class="container">
<div class="row">
<div class="col-md-10 col-md-offset-1">
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Notifications</h3>
  </div>
  <div class="panel-body">
    <ul class="list-group">
    @if(count($nots))
    @foreach($nots as $not)
    <li class="list-group-item">{!!$not->data['message']!!}</li>
  @endforeach
  @else
  Not found any notifications
  @endif
  </ul>
  </div>
</div>
</div>
</div>
</div>

@stop