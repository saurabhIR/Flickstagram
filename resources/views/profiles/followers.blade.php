@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            <h3 class="mb-4">{{ $user->username }}'s Followers List</h3>
            <table class="table table-bordered table-striped ">
                <thead>
                <tr>
                    <th style="font-size: 22px">Username</th>
                </tr>
                </thead>
                <tbody>
                <!-- PHP loop to populate the table -->
                @foreach ($data as $follower)
                    <tr>
                        <td style="font-size: 20px"><img style="max-width: 25px;" class="rounded-circle" src="{{ $follower->profile->profileImage() }}"> {{ $follower->username }}</td>
                    </tr>
                @endforeach
                <!-- End of PHP loop -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
