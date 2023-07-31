<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Symfony\Contracts\Service\Attribute\Required;

class PostsController extends Controller
{   
    /**
     * middleware auth will require authorisation to access posts controller
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        # code for fetching all user's posts using relationship in User model
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = post::whereIn('user_id' , $users)->with('user')->latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts/create');
    }

    public function store()
    {
        // save the post to database...
        // dd(request()->all());

        //validating the data came from posts
        $data = request()->validate([
            // 'another' => '',
            'caption' => 'Required',
            'image' => ['Required' , 'image'],
        ]);

        //store take two parameter first is directory and second is driver: s3/public
        $imagePath = (request('image')->store('uploads' , 'public'));

        //cropped image with the help of intervention image facades and saved it.
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);
        
        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Models\post $id)
    {
        /* return view('posts.show', [
            'id' => $id,
        ]); */
        $follows = (auth()->user()) ? auth()->user()->following->contains($id->user->id) : false;

        return view('posts.show', compact('id','follows'));
    }

    public function destroy(post $id)
    {   
        // Authorizing post before deleting with PostPolicy
        $this->authorize('delete',$id);
        // dd($id);
        $id->delete();
        return redirect("/profile/$id->user_id");
    }
}
