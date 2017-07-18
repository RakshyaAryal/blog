<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(5);
        return view('home.index',compact('posts'));
    }

    public function singlePost($id)
    {
        $post = Post::findOrFail($id);
        return view('home.single-post', compact('post'));
    }
    public function search(Request $request)
    {
        $posts = $request->get('title');
        $posts = Post::where('title', 'LIKE', '%'.$posts.'%')->paginate(5);
        return view('home.index', compact('posts'));

    }

    public function categoryWiseView($category, $id)
    {
        $posts = Category::find($id)->posts()->paginate(5);

        //dd($posts);
        return view('home.index', compact('posts'));
    }

    public function searchByArchive($year, $month)
    {
        $date_start = Carbon::create($year, $month, 01, 0,0,0);
        $date_end = $date_start->copy()->addMonth()->subSecond(1);

        $posts = Post::where('created_at', '>=', $date_start)
            ->where('created_at', '<=', $date_end)
            ->paginate(5);

        return view('home.index', compact('posts'));

    }

}
