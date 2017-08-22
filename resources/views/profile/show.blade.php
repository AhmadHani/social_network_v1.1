@extends("layouts.app")

@section("content")

<div class="container" style="overflow:auto">
<div class="row">
    <div class="col-lg-9">
        <div class="panel panel-default">
        <div class="panel-heading">
        {{$user->name}} Profile
        </div>
        <div class="panel-body">
        @if(Auth::check() && Auth::user()->username == $user->username)
            <a href="{{route('profile.edit',['username'=>Auth::user()->username])}}"  class="btn btn-primary pull-right">Edit Your Profile</a>
            @else
            <friend :profile_user_id="{{$user->id}}"></friend>
@endif
        <div style="    float: left"><img src="{{$user->avatar}}" width="128" height="126" style="display:block" alt="{{$user->name}} Avatar">
                </div>
                @if($user->profile->location == null)
                    <span class="label label-primary" style="margin-left:10px">Location</span> Empty
                    @else
        <span class="label label-primary" style="margin-left:10px">Location</span> {{$user->profile->location}}

                @endif
       <br />
       
       @if($user->profile->about == null)
                    <span class="label label-success" style="margin-left: 10px;">About</span> Empty
                   <br>
                    @else
               <span class="label label-success" style="margin-left: 10px;">About</span> <br /><p style=" margin-left: 140px; word-wrap: break-word;
">{{$user->profile->about}}</p>

@endif
@if($user->profile->date_birth == null)
                   <span class="label label-info" style="margin-left:10px;">Date of birth</span> Empty
                   
                    @else
    <span class="label label-info" style="margin-left:10px">Date of birth</span> {{$user->profile->date_birth}}
        @endif
        </div>

        </div>
    </div>
    


    <post class="col-lg-9"></post>
    <br />
    <feed :giveprofile="true" class="col-lg-9"></feed>
</div>


</div>
@endsection
