<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return String
     */
    public function index(){
        $data['resources'] = Blog::all();
        return view('@dashboard.blog.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return String
     */
    public function create()
    {
        return view('@dashboard.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return String
     */
    public function store(Request $request)
    {
        // Validation
        $rules = [
            'banner' => 'required',
            'image' => 'required',
        ];

        foreach (config('vars.langs') as $lang) {
            $rules['title_' . $lang] = 'required';
            $rules['details_' . $lang] = 'required';
        }

        $request->validate($rules);

        // Code
        $title = [];
        $details = [];

        foreach (config('vars.langs') as $lang) {
            $title[$lang] = $request->input('title_' . $lang);
            $details[$lang] = $request->input('details_' . $lang);
        }

        if($request->hasFile('banner')){
            $upload = upload_file('image', $request->file('banner'), 'assets_public/images/blog');
            if ($upload['status'] == true){
                $banner = $upload['filename'];
            }else{
                return back()->with('message',[
                    'type'=> 'danger',
                    'text'=> 'Image ' . $upload['message']
                ]);
            }
        }

        if($request->hasFile('image')){
            $upload = upload_file('image', $request->file('image'), 'assets_public/images/blog');
            if ($upload['status'] == true){
                $image = $upload['filename'];
            }else{
                return back()->with('message',[
                    'type'=> 'danger',
                    'text'=> 'Image ' . $upload['message']
                ]);
            }
        }

        $resource = Blog::create([
            'title' => json_encode($title),
            'details' => json_encode($details),
            'banner' => $banner,
            'image' => $image,
        ]);

        // Return
        if($resource){
            return redirect(route('blog.index'))->with('message', [
                'type' => 'success',
                'text' => 'Created successfully'
            ]);
        }else{
            return back()->with('message', [
                'type' => 'error',
                'text' => 'Error!, Please try again.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return String
     */
    public function edit(Blog $blog)
    {
//        $data['resource'] = Blog::where('id', $blog)->first();
        $data['resource'] = $blog;
        return view('@dashboard.blog.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return String
     */
    public function update(Request $request, Blog $blog)
    {
        $data['resource'] = $blog;

        // Return
        if(!$data['resource']){
            return redirect()->back()->with('message',[
                'type'=>'danger',
                'text'=>'Sorry! page not exists.'
            ]);
        }

        // Validation
        $rules = [
//            'banner' => 'required',
//            'image' => 'required',
        ];

        foreach (config('vars.langs') as $lang) {
            $rules['title_' . $lang] = 'required';
            $rules['details_' . $lang] = 'required';
        }

        $request->validate($rules);

        // Code
        $title = [];
        $details = [];

        foreach (config('vars.langs') as $lang) {
            $title[$lang] = $request->input('title_' . $lang);
            $details[$lang] = $request->input('details_' . $lang);
        }

        if($request->hasFile('banner')){
            $upload = upload_file('image', $request->file('banner'), 'assets_public/images/blog');
            if ($upload['status'] == true){
                $banner = $upload['filename'];
            }else{
                return back()->with('message',[
                    'type'=> 'danger',
                    'text'=> 'Image ' . $upload['message']
                ]);
            }
        }

        if($request->hasFile('image')){
            $upload = upload_file('image', $request->file('image'), 'assets_public/images/blog');
            if ($upload['status'] == true){
                $image = $upload['filename'];
            }else{
                return back()->with('message',[
                    'type'=> 'danger',
                    'text'=> 'Image ' . $upload['message']
                ]);
            }
        }

        $resource = $data['resource']->update([
            'title' => json_encode($title),
            'details' => json_encode($details),
            'banner' => (isset($banner)? $banner : $data['resource']->banner),
            'image' => (isset($image)? $image : $data['resource']->image),
        ]);

        // Return
        if($resource){
            return redirect(route('blog.index'))->with('message', [
                'type' => 'success',
                'text' => 'Updated successfully'
            ]);
        }else{
            return back()->with('message', [
                'type' => 'error',
                'text' => 'Error!, Please try again.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return String
     */
    public function destroy(Blog $blog)
    {
        $data['resource'] = $blog;

        if($data['resource']){
            $data['resource']->delete();

            return redirect()->back()->with('message',[
                'type'=>'success',
                'text'=>'Deleted Successfully.'
            ]);
        }else{
            return redirect()->back()->with('message',[
                'type'=>'danger',
                'text'=>'Sorry! not exists.'
            ]);
        }
    }
}
