<?php

function getFromJson($json , $lang){
    $data = json_decode($json, true);
    return (isset($data[$lang])) ? $data[$lang] : '';
}

// Get path
function get_path($path){
    return base_path() . config('vars.public') . '/' . $path;
}

// Default language
function check_authority($authority){
    return \App\Models\User::hasAuthority($authority);
}

// Default language
function lang(){
    return app()->getLocale();
}

// System languages
function langs($get = null){
    $get_array = [];
    if($get == null){
        $get_array = config('vars.langs');
    }else{
        foreach (config('vars.langs') as $lang) {
            if($get == 'short_name'){
                $get_array[] = $lang['short_name'];
            }
        }
    }
    return $get_array;
}

// Get lookup
function lookup($by, $value){
    $results = null;
    $by_array = ['id','uuid','name','parent_id'];
    if (in_array($by, $by_array)){$results = \App\Models\Lookup::where($by, $value)->first();}
    return $results;
}

// Get lookups
function lookups($key){
    $lookup = \App\Models\Lookup::getOneBy('key', $key);
    if($lookup){
        return \App\Models\Lookup::getAllBy('parent_id', $lookup->id);
    }else{
        return null;
    }
}

// Get lookups
function activeLookups($key){
    $lookup = \App\Models\Lookup::where('key', $key)->where('is_active', 1)->first();
    if($lookup){
        return \App\Models\Lookup::where('parent_id', $lookup->id)->where('is_active', 1)->get();
    }else{
        return null;
    }
}

// User fullname
function name($user = null){
    if($user != null){
        return $user->fname . ' ' . $user->lname;
    }else{
        return auth()->user()->fname . ' ' . auth()->user()->lname;
    }
}

// Customer Whats app number
function get_whats_app_number($customer){
    return '+' . $customer->country_key . $customer->whatsapp_number;
}

// Custom Date
function custom_date($date){
    return date('d-m-Y, g:i a', strtotime($date));
}

// Human Date
function human_date($date){
//    $editDate = str_replace('-0001-11-30', '2016-11-30', $date);
    return Carbon\Carbon::createFromTimeStamp(strtotime($date))->diffForHumans();
}

// Site languages
function languages(){
    $lookup = \App\Lookup::where('name', 'languages')->first();
    return \App\Lookup::where('parent_id', $lookup->id)->get();
}

// Get lookups
function str_well($value){
    return ucfirst(str_replace('_', ' ', $value));
}

// Upload files
function upload_file($type, $file, $path){

    $results = [
        'status' => false,
        'filename' => null,
        'mime' => null,
        'message' => null,
    ];

    $extension = strtolower($file->getClientOriginalExtension());

    $validExtensions = ['jpg', 'png', 'gif', 'txt', 'dox'];

    if (in_array($extension, $validExtensions)) {

        $filename = time().rand(1000,9999).'.'.$extension;
        $destinationPath = get_path($path);

        $upload = $file->move($destinationPath, $filename);

        if ($upload) {
            // File Uploaded
            $results['status'] = true;
            $results['filename'] = $filename;
            $results['message'] = 'Uploaded Successfully';

            return $results;
        }else{
            // Error Uploading
            $results['message'] = 'Error Uploading';

            return $results;
        }

    }else{
        // File not valid
        $results['message'] = 'File not valid';

        return $results;
    }
}

// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
