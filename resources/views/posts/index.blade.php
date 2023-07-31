@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($posts as $id)

        <div class="row">
            <div class="col-6 offset-3">
                <a href="/profile/{{ $id->user->id }}">
                    <img src="/storage/{{ $id->image }}" class="w-100">   
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-6 offset-3">
                <div class="pt-2 pb-4">
                    <h5>
                        <span class="fw-bold ">
                            <a class="text-decoration-none" href="/profile/{{ $id->user->id}}">
                                <span class="text-dark">{{ $id->user->username }}</span>
                            </a>
                        </span> 
                        {{ $id->caption }}
                    </h5>
                </div>
            </div>
        </div>

    @endforeach

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
