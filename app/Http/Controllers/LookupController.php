<?php

namespace App\Http\Controllers;

use App\Models\Lookup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Exports\LookupsExport;
use Maatwebsite\Excel\Facades\Excel;

class LookupController extends Controller
{
    // Export Resource
    public function export()
    {
        // Check Authority
        if (!check_authority('export.lookup')){
            return redirect('/');
        }

        return Excel::download(new LookupsExport(), 'lookups-'. time() . '-' . date('d-m-Y') .'.xlsx');
    }

    /**
     * Display a listing of the resource.
     *
     * @return String
     */
    public function index(){
        // Check Authority
        if (!check_authority('index.lookup')){
            return redirect('/');
        }

        $data['resources'] = Lookup::with('child')->where('parent_id', 0)->get();
        return view('@dashboard.lookup.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return String
     */
    public function create()
    {
        // Check Authority
        if (!check_authority('add.lookup')){
            return redirect('/');
        }

        $data['parents'] = Lookup::getAllBy('parent_id', 0);
        return view('@dashboard.lookup.create', $data);
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
        if (!check_authority('add.lookup')){
            return redirect('/');
        }

        // Validation
        $rules = [
            'parent_id' => 'required',
            'is_active' => 'required',
        ];

        foreach (langs("short_name") as $lang) {
            $rules['name_' . $lang] = 'required|unique:lookups,name';
        }

        $request->validate($rules);

        // Code
        $name = [];

        foreach (langs("short_name") as $lang) {
            $name[$lang] = $request->input('name_' . $lang);
        }

        $exists = Lookup::where('key', Str::slug($name['en'], '_'))->first();

        if($exists){
            return back()->with('message', [
                'type' => 'danger',
                'text' => 'Sorry!, Already exists.'
            ]);
        }

        $parent = (Lookup::getOneBy('uuid', $request->parent_id))? Lookup::getOneBy('uuid', $request->parent_id)->id : 0;
        $resource = Lookup::create([
            'parent_id' => $parent,
            'key' => Str::slug($name['en'], '_'),
            'name' => json_encode($name),
            'is_active' => ($request->is_active == 1)? 1 : 0,
            'created_by' => auth()->user()->id,
        ]);

        session()->put('parent', $parent);

        // Return
        if($resource){
            return back()->with('message', [
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
     * @param  \App\Models\Lookup  $lookup
     * @return \Illuminate\Http\Response
     */
    public function show(Lookup $lookup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lookup  $lookup
     * @return String
     */
    public function edit(Lookup $lookup)
    {
        // Check Authority
        if (!check_authority('edit.lookup')){
            return redirect('/');
        }

        $data['resource'] = $lookup;
        $data['parents'] = Lookup::getAllBy('parent_id', 0);
        return view('@dashboard.lookup.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lookup  $lookup
     * @return String
     */
    public function update(Request $request, Lookup $lookup)
    {
        // Check Authority
        if (!check_authority('edit.lookup')){
            return redirect('/');
        }

        $data['resource'] = $lookup;

        // Return
        if(!$data['resource']){
            return redirect()->back()->with('message',[
                'type'=>'danger',
                'text'=>'Sorry! not exists.'
            ]);
        }

        $rules = [
            'parent_id' => 'required',
            'is_active' => 'required',
        ];

        foreach (langs("short_name") as $lang) {
            $rules['name_' . $lang] = 'required';
        }

        // Code
        $name = [];

        foreach (langs("short_name") as $lang) {
            $name[$lang] = $request->input('name_' . $lang);
        }

        $request->validate($rules);

        $parent = (Lookup::getOneBy('uuid', $request->parent_id))? Lookup::getOneBy('uuid', $request->parent_id)->id : 0;

        $resource = $data['resource']->update([
            'parent_id' => $parent,
            'key' => Str::slug($name['en'], '_'),
            'name' => json_encode($name),
            'is_active' => ($request->is_active == 1)? 1 : 0,
            'updated_by' => auth()->user()->id,
        ]);

        // Return
        if($resource){
            return redirect(route('lookup.index'))->with('message', [
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
     * @param  \App\Models\Lookup  $lookup
     * @return String
     */
    public function destroy(Lookup $lookup)
    {
        // Check Authority
        if (!check_authority('delete.lookup')){
            return redirect('/');
        }

        $data['resource'] = $lookup;

        if($data['resource']){
//            $exists_in_customers = Customer::where('lookup_country_id', $data['resource']->id)
//                ->orWhere('lookup_city_id', $data['resource']->id)
//                ->orWhere('lookup_district_id', $data['resource']->id)
//                ->orWhere('lookup_sales_man_id', $data['resource']->id)
//                ->orWhere('lookup_customer_type_id', $data['resource']->id)
//                ->count();


//            if($exists_in_customers == 0 && $exists_in_form_support == 0)
            if($data['resource'])
            {
                $data['resource']->delete();
                return redirect()->back()->with('message',[
                    'type'=>'success',
                    'text'=> trans('messages.Deleted_Successfully')
                ]);
            }else{
                return redirect()->back()->with('message',[
                    'type'=>'danger',
                    'text'=> trans('messages.Sorry_it_exists_the_system')
                ]);
            }

        }else{
            return redirect()->back()->with('message',[
                'type'=>'danger',
                'text'=> trans('messages.Sorry_not_exists')
            ]);
        }
    }
}
