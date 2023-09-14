<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

use App\Models\Document;

use File;

class DocumentsController extends Controller
{
    private $path_folder = 'uploads/documents/';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $documents = Document::orderBy('created_at', 'DESC')
                        ->get();

        return view('documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('documents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     => 'required',
            'content'   => 'required|string',
            'signing'   => 'required|mimes:png|max:1024'
        ]);

        $slug           = Str::slug($request->title);

        $signing        = $request->file('signing');
        $signing_name   = $slug .'-'. Str::random(5) .'-'. time() .'.'. $signing->getClientOriginalExtension();
        $request->signing->move(public_path($this->path_folder), $signing_name);

        Document::create([
            'title'     => $request->title,
            'content'   => $request->content,
            'signing'   => $signing_name
        ]);

        return redirect()->route('documents.index')
                        ->with('success', 'Document Data Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Document::findOrFail($id);

        $view = view('documents.detail', compact('data'))->render();

        return response()->json(['view' => $view]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Document::findOrFail($id);

        return view('documents.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'     => 'required',
            'content'   => 'required|string',
            'signing'   => 'mimes:png|max:1024'
        ]);

        $data = Document::findOrFail($id);
        $slug = Str::slug(strtolower($request->title));

        if ($request->hasFile('signing')) {
            $signing        = $request->file('signing');
            $signing_name   = 'update-'. $slug .'-'. Str::random(5) .'-'. time() .'.'. $signing->getClientOriginalExtension();
            $request->signing->move(public_path($this->path_folder), $signing_name);

            if ($data->signing) {
                File::delete($this->path_folder . $data->signing);
            }
        } else {
            $signing_name = $data->signing;
        }

        $data->update([
            'title'     => $request->title,
            'content'   => $request->content,
            'signing'   => $signing_name
        ]);

        return redirect()->route('documents.index')
                        ->with('success', 'Document Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Document::findOrFail($id);
        $data->delete();

        return response()->json(['status' => true, 'message' => 'Document Data Deleted Successfully!']);
    }
}
