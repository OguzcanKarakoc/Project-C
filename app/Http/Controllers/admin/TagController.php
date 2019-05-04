<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tags = Tag::paginate(5)->onEachSide(3);

        if ($request->ajax()) {
            return view('page.back-end.tag.paginate', compact('tags'));
        }

        return view('page.back-end.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.back-end.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $tagValidatedData = $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $tag = new Tag();
        $tag->name = $tagValidatedData['name'];
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Tag created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);

        return view('page.back-end.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $tagValidatedData = $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $tag = Tag::findOrFail($id);
        $tag->name = $tagValidatedData['name'];
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Tag updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully');
    }
}
