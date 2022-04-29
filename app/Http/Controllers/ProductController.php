<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return String
     */
    public function index(){
        $data['resources'] = Product::orderBy('ordering', 'DESC')->get();
        return view('@dashboard.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return String
     */
    public function create()
    {
        $data['brands'] = Brand::all();
        return view('@dashboard.product.create', $data);
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
            'brand_id' => 'required',
            'banner' => 'required',
            'image' => 'required',
        ];

        foreach (config('vars.langs') as $lang) {
            $rules['title_' . $lang] = 'required';
            $rules['details_' . $lang] = 'required';
        }

        $request->validate($rules);

        // Code
        $title = [];
        $details = [];

        foreach (config('vars.langs') as $lang) {
            $title[$lang] = $request->input('title_' . $lang);
            $details[$lang] = $request->input('details_' . $lang);
        }

        if($request->hasFile('banner')){
            $upload = upload_file('image', $request->file('banner'), 'assets_public/images/product');
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
            $upload = upload_file('image', $request->file('image'), 'assets_public/images/product');
            if ($upload['status'] == true){
                $image = $upload['filename'];
            }else{
                return back()->with('message',[
                    'type'=> 'danger',
                    'text'=> 'Image ' . $upload['message']
                ]);
            }
        }

        $resource = Product::create([
            'brand_id' => $request->brand_id,
            'ordering' => $request->ordering,
            'show_in_home' => ($request->show_in_home == 1)? 1 : 0 ,
            'title' => json_encode($title),
            'details' => json_encode($details),
            'banner' => $banner,
            'image' => $image,
        ]);

        // Return
        if($resource){
            return redirect(route('product.index'))->with('message', [
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data['resource'] = $product;
        $data['brands'] = Brand::all();
        return view('@dashboard.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return String
     */
    public function update(Request $request, Product $product)
    {
        $data['resource'] = $product;

        // Return
        if(!$data['resource']){
            return redirect()->back()->with('message',[
                'type'=>'danger',
                'text'=>'Sorry! page not exists.'
            ]);
        }

        // Validation
        $rules = [
            'brand_id' => 'required',
//            'banner' => 'required',
//            'image' => 'required',
        ];

        foreach (config('vars.langs') as $lang) {
            $rules['title_' . $lang] = 'required';
            $rules['details_' . $lang] = 'required';
        }

        $request->validate($rules);

        // Code
        $title = [];
        $details = [];

        foreach (config('vars.langs') as $lang) {
            $title[$lang] = $request->input('title_' . $lang);
            $details[$lang] = $request->input('details_' . $lang);
        }

        if($request->hasFile('banner')){
            $upload = upload_file('image', $request->file('banner'), 'assets_public/images/product');
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
            $upload = upload_file('image', $request->file('image'), 'assets_public/images/product');
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
            'brand_id' => $request->brand_id,
            'ordering' => $request->ordering,
            'show_in_home' => ($request->show_in_home == 1)? 1 : 0 ,
            'title' => json_encode($title),
            'details' => json_encode($details),
            'banner' => (isset($banner)? $banner : $data['resource']->banner),
            'image' => (isset($image)? $image : $data['resource']->image),
        ]);

        // Return
        if($resource){
            return redirect(route('product.index'))->with('message', [
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
     * @param  \App\Product  $product
     * @return String
     */
    public function destroy(Product $product)
    {
        $data['resource'] = $product;

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
