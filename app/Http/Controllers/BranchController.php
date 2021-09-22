<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return String
     */
    public function index()
    {
        // Check Authority
        if (!check_authority('index.branch')){
            return redirect('/');
        }

        $data['resources'] = Branch::all();
        return view('@dashboard.branch.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return String
     */
    public function create()
    {
        // Check Authority
        if (!check_authority('create.branch')){
            return redirect('/');
        }

        return view('@dashboard.branch.create');
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
        if (!check_authority('create.branch')){
            return redirect('/');
        }

        // Validation
        $rules = [
            'telephone' => 'required',
            'fax' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'map_link' => 'required',
            'is_active' => 'required',
        ];

        foreach (langs('short_name') as $lang) {
            $rules['name_' . $lang] = 'required';
            $rules['address_' . $lang] = 'required';
        }

        $request->validate($rules);

        // Code
        $name = [];
        $address = [];

        foreach (langs('short_name') as $lang) {
            $name[$lang] = $request->input('name_' . $lang);
            $address[$lang] = $request->input('address_' . $lang);
        }

        $resource = Branch::create([
            'name' => json_encode($name),
            'address' => json_encode($address),
            'telephone' => $request->input('telephone'),
            'fax' => $request->input('fax'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
            'map_link' => $request->input('map_link'),
            'is_default' => ($request->input('is_default') == 1)? 1 : 0,
            'is_active' => ($request->is_active == 1)? 1 : 0,
            'created_by' => auth()->user()->id,
        ]);

        // Return
        if($resource){
            return redirect(route('branch.index'))->with('message', [
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
     * @param  Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Branch  $branch
     * @return String
     */
    public function edit(Branch $branch)
    {
        // Check Authority
        if (!check_authority('edit.branch')){
            return redirect('/');
        }

        $data['resource'] = $branch;
        return view('@dashboard.branch.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Branch  $branch
     * @return String
     */
    public function update(Request $request, Branch $branch)
    {
        // Check Authority
        if (!check_authority('edit.branch')){
            return redirect('/');
        }

        $data['resource'] = $branch;

        // Return
        if(!$data['resource']){
            return redirect()->back()->with('message',[
                'type'=>'danger',
                'text'=> trans('messages.Sorry_resource_not_exists.')
            ]);
        }

        // Validation
        $rules = [
            'telephone' => 'required',
            'fax' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'map_link' => 'required',
            'is_active' => 'required',
        ];

        foreach (langs('short_name') as $lang) {
            $rules['name_' . $lang] = 'required';
            $rules['address_' . $lang] = 'required';
        }

        $request->validate($rules);

        // Code
        $name = [];
        $address = [];

        foreach (langs('short_name') as $lang) {
            $name[$lang] = $request->input('name_' . $lang);
            $address[$lang] = $request->input('address_' . $lang);
        }

        $resource = $data['resource']->update([
            'name' => json_encode($name),
            'address' => json_encode($address),
            'telephone' => $request->input('telephone'),
            'fax' => $request->input('fax'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
            'map_link' => $request->input('map_link'),
            'is_default' => ($request->input('is_default') == 1)? 1 : 0,
            'is_active' => ($request->is_active == 1)? 1 : 0,
            'updated_by' => auth()->user()->id,
        ]);

        // Return
        if($resource){
            return redirect(route('branch.index'))->with('message', [
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
     * @param  Branch  $branch
     * @return String
     */
    public function destroy(Branch $branch)
    {
        // Check Authority
        if (!check_authority('delete.branch')){
            return redirect('/');
        }

        $data['resource'] = $branch;

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
