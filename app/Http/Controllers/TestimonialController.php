<?php

namespace App\Http\Controllers;

use App\Models\Testimonials;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return String
     */
    public function index(){
        $data['resources'] = Testimonials::orderBy('ordering', 'DESC')->get();
        return view('@dashboard.testimonial.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return String
     */
    public function create()
    {
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
        // Validation
        $rules = [
            'image' => 'required',
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

        if($request->hasFile('image')){
            $upload = upload_file('image', $request->file('image'), 'assets/images/testimonial');
            if ($upload['status'] == true){
                $image = $upload['filename'];
            }else{
                return back()->with('message',[
                    'type'=> 'danger',
                    'text'=> 'Image ' . $upload['message']
                ]);
            }
        }

        $resource = Testimonials::create([
            'ordering' => $request->ordering,
            'name' => json_encode($name),
            'work' => json_encode($work),
            'title' => json_encode($title),
            'details' => json_encode($details),
            'image' => $image,
        ]);

        // Return
        if($resource){
            return redirect(route('testimonial.index'))->with('message', [
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
     * @param  \App\Testimonials  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonials $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testimonials  $testimonial
     * @return String
     */
    public function edit(Testimonials $testimonial)
    {
//        $data['resource'] = Testimonials::where('id', $testimonial)->first();
        $data['resource'] = $testimonial;
        return view('@dashboard.testimonial.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonials  $testimonial
     * @return String
     */
    public function update(Request $request, Testimonials $testimonial)
    {
        $data['resource'] = $testimonial;

        // Return
        if(!$data['resource']){
            return redirect()->back()->with('message',[
                'type'=>'danger',
                'text'=>'Sorry! page not exists.'
            ]);
        }

        // Validation
        $rules = [
//            'image' => 'required',
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

        if($request->hasFile('image')){
            $upload = upload_file('image', $request->file('image'), 'assets/images/testimonial');
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
            'name' => json_encode($name),
            'work' => json_encode($work),
            'title' => json_encode($title),
            'details' => json_encode($details),
            'image' => (isset($image)? $image : $data['resource']->image),
        ]);

        // Return
        if($resource){
            return redirect(route('testimonial.index'))->with('message', [
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
     * @param  \App\Testimonials  $testimonial
     * @return String
     */
    public function destroy(Testimonials $testimonial)
    {
        $data['resource'] = $testimonial;

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
