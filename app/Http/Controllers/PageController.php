<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PageController extends Controller
{
    // Export Resource
    public function export()
    {
//        return Excel::download(new PagesExport(), 'page-'. time() . '-' . date('d-m-Y') .'.xlsx');
    }

    /**
     * Display a listing of the resource.
     *
     * @return String
     */
    public function index()
    {
        // Check Authority
        if (!check_authority('list.page')){
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
        if (!check_authority('add.page')){
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
        if (!check_authority('add.page')){
            return redirect('/');
        }

        // Validation
        $rules = [
            'parent_id' => 'required',
            'is_active' => 'required',
        ];

        foreach (langs("short_name") as $lang) {
            $rules['name_' . $lang] = 'required|unique:page,name';
        }

        $request->validate($rules);

        // Code
        $name = [];

        foreach (langs("short_name") as $lang) {
            $name[$lang] = $request->input('name_' . $lang);
        }

        $exists = Page::where('key', Str::slug($name['en'], '_'))->first();

        if($exists){
            return back()->with('message', [
                'type' => 'danger',
                'text' => 'Sorry!, Already exists.'
            ]);
        }

        $parent = (Page::getOneBy('uuid', $request->parent_id))? Page::getOneBy('uuid', $request->parent_id)->id : 0;
        $resource = Page::create([
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
        $data['parents'] = Page::getAllBy('parent_id', 0);
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

        $parent = (Page::getOneBy('uuid', $request->parent_id))? Page::getOneBy('uuid', $request->parent_id)->id : 0;

        $resource = $data['resource']->update([
            'parent_id' => $parent,
            'key' => Str::slug($name['en'], '_'),
            'name' => json_encode($name),
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
//            $exists_in_customers = Customer::where('page_country_id', $data['resource']->id)
//                ->orWhere('page_city_id', $data['resource']->id)
//                ->orWhere('page_district_id', $data['resource']->id)
//                ->orWhere('page_sales_man_id', $data['resource']->id)
//                ->orWhere('page_customer_type_id', $data['resource']->id)
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
