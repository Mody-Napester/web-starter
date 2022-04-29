<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check Authority
        if (!check_authority('index.media')){
            return redirect('/');
        }

        $data['resources'] = Media::all();
        return view('@dashboard.media.index', $data);
    }

    /**
     * Create resource.
     */
    public function create()
    {
        // Check Authority
        if (!check_authority('create.media')){
            return redirect('/');
        }

        $data['types'] = lookups('file_type');
        return view('@dashboard.media.create', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $rules = [
            'lookup_file_id' => 'required',
            'file' => 'required',
            'is_active' => 'required',
        ];

        $request->validate($rules);

        try {
            if($request->hasFile('file')){
                $upload = upload_file('file', $request->file('file'), 'assets_public/media');
                if ($upload['status'] == true){
                    $file = $upload['filename'];
                }else{
                    return back()->with('message',[
                        'type'=> 'danger',
                        'text'=> 'Image ' . $upload['message']
                    ]);
                }
            }

            $resource = Media::create([
                'lookup_file_id' => $request->lookup_file_id,
                'file' => $file,
                'is_active' => ($request->is_active == 1)? 1 : 0,
                'created_by' => auth()->user()->id,
            ]);

            // Return
            if($resource){
                return redirect(route('media.index'))->with('message', [
                    'type' => 'success',
                    'text' => trans('messages.Created_successfully')
                ]);
            }else{
                return back()->with('message', [
                    'type' => 'danger',
                    'text' => trans('messages.Error_Please_try_again')
                ]);
            }
        }catch (\Exception $exception){
            return
                "Code : " . $exception->getCode() . '<br>' .
                "Line : " . $exception->getLine() . '<br>' .
                "Message : " . $exception->getMessage() . '<br>' .
                "File : ". $exception->getFile() ;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($media)
    {
        $data['resource'] = Media::find($media);

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
