@extends("layouts.app")

@section("content")

    <div class="container">
    <div class="row">
                    <form action="{{route('profile.store')}}" method="post" enctype="multipart/form-data">
{{csrf_field()}}

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                Change your public information
                </div>

                <div class="panel-body">
                <div class="form-group">    
                <label for="name">Name</label>
                
                <input type="text" name="name" value="{{$user->name}}" class="form-control">
                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group">    
                <label for="username">Username</label>
                
                <input type="text" name="username" value="{{$user->username}}" class="form-control">
                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                </div>
                
                <div class="form-group">    
                <label for="gender">Gender</label>
                    <select class="form-control" name="gender" id="">
                            <option value="0">Male</option>
                            <option value="1">Female</option>
                            @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                    </select>
                </div>
                <div class="form-group">    
                <label for="avatar">Avatar</label>
                   <input type="file" name="avatar" class="form-control" accept="/image">
                </div>
                
                 <div class="form-group">    
                <label for="about">About</label>
                    <textarea name="about" name="about" class="form-control"  rows="5">{{$user->profile->about}}</textarea>
               @if ($errors->has('about'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('about') }}</strong>
                                    </span>
                                @endif
                </div>
                
                
                 <div class="form-group">    
                <label for="location">Location</label>
                    <input type="text" class="form-control" name="location" value="{{$user->profile->location}}">
                </div>
                <div class="form-group">    
                <label for="location">Date of birth</label>
                    <input type="date" class="form-control" name="date_birth" value="{{$user->profile->date_birth}}">
                </div>
                
            
                </div>
            </div>
        </div>



        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                Change your private information
                </div>
                <div class="panel-body">
                
                <div class="form-group">    
                <label for='email'>Email</label>
                
                <input type="email" name="email" value="{{$user->email}}" class="form-control">
                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group">    
                <label for="password">Password *</label>
                
                <input type="password" name="password" class="form-control" required>
@if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group">
                            <label for="password-confirm">Confirm Password * </label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                        </div>
                 
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-default">
        <div class="panel-body">
           <div class="form-group">
                                <div class="text-center">
               
                                <input type="submit" value="Save Your Information" class="btn btn-primary">
                              </form>
                                </div>
                            </div>

        </div>
        </div>
        </div>
            </div>
    </div>

@endsection