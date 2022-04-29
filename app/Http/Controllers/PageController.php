<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return String
     */
    public function index()
    {
        // Check Authority
        if (!check_authority('index.page')){
            return redirect('/');
        }

        $data['resources'] = Page::all();
        return view('@dashboard.page.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return String
     */
    public function create()
    {
        // Check Authority
        if (!check_authority('create.page')){
            return redirect('/');
        }

        return view('@dashboard.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return String
     */
    public function store(Request $request)
    {
        // Check Authority
        if (!check_authority('create.page')){
            return redirect('/');
        }

        // Validation
        $rules = [
            'banner' => 'required',
            'image' => 'required',
            'is_active' => 'required',
        ];

        foreach (langs('short_name') as $lang) {
            $rules['title_' . $lang] = 'required';
            $rules['details_' . $lang] = 'required';
        }

        $request->validate($rules);

        // Code
        $title = [];
        $details = [];

        foreach (langs('short_name') as $lang) {
            $title[$lang] = $request->input('title_' . $lang);
            $details[$lang] = $request->input('details_' . $lang);
        }

        $resource = Page::create([
            'ordering' => $request->ordering,
            'title' => json_encode($title),
            'details' => json_encode($details),
            'banner' => $request->banner,
            'image' => $request->image,
            'is_active' => ($request->is_active == 1)? 1 : 0,
            'created_by' => auth()->user()->id,
        ]);

        // Return
        if($resource){
            return redirect(route('page.index'))->with('message', [
                'type' => 'success',
                'text' => trans('messages.Created_successfully')
            ]);
        }else{
            return back()->with('message', [
                'type' => 'danger',
                'text' => trans('messages.Error_Please_try_again')
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return String
     */
    public function edit(Page $page)
    {
        // Check Authority
        if (!check_authority('edit.page')){
            return redirect('/');
        }

        $data['resource'] = $page;
        return view('@dashboard.page.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return String
     */
    public function update(Request $request, Page $page)
    {
        // Check Authority
        if (!check_authority('edit.page')){
            return redirect('/');
        }

        $data['resource'] = $page;

        // Return
        if(!$data['resource']){
            return redirect()->back()->with('message',[
                'type'=>'danger',
                'text'=> trans('messages.Sorry_resource_not_exists.')
            ]);
        }

        $rules = [
            'banner' => 'required',
            'image' => 'required',
            'is_active' => 'required',
        ];

        foreach (langs('short_name') as $lang) {
            $rules['title_' . $lang] = 'required';
            $rules['details_' . $lang] = 'required';
        }

        $request->validate($rules);

        // Code
        $title = [];
        $details = [];

        foreach (langs('short_name') as $lang) {
            $title[$lang] = $request->input('title_' . $lang);
            $details[$lang] = $request->input('details_' . $lang);
        }

        $resource = $data['resource']->update([
            'ordering' => $request->ordering,
            'title' => json_encode($title),
            'details' => json_encode($details),
            'banner' => $request->banner,
            'image' => $request->image,
            'is_active' => ($request->is_active == 1)? 1 : 0,
            'updated_by' => auth()->user()->id,
        ]);

        // Return
        if($resource){
            return redirect(route('page.index'))->with('message', [
                'type' => 'success',
                'text' => trans('messages.Updated_successfully')
            ]);
        }else{
            return back()->with('message', [
                'type' => 'error',
                'text' => trans('messages.Error_Please_try_again')
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return String
     */
    public function destroy(Page $page)
    {
        // Check Authority
        if (!check_authority('delete.page')){
            return redirect('/');
        }

        $data['resource'] = $page;

        if($data['resource']){

            $data['resource']->delete();

            return redirect()->back()->with('message',[
                'type'=>'success',
                'text'=> trans('messages.Deleted_Successfully')
            ]);
        }else{
            return redirect()->back()->with('message',[
                'type'=>'danger',
                'text'=> trans('messages.Sorry_not_exists')
            ]);
        }
    }
}
