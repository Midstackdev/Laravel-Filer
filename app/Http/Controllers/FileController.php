<?php

namespace App\Http\Controllers;

use App\File;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::orderBy('created_at', 'desc')->paginate(30);
        return view('files.index', ['files' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('files.dropzone');
    }

    public function dropzone(Request $request) {
        $file = $request->file('file');
            File::create([
                'title' => $file->getClientOriginalName(),
                'description' => 'Uploaded with dropzone',
                'path' => $file->store('public/storage')
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$this->validate($request, [
            'file' => 'required|mimes:png,jpg,jpeg,gif|file|max:200000'
        ]);
        $upload = $request->file('file');
        $path = $upload->store('public/storage');
        $file = File::create([
            'title' => $upload->getClientOriginalName(),
            'description' => '',
            'path' => $path
        ]);*/
        $files = $request->file('file');
        foreach ($files as $file) {
            File::create([
                'title' => $file->getClientOriginalName(),
                'description' => '',
                'path' => $file->store('public/storage')
            ]);
        }
        return redirect('/file')->with('success', 'File uploaded Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file, $id)
    {
        $dl = File::find($id);
        return Storage::download($dl->path, $dl->title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file, $id)
    {
        $fl = File::find($id);
        $data = [
            'title' => $fl->title,
            'path' => $fl->path
        ];
        Mail::send('emails.attachment', $data, function($message) use($fl){
            $message->to('admin@admin.com', 'Admino Bosso')->subject('File Attached Embedde')
                    ->attach(storage_path('app/' .$fl->path))
                    ->from('admino@bosso.com', 'Boss Terror');
        });
        return redirect('/file')->with('success', 'File sent to your mail sent successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file, $id)
    {
        $del = File::find($id);
        Storage::delete($del->path);
        $del->delete();
        return redirect('/file');
    }
}
