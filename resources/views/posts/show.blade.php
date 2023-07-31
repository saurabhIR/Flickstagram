@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $id->image }}" class="w-100">   
        </div>
        <div class="col-4">
            <div>
                <div class="d-flex align-items-center gap-3 ">
                    <div style="max-width: 50px">
                        <img src="{{ $id->user->profile->profileImage() }}" class="rounded-circle w-100">
                    </div>
                    <div>
                        <div class="d-flex gap-2 align-items-center">
                            <a class="text-decoration-none fw-bold " href="/profile/{{ $id->user->id}}">
                                <span class="text-dark">{{ $id->user->username }}</span>
                            </a>

                            <follow-button user-id="{{$id->user->id}}" follows="{{ $follows }}"></follow-button>
                        </div>
                    </div>
                </div>

                <hr>

                <p>
                    <span class="fw-bold ">
                        <a class="text-decoration-none" href="/profile/{{ $id->user->id}}">
                            <span class="text-dark">{{ $id->user->username }}</span>
                        </a>
                    </span> 
                    {{ $id->caption }}
                </p>
            </div>
        </div>
    </div>
    
    @can('delete', $id)

    <div class="row">
        <div class="col-12 d-flex justify-content-center mt-5">
            <form action="{{ route('post.destroy', $id->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit">Delete Post</button>
            </form>
        </div>
    </div> 

    @endcan
</div>
@endsection
