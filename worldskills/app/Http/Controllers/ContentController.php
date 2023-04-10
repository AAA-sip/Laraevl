<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ContentController extends Controller
{

    public function index()
    {
        $contents = Content::all();
        return view('dashboard', compact('contents'));
    }

    public function search(Request $request)
    {
        $sort = $request->input('sort', 'created_at'); // default sorting by created_at
        $direction = $request->input('direction', 'desc'); // default sorting direction is descending

        $contents = Content::query();

        if ($sort === 'popularity') {
            $contents->orderBy('created_at', $direction); // replace 'views' with the actual field for popularity
        } elseif ($sort === 'last_update') {
            $contents->orderBy('updated_at', $direction);
        } elseif ($sort === 'name') {
            $contents->orderBy('title', $direction);
        } else {
            $contents->orderBy($sort, $direction);
        }

        // Filter by name
        $search = $request->input('search');
        if ($search) {
            $contents->where('title', 'like', '%' . $search . '%');
        }
//
        $contents = $contents->paginate(3);

        return view('dashboard', compact('contents'));
    }




    public function create()
    {
        return view('create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:contents',
            'description' => 'required',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'game_html' => 'mimes:html,php|required',
        ]);

        $slug = Str::slug($request->input('title'));


        $content = new Content;
        $content->user_id = auth()->id();
        $content->title = $request->title;
        $content->description = $request->description;
        $content->slug = $slug;


        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $filename = time() . '_' . $picture->getClientOriginalName();
            $picture->move(public_path('uploads'), $filename);
            $content->picture = $filename;
        }

        if ($request->hasFile('game_html')) {
            $game_html = $request->file('game_html');
            $filename = time() . '_' . $game_html->getClientOriginalName();
            $game_html->move(public_path('games'), $filename);
            $content->game_html = $filename;
        }

        $content->save();
        return redirect()->route('dashboard', $slug)->with('success', 'Content created successfully!');
    }


    public function show($slug)
    {
        $content = Content::where('slug', $slug)->firstOrFail();
        return view('show', compact('content', ));
    }





    public function edit(Content $content)
    {


        if (Auth::id() != $content->user_id) {
            return redirect()->route('dashboard');
        }

        return view('edit', compact('content'));
    }


    public function update(Request $request, Content $content)
    {
        $request->validate([
            'title' => 'required|unique:contents',
            'description' => 'required',
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'game_html' => 'mimes:html|max:2048',
        ]);

        $slug = Str::slug($request->input('title'));

        $content->title = $request->input('title');
        $content->description = $request->input('description');
        $content->slug = $slug;

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $filename = time() . '_' . $picture->getClientOriginalName();
            $picture->move(public_path('uploads'), $filename);
            $content->picture = $filename;
        }

        if ($request->hasFile('game_html')) {
            $game_html = $request->file('game_html');
            $filename = time() . '_' . $game_html->getClientOriginalName();
            $game_html->move(public_path('games'), $filename);
            $content->game_html = $filename;
        }
        $content->save();
        return redirect()->route('dashboard', $slug)->with('success', 'vsee!');
    }


    public function destroy(Content $content)
    {
        $content->delete();
        return redirect()->route('dashboard')->with('success', 'Content deleted successfully.');
    }

    public function hide($id)
    {
        $content = Content::find($id);
        if (!$content) {
            // Content not found
            return redirect()->back()->with('error', 'Content not found.');
        }

        // Toggle is_hidden attribute
        $content->is_hidden = !$content->is_hidden;
        $content->save();

        // Redirect to content show page
        return redirect()->route('dashboard', $content->slug)->with('success', 'Content visibility toggled successfully.');
    }
}

