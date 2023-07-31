@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-3 p-5"> 
        <img class="w-100 rounded-circle" src="{{ $user->profile->profileImage() }}" alt="">
    </div>
    <div class="col-9 pt-5">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-4 pb-3">
                <h1>{{$user->username}}</h1>

                <follow-button user-id="{{$user->id}}" follows="{{ $follows }}"></follow-button>
            </div>


            @can('update',$user->profile)
                <a href="/posts/create">Add New Post</a>
            @endcan

        </div>
        @can('update',$user->profile)
            <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
        @endcan
        <div class="d-flex">
            <div class="pe-5"><strong>{{ $postCount }}</strong> posts</div>
            <div class="pe-5"><a href="/followers/{{ $user->id }}" class="text-dark"><strong>{{ $followersCount }}</strong> followers</a></div>
            <div class="pe-5"><a href="/following/{{ $user->id }}" class="text-dark"><strong>{{ $followingCount }}</strong> following</a></div>
        </div>
        <div class="pt-4 fw-bold">{{$user->profile->title}}</div>
        <div>{{$user->profile->description}}</div>
        <div><a href="{{$user->profile->url}}">{{$user->profile->url}}</a></div>
    </div>
</div>
<div class="row pt-4">
    @foreach($user->posts as $post)
        <div class="col-4">
            <a href="/posts/{{ $post->id }}">
               <img src="/storage/{{ $post->image }}" class="w-100 h-75">        
            </a>
        </div>
    @endforeach
</div>
</div>
@endsection
