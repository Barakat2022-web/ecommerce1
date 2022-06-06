@extends('layouts.login')
@section('title','صفحة الدخول')
@section('content')
 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

      <div id="login-page">
        <div class="container">
          <form class="form-login" action="{{route('admin.login')}}" method="POST">
            @csrf
            <h2 class="form-login-heading">{{__('messages.sign in admin')}}</h2>
            @include('admin.includes.alerts.errors')
            @include('admin.includes.alerts.success')
            <div class="login-wrap">
              <input type="text" class="form-control" placeholder="{{__('messages.Email')}}" name="email" value="{{old('email')}}" autofocus>
              @error('email')
              <span>{{$message}}</span>
              @enderror
              <br>
              <input type="password" class="form-control" name="password" value="{{old('password')}}" placeholder="{{__('messages.Password')}}">
              @error('password')
              <span>{{$message}}</span>
              @enderror
              <label class="checkbox">
                <input type="checkbox" name="remember_me" value="remember-me"> {{__('messages.Remember me')}}
                <span class="pull-right">
                <a data-toggle="modal" href="login.html#myModal"> {{__('messages.Forgot Password?')}}</a>
                </span>
                </label>
              <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i>{{__('messages.SIGN IN')}}</button>
            </form>


            </div>
            <!-- Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Forgot Password ?</h4>
                  </div>
                  <div class="modal-body">
                    <p>Enter your e-mail address below to reset your password.</p>
                    <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                  </div>
                  <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                    <button class="btn btn-theme" type="button">Submit</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- modal -->

        </div>
      </div>
@endsection
