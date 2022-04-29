<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return String
     */
    public function index()
    {
        // Check Authority
        if (!check_authority('index.testimonial')){
            return redirect('/');
        }

        $data['resources'] = Testimonial::all();
        return view('@dashboard.testimonial.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return String
     */
    public function create()
    {
        // Check Authority
        if (!check_authority('create.testimonial')){
            return redirect('/');
        }

        return view('@dashboard.testimonial.create');
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
        if (!check_authority('create.testimonial')){
            return redirect('/');
        }

        // Validation
        $rules = [
            'image' => 'required',
            'is_active' => 'required',
        ];

        foreach (langs('short_name') as $lang) {
            $rules['name_' . $lang] = 'required';
            $rules['work_' . $lang] = 'required';
            $rules['title_' . $lang] = 'required';
            $rules['details_' . $lang] = 'required';
        }

        $request->validate($rules);

        // Code
        $name = [];
        $work = [];
        $title = [];
        $details = [];

        foreach (langs('short_name') as $lang) {
            $name[$lang] = $request->input('name_' . $lang);
            $work[$lang] = $request->input('work_' . $lang);
            $title[$lang] = $request->input('title_' . $lang);
            $details[$lang] = $request->input('details_' . $lang);
        }

        $resource = Testimonial::create([
            'ordering' => $request->ordering,
            'name' => json_encode($name),
            'work' => json_encode($work),
            'title' => json_encode($title),
            'details' => json_encode($details),
            'image' => $request->image,
            'is_active' => ($request->is_active == 1)? 1 : 0,
            'created_by' => auth()->user()->id,
        ]);

        // Return
        if($resource){
            return redirect(route('testimonial.index'))->with('message', [
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
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return String
     */
    public function edit(Testimonial $testimonial)
    {
        // Check Authority
        if (!check_authority('edit.testimonial')){
            return redirect('/');
        }

        $data['resource'] = $testimonial;
        return view('@dashboard.testimonial.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return String
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        // Check Authority
        if (!check_authority('edit.testimonial')){
            return redirect('/');
        }

        $data['resource'] = $testimonial;

        // Return
        if(!$data['resource']){
            return redirect()->back()->with('message',[
                'type'=>'danger',
                'text'=> trans('messages.Sorry_resource_not_exists.')
            ]);
        }

        // Validation
        $rules = [
            'image' => 'required',
            'is_active' => 'required',
        ];

        foreach (langs('short_name') as $lang) {
            $rules['name_' . $lang] = 'required';
            $rules['work_' . $lang] = 'required';
            $rules['title_' . $lang] = 'required';
            $rules['details_' . $lang] = 'required';
        }

        $request->validate($rules);

        // Code
        $name = [];
        $work = [];
        $title = [];
        $details = [];

        foreach (langs('short_name') as $lang) {
            $name[$lang] = $request->input('name_' . $lang);
            $work[$lang] = $request->input('work_' . $lang);
            $title[$lang] = $request->input('title_' . $lang);
            $details[$lang] = $request->input('details_' . $lang);
        }

        $resource = $data['resource']->update([
            'ordering' => $request->ordering,
            'name' => json_encode($name),
            'work' => json_encode($work),
            'title' => json_encode($title),
            'details' => json_encode($details),
            'image' => $request->image,
            'is_active' => ($request->is_active == 1)? 1 : 0,
            'updated_by' => auth()->user()->id,
        ]);

        // Return
        if($resource){
            return redirect(route('testimonial.index'))->with('message', [
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
     * @param  \App\Testimonial  $testimonial
     * @return String
     */
    public function destroy(Testimonial $testimonial)
    {
        // Check Authority
        if (!check_authority('delete.testimonial')){
            return redirect('/');
        }

        $data['resource'] = $testimonial;

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
