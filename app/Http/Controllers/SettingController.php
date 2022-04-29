<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        // Check Authority
        if (!check_authority('edit.setting')){
            return redirect('/');
        }

        $data['resource'] = Setting::where('id', 1)->first();
        return view('@dashboard.setting.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Check Authority
        if (!check_authority('edit.setting')){
            return redirect('/');
        }

        $data['resource'] = Setting::where('id', 1)->first();

        // Return
        if(!$data['resource']){
            return redirect()->back()->with('message',[
                'type'=>'danger',
                'text'=> trans('messages.Sorry_resource_not_exists.')
            ]);
        }

        // Validation
        $rules = [
            'default_language_id' => 'required',
            'default_theme_id' => 'required',
        ];

        foreach (langs('short_name') as $lang) {
            $rules['logos_' . $lang] = 'required';
            $rules['name_' . $lang] = 'required';
            $rules['slogan_' . $lang] = 'required';
        }

        $request->validate($rules);

        // Code
        $logos = [];
        $name = [];
        $slogan = [];

        foreach (langs('short_name') as $lang) {
            $logos[$lang] = $request->input('logos_' . $lang);
            $name[$lang] = $request->input('name_' . $lang);
            $slogan[$lang] = $request->input('slogan_' . $lang);
        }

        try {
            $resource = $data['resource']->update([
                'logos' => json_encode($logos),
                'name' => json_encode($name),
                'slogan' => json_encode($slogan),
                'default_language_id' => $request->default_language_id,
                'default_theme_id' => $request->default_theme_id,
            ]);

            // Return
            if($resource){
                return redirect(route('setting.edit'))->with('message', [
                    'type' => 'success',
                    'text' => trans('messages.Updated_successfully')
                ]);
            }else{
                return back()->with('message', [
                    'type' => 'error',
                    'text' => trans('messages.Error_Please_try_again')
                ]);
            }
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
}
