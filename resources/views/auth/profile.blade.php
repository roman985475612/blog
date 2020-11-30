@extends('layout')

@section('title')
    Profile
    @parent
@endsection

@section('content')
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="leave-comment mr0">
                    <h3 class="text-uppercase">My profile</h3>
                    <br>
                    <img src="{{ Auth::user()->getAvatar(256) }}" alt="" class="profile-image">
                    <form class="form-horizontal contact-form" 
                          role="form" 
                          method="post" 
                          action="{{ route('profile.update') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" 
                                       class="form-control" 
                                       id="name" 
                                       name="name"
                                       placeholder="Name" 
                                       value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" 
                                       class="form-control" 
                                       id="email" 
                                       name="email"
                                       placeholder="Email" 
                                       value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="password" 
                                       class="form-control" 
                                       id="password" 
                                       name="password"
                                       placeholder="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="file" 
                                       class="form-control" 
                                       id="image" 
                                       name="avatar">	
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn send-btn">Update</button>

                    </form>
                </div><!--end leave comment-->
            </div>
            @include('pages._sidebar')
        </div>
    </div>
</div>

@parent
@endsection