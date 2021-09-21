<?php

namespace App\Http\Controllers;

use App\Branch;
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
        // Validation
        $rules = [
            'telephone' => 'required',
            'fax' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'map_link' => 'required',
        ];

        foreach (config('vars.langs') as $lang) {
            $rules['name_' . $lang] = 'required';
            $rules['address_' . $lang] = 'required';
        }

        $request->validate($rules);

        // Code
        $name = [];
        $address = [];

        foreach (config('vars.langs') as $lang) {
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
        ]);

        // Return
        if($resource){
            return redirect(route('branch.index'))->with('message', [
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
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return String
     */
    public function edit(Branch $branch)
    {
        $data['resource'] = $branch;
        return view('@dashboard.branch.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return String
     */
    public function update(Request $request, Branch $branch)
    {
        $data['resource'] = $branch;

        // Return
        if(!$data['resource']){
            return redirect()->back()->with('message',[
                'type'=>'danger',
                'text'=>'Sorry! branch not exists.'
            ]);
        }

        // Validation
        $rules = [
            'telephone' => 'required',
            'fax' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'map_link' => 'required',
        ];

        foreach (config('vars.langs') as $lang) {
            $rules['name_' . $lang] = 'required';
            $rules['address_' . $lang] = 'required';
        }

        $request->validate($rules);

        // Code
        $name = [];
        $address = [];

        foreach (config('vars.langs') as $lang) {
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
        ]);

        // Return
        if($resource){
            return redirect(route('branch.index'))->with('message', [
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
     * @param  \App\Branch  $branch
     * @return String
     */
    public function destroy(Branch $branch)
    {
        $data['resource'] = $branch;

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
