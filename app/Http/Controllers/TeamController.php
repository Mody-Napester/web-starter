<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return String
     */
    public function index(){
        $data['resources'] = Team::all();
        return view('@dashboard.team.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return String
     */
    public function create()
    {
        return view('@dashboard.team.create');
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
            $rules['title_' . $lang] = 'required';
            $rules['details_' . $lang] = 'required';
        }

        $request->validate($rules);

        // Code
        $name = [];
        $title = [];
        $details = [];

        foreach (langs('short_name') as $lang) {
            $name[$lang] = $request->input('name_' . $lang);
            $title[$lang] = $request->input('title_' . $lang);
            $details[$lang] = $request->input('details_' . $lang);
        }

        if($request->hasFile('image')){
            $upload = upload_file('image', $request->file('image'), 'assets/images/team');
            if ($upload['status'] == true){
                $image = $upload['filename'];
            }else{
                return back()->with('message',[
                    'type'=> 'danger',
                    'text'=> 'Image ' . $upload['message']
                ]);
            }
        }

        $resource = Team::create([
            'name' => json_encode($name),
            'title' => json_encode($title),
            'details' => json_encode($details),
            'image' => $image,
            'facebook_url' => $request->facebook_url,
            'twitter_url' => $request->twitter_url,
            'linkedin_url' => $request->linkedin_url,
        ]);

        // Return
        if($resource){
            return redirect(route('team.index'))->with('message', [
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
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return String
     */
    public function edit(Team $team)
    {
//        $data['resource'] = Team::where('id', $team)->first();
        $data['resource'] = $team;
        return view('@dashboard.team.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return String
     */
    public function update(Request $request, Team $team)
    {
        $data['resource'] = $team;

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
            $rules['title_' . $lang] = 'required';
            $rules['details_' . $lang] = 'required';
        }

        $request->validate($rules);

        // Code
        $name = [];
        $title = [];
        $details = [];

        foreach (langs('short_name') as $lang) {
            $name[$lang] = $request->input('name_' . $lang);
            $title[$lang] = $request->input('title_' . $lang);
            $details[$lang] = $request->input('details_' . $lang);
        }

        if($request->hasFile('image')){
            $upload = upload_file('image', $request->file('image'), 'assets/images/team');
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
            'name' => json_encode($name),
            'title' => json_encode($title),
            'details' => json_encode($details),
            'image' => (isset($image)? $image : $data['resource']->image),
            'facebook_url' => $request->facebook_url,
            'twitter_url' => $request->twitter_url,
            'linkedin_url' => $request->linkedin_url,
        ]);

        // Return
        if($resource){
            return redirect(route('team.index'))->with('message', [
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
     * @param  \App\Team  $team
     * @return String
     */
    public function destroy(Team $team)
    {
        $data['resource'] = $team;

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
