<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return String
     */
    public function index(){
        $data['resources'] = Service::orderBy('ordering', 'DESC')->get();
        return view('@dashboard.service.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return String
     */
    public function create()
    {
        return view('@dashboard.service.create');
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

        foreach (langs('short_name') as $lang) {
            $rules['category_' . $lang] = 'required';
            $rules['title_' . $lang] = 'required';
            $rules['details_' . $lang] = 'required';
        }

        $request->validate($rules);

        // Code
        $category = [];
        $title = [];
        $details = [];

        foreach (langs('short_name') as $lang) {
            $category[$lang] = $request->input('category_' . $lang);
            $title[$lang] = $request->input('title_' . $lang);
            $details[$lang] = $request->input('details_' . $lang);
        }

        if($request->hasFile('banner')){
            $upload = upload_file('image', $request->file('banner'), 'assets/images/service');
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
            $upload = upload_file('image', $request->file('image'), 'assets/images/service');
            if ($upload['status'] == true){
                $image = $upload['filename'];
            }else{
                return back()->with('message',[
                    'type'=> 'danger',
                    'text'=> 'Image ' . $upload['message']
                ]);
            }
        }

        $resource = Service::create([
            'ordering' => $request->ordering,
            'category' => json_encode($category),
            'title' => json_encode($title),
            'details' => json_encode($details),
            'banner' => $banner,
            'image' => $image,
        ]);

        // Return
        if($resource){
            return redirect(route('service.index'))->with('message', [
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
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return String
     */
    public function edit(Service $service)
    {
//        $data['resource'] = Service::where('id', $service)->first();
        $data['resource'] = $service;
        return view('@dashboard.service.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return String
     */
    public function update(Request $request, Service $service)
    {
        $data['resource'] = $service;

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

        foreach (langs('short_name') as $lang) {
            $rules['category_' . $lang] = 'required';
            $rules['title_' . $lang] = 'required';
            $rules['details_' . $lang] = 'required';
        }

        $request->validate($rules);

        // Code
        $category = [];
        $title = [];
        $details = [];

        foreach (langs('short_name') as $lang) {
            $category[$lang] = $request->input('category_' . $lang);
            $title[$lang] = $request->input('title_' . $lang);
            $details[$lang] = $request->input('details_' . $lang);
        }

        if($request->hasFile('banner')){
            $upload = upload_file('image', $request->file('banner'), 'assets/images/service');
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
            $upload = upload_file('image', $request->file('image'), 'assets/images/service');
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
            'ordering' => $request->ordering,
            'category' => json_encode($category),
            'title' => json_encode($title),
            'details' => json_encode($details),
            'banner' => (isset($banner)? $banner : $data['resource']->banner),
            'image' => (isset($image)? $image : $data['resource']->image),
        ]);

        // Return
        if($resource){
            return redirect(route('service.index'))->with('message', [
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
     * @param  \App\Service  $service
     * @return String
     */
    public function destroy(Service $service)
    {
        $data['resource'] = $service;

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
