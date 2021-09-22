<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return String
     */
    public function index()
    {
        // Check Authority
        if (!check_authority('index.social')){
            return redirect('/');
        }

        $data['resources'] = Social::all();
        return view('@dashboard.social.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return String
     */
    public function create()
    {
        // Check Authority
        if (!check_authority('create.social')){
            return redirect('/');
        }

        $data['providers'] = lookups('providers');
        return view('@dashboard.social.create', $data);
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
        if (!check_authority('create.social')){
            return redirect('/');
        }

        // Validation
        $rules = [
            'lookup_provider_id' => 'required',
            'name' => 'required',
            'link' => 'required',
            'is_active' => 'required',
        ];

        $request->validate($rules);

        $resource = Social::create([
            'lookup_provider_id' => $request->lookup_provider_id,
            'name' => $request->name,
            'link' => $request->link,
            'is_active' => ($request->is_active == 1)? 1 : 0,
            'created_by' => auth()->user()->id,
        ]);

        // Return
        if($resource){
            return redirect(route('social.index'))->with('message', [
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
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function show(Social $social)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Social  $social
     * @return String
     */
    public function edit(Social $social)
    {
        // Check Authority
        if (!check_authority('edit.social')){
            return redirect('/');
        }

        $data['resource'] = $social;
        $data['providers'] = lookups('providers');
        return view('@dashboard.social.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Social  $social
     * @return String
     */
    public function update(Request $request, Social $social)
    {
        // Check Authority
        if (!check_authority('edit.social')){
            return redirect('/');
        }

        $data['resource'] = $social;

        // Return
        if(!$data['resource']){
            return redirect()->back()->with('message',[
                'type'=>'danger',
                'text'=> trans('messages.Sorry_resource_not_exists.')
            ]);
        }

        // Validation
        $rules = [
            'lookup_provider_id' => 'required',
            'name' => 'required',
            'link' => 'required',
            'is_active' => 'required',
        ];

        $request->validate($rules);

        $resource = $data['resource']->update([
            'lookup_provider_id' => $request->lookup_provider_id,
            'name' => $request->name,
            'link' => $request->link,
            'is_active' => ($request->is_active == 1)? 1 : 0,
            'updated_by' => auth()->user()->id,
        ]);

        // Return
        if($resource){
            return redirect(route('social.index'))->with('message', [
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
     * @param  \App\Social  $social
     * @return String
     */
    public function destroy(Social $social)
    {
        // Check Authority
        if (!check_authority('delete.social')){
            return redirect('/');
        }

        $data['resource'] = $social;

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
