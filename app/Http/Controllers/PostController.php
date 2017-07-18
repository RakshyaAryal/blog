<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryPost;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $loginUser = Auth::user();
        if ($loginUser->user_type == 1) {
            $post = Post::paginate(6);
        } else {
            $post = Post::where('author_id', $loginUser->id)->paginate(6);
        }

        return view('post.index', compact('post', 'categories', 'selectedCategory'));
    }

    public function create()
    {
        $categories = Category::all();

        $post = new Post;
        $selectedCategory = [];

        return view('post.create', compact('post', 'categories', 'selectedCategory'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',

        ]);

        $file = $request->file('thumbnail');
        $input = $request->all();
        $input['author_id'] = Auth::user()->id;
        $post = Post::create($input);

        if ($file != null) {

            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            if ($this->validateImage($extension)) {
                $randomNumber = rand(100000, 9999999);

                $newFileName = $randomNumber.'_'.$fileName;

                $post['thumbnail'] = $newFileName;
                $destinationPath = 'uploads';
                $file->move($destinationPath, $newFileName);

            } else {

                $request->session()->flash('flash_message', 'extension: .'.$extension.' is invalid file type');
                return redirect('post/index');
            }
        }

        $post->fill($input)->save();

        $categoryPost = CategoryPost::where('post_id', $post->id)->get();

        foreach ($categoryPost as $item) {
            $pc = CategoryPost::findOrFail($item->id);
            $pc->delete();
        }


        if (array_key_exists('category_id', $input) &&
            is_array($input['category_id'])
        ) {

            foreach ($input['category_id'] as $category_id) {
                $categoryPostData = [
                    'category_id' => $category_id,
                    'post_id' => $post->id,

                ];

                CategoryPost::create($categoryPostData);
            }
        }


        $request->session()->flash('flash_message', 'Post is successfully added!');
        return redirect('post/index');
    }

    public function delete($id, Request $request)
    {
        // deletes the data from category_post table
        CategoryPost::where('post_id', $id)->delete();

        $post = Post::findOrfail($id);
        $post->delete();
        $request->session()->flash('flash_message', 'Post is successfully deleted!');
        return redirect('post/index');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::findOrfail($id);
        $postCategory = CategoryPost::where('post_id', $id)->get();

        $selectedCategory = [];
        foreach ($postCategory as $item) {
            $selectedCategory[] = $item->category_id;

        }

        return view('post.create', compact('post', 'categories', 'selectedCategory'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',

        ]);

        $file = $request->file('thumbnail');

        $input = $request->all();

        $post = Post::findorfail($id);

        //TODO fix on update


        if ($file != null) {

            $post['thumbnail'] = $file->getClientOriginalName();
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file->getClientOriginalName());
        }

        $post->fill($input)->save();

        $categoryPost = CategoryPost::where('post_id', $post->id)->get();

        foreach ($categoryPost as $item) {
            $pc = CategoryPost::findOrFail($item->id);
            $pc->delete();
        }

        if (array_key_exists('category_id', $input) &&
            is_array($input['category_id'])
        ) {
            //TODO fix when catgory not seelected
            foreach ($request->get('category_id') as $category_id) {
                $categoryPostData = [
                    'category_id' => $category_id,
                    'post_id' => $post->id,

                ];

                CategoryPost::create($categoryPostData);
            }
        }

        $request->session()->flash('flash_message', 'Post is successfully updated!');
        return redirect('post/index');
    }

    public function view($id)
    {
        $post = Post::findorfail($id);
        return view('post.single-view', compact('post'));
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        $post = $request->get('body');
        $post = Post::where('title', 'LIKE', '%' . $post . '%')->paginate(6);
        return view('post.index', compact('post', 'categories'));
    }


    public function archive()
    {


    }

    public function getdetails()
    {
        $randomNumber = rand(0, 1000);
        echo "Random Number: " . $randomNumber;
    }

    public function searchForm()
    {
        return view('post.search-form');

    }

    public function ajaxSearch(Request $request)
    {
        $post = $request->get('ptitle');
        $post = Post::where('title', 'LIKE', '%' . $post . '%')->get();
        return view('post.search-result', compact('post'));


    }

    public function validateImage($extension)
    {
        if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif') {
            return true;
        }

        return false;
    }
}
