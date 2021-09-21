<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return String
     */
    public function index(){
        $data['resources'] = Partner::orderBy('ordering', 'DESC')->get();
        return view('@dashboard.partner.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return String
     */
    public function create()
    {
        return view('@dashboard.partner.create');
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

        if($request->hasFile('banner')){
            $upload = upload_file('image', $request->file('banner'), 'assets/images/partner');
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
            $upload = upload_file('image', $request->file('image'), 'assets/images/partner');
            if ($upload['status'] == true){
                $image = $upload['filename'];
            }else{
                return back()->with('message',[
                    'type'=> 'danger',
                    'text'=> 'Image ' . $upload['message']
                ]);
            }
        }

        $resource = Partner::create([
            'ordering' => $request->ordering,
            'title' => json_encode($title),
            'details' => json_encode($details),
            'banner' => $banner,
            'image' => $image,
        ]);

        // Return
        if($resource){
            return redirect(route('partner.index'))->with('message', [
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
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Partner  $partner
     * @return String
     */
    public function edit(Partner $partner)
    {
//        $data['resource'] = Partner::where('id', $partner)->first();
        $data['resource'] = $partner;
        return view('@dashboard.partner.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Partner  $partner
     * @return String
     */
    public function update(Request $request, Partner $partner)
    {
        $data['resource'] = $partner;

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

        if($request->hasFile('banner')){
            $upload = upload_file('image', $request->file('banner'), 'assets/images/partner');
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
            $upload = upload_file('image', $request->file('image'), 'assets/images/partner');
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
            'title' => json_encode($title),
            'details' => json_encode($details),
            'banner' => (isset($banner)? $banner : $data['resource']->banner),
            'image' => (isset($image)? $image : $data['resource']->image),
        ]);

        // Return
        if($resource){
            return redirect(route('partner.index'))->with('message', [
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
     * @param  \App\Partner  $partner
     * @return String
     */
    public function destroy(Partner $partner)
    {
        $data['resource'] = $partner;

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
