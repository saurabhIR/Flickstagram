<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Policies\ProfilePolicy;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {
        //$user = User::findOrFail($user);
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(10),
            function () use ($user) {
                return $user->posts->count();
            });

        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(10),
            function () use ($user) {
                return $user->profile->followers->count();
            });

        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(10),
            function () use ($user) {
                return $user->following->count();
            });

        return view('profiles/index',compact('user' , 'follows' ,'postCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        //authorizing actions with model policy
        //protect from unauthorized update
        $this->authorize('update', $user->profile);

        return view('profiles.edit',compact('user'));
    }

    public function update(User $user)
    {   
        //protect from unauthorized update
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description'=>'required',
            'url'=>'url',
            'image'=>'image',
        ]);

        if (request('image')) {
            //store take two parameter first is directory and second is driver: s3/public
            $imagePath = request('image')->store('profile', 'public');

            //cropped image with the help of intervention image facades and saved it.
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        //mering the data array with the image path
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }

}
