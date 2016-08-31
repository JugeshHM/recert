@extends('layouts/default')

@section('title', 'Login')

@section('content')
<div class="col-sm-4 col-sm-offset-4 col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Login</h3>
    </div>
    <div class="panel-body">
      <div class="col-sm-12">
        <form class="form-horizontal" method="POST" action="/auth/login">
          {!! csrf_field() !!}
          <div class="form-group">
            <label>Email <span class="text-danger">*</span></label>
            <input class="form-control" type="email" name="email">
          </div>
          <div class="form-group">
            <label>Password <span class="text-danger">*</span></label>
            <input class="form-control" type="password" name="password" id="password">
          </div>
          <div class="form-group">
            <input type="checkbox" name="remember"> Remember Me
          </div>
          <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
