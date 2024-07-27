<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $news = News::all();
        return view('news.index', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }
public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'content' => 'nullable', // Make content nullable or set a default value
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $input = $request->all();

    // If 'content' is not provided in the form, you can set a default value or make it nullable
    $input['content'] = $request->input('content', ''); // default value is an empty string

    if ($image = $request->file('image')) {
        $destinationPath = 'images/news/';
        $newsImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $newsImage);
        $input['image'] = "$newsImage";
    }

    News::create($input);

    return redirect()->route('news.index')->with('success', 'News created successfully.');
}


    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/news/';
            $newsImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $newsImage);
            $input['image'] = "$newsImage";
        } else {
            unset($input['image']);
        }

        $news->update($input);

        return redirect()->route('news.index')->with('success', 'News updated successfully.');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index')->with('success', 'News deleted successfully.');
    }
}
