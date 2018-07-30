@extends('layouts.master')
@section('content')
@section('breadcrumbs', Breadcrumbs::render('profile', $user))
<section class="container main-content">
    <div class="row">
        <div class="col-md-9">
            <div class="page-content">
                <div class="boxedtitle page-title"><h2>Edit Profile</h2></div>

                <div class="form-style form-style-4">
                    <form action="{{ route('profile.update', $user->name) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-inputs clearfix">
                            <p>
                                <label>First Name</label>
                                <input type="text" name="firstname" value="{{ $user->profile->firstname }}">
                            </p>
                            <p>
                                <label>Last Name</label>
                                <input type="text" name="lastname" value="{{ $user->profile->lastname }}">
                            </p>
                            <p>
                                <label>Website</label>
                                <input type="text" name="website" value="{{ $user->profile->website }}">
                            </p>
                            <p>
                                <label>Country</label>
                                <input type="text" name="country" value="{{ $user->profile->country }}">
                            </p>
                        </div>
                        <div class="form-style form-style-2">
                            <div class="user-profile-img"><img src="{{ asset($user->avatar) }}" alt="admin"></div>
                            <p class="user-profile-p">
                                <label>Profile Picture</label>
                                <div class="fileinputs">
                                    <input type="file" class="file" name="avatar">
                                    <div class="fakefile">
                                        <button type="button" class="button small margin_0">Select file</button>
                                        <span><i class="icon-arrow-up"></i>Browse</span>
                                    </div>
                                </div>
                            <p></p>
                            <div class="clearfix"></div>
                            <p>
                                <label>About Yourself</label>
                                <textarea name="about" cols="58" rows="8" >{{ $user->profile->about }}</textarea>
                            </p>
                        </div>
                        <div class="form-inputs clearfix">
                            <p>
                                <label>Facebook</label>
                                <input type="text" name="facebook" value="{{ $user->profile->facebook }}">
                            </p>
                            <p>
                                <label>Twitter</label>
                                <input type="text" name="twitter" value="{{ $user->profile->twitter }}">
                            </p>
                            <p>
                                <label>Linkedin</label>
                                <input type="email" name="linkedin" value="{{ $user->profile->linkedin }}">
                            </p>
                            <p>
                                <label>Google plus</label>
                                <input type="text" name="google" value="{{ $user->profile->google }}">
                            </p>
                        </div>
                        <p class="form-submit">
                            <input type="submit" value="Update" class="button color small login-submit submit">
                        </p>
                    </form>
                </div>
            </div><!-- End page-content -->
        </div><!-- End main -->
        @include('partials.sidebar')
    </div><!-- End row -->
</section><!-- End container -->

@stop
