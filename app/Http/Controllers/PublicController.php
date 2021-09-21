<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Contact;
use App\Models\Home;
use App\Models\Message;
use App\Models\Quotation;
use App\Models\Resource;
use App\Models\Service;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Home
     */
    public function index_home()
    {
        $data['resources'] = '';
        return view('@public.home.index');
    }

    /**
     * About
     */
    public function index_about()
    {
        $data['resources'] = '';
        return view('@public.about.index');
    }

    /**
     * Service
     */
    public function index_service()
    {
        $data['resources'] = '';
        return view('@public.service.index');
    }

    /**
     * Show service
     */
    public function show_service($id)
    {
        $data['service'] = Service::where('id', $id)->first();
        if($data['service']){
            return view('@public.service.show', $data);
        }else{
            return redirect('/');
        }
    }

    /**
     * Resource
     */
    public function index_resource()
    {
        $data['resources'] = '';
        return view('@public.resource.index');
    }

    /**
     * Show service
     */
    public function show_resource($id)
    {
        $data['resource'] = Resource::where('id', $id)->first();
        if($data['resource']){
            return view('@public.resource.show', $data);
        }else{
            return redirect('/');
        }
    }

    /**
     * Client
     */
    public function index_client()
    {
        $data['resources'] = '';
        return view('@public.client.index');
    }

    /**
     * Quotation
     */
    public function index_quotation()
    {
        $data['resources'] = '';
        return view('@public.quotation.index');
    }

    /**
     * store_quotation
     */
    public function store_quotation(Request $request)
    {
        // Validation
        $rules = [
//            'bname' => 'required',
            'name' => 'required',
            'email' => 'required',
//            'comments' => 'required',
        ];

        $request->validate($rules);

        $resource = Quotation::create([
            'bname' => $request->bname,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'comments' => ($request->has('comments'))? $request->comments : '',
        ]);

        // Send Emails
        $bName = "<b>Business Name : </b>" . $request->bname . "<br>";
        $name = "<b>Name : </b>" . $request->name . "<br>";
        $email = "<b>Email : </b>" . $request->email . "<br>";
        $phone = "<b>Phone : </b>" .$request->phone . "<br>";
        $comments = "<b>Comments : </b> : " . ($request->has('comments'))? $request->comments : '' . "<br>";

        $mail = $bName . $name . $email . $phone . $comments;

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $to = config('vars.to_mails');
        $subject = "Daleel Message (Quotation)";

        // Return
        if($resource){
            if (mail($to, $subject, $mail, $headers)) {
                return back()->with('message', [
                    'type' => 'success',
                    'text' => trans('messages.Your_message_was_sent_successfully')
                ]);
            } else {
                return back()->with('message', [
                    'type' => 'warning',
                    'text' => trans('messages.massage_saved')
                ]);
            }
        }else{
            return back()->with('message', [
                'type' => 'error',
                'text' => trans('messages.Error_Please_try_again')
            ]);
        }
    }

    /**
     * Career
     */
    public function index_career()
    {
        $data['resources'] = '';
        return view('@public.career.index');
    }

    /**
     * store_career
     */
    public function store_career(Request $request)
    {
        // Validation
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'y_o_experience' => 'required',
            'lang_pair' => 'required',
            'daily_out_put_capacity' => 'required',
            'job_type' => 'required',
            'speciality' => 'required',
            'cv' => 'required',
            'address' => 'required',
        ];

        $request->validate($rules);

        if($request->hasFile('cv')){
            $upload = upload_file('image_and_text', $request->file('cv'), 'assets/images/career');
            if ($upload['status'] == true){
                $cv = $upload['filename'];
            }else{
                $cv = '';
            }
        }else{
            $cv = '';
        }

        $resource = Applicant::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'y_o_experience' => $request->y_o_experience,
            'lang_pair' => $request->lang_pair,
            'daily_out_put_capacity' => $request->daily_out_put_capacity,
            'job_type' => $request->job_type,
            'speciality' => $request->speciality,
            'cv' => $cv,
            'address' => $request->address,
        ]);

        // Send Emails
        $name = "<b>Name : </b>" . $request->name . "<br>";
        $gender = "<b>Gender : </b>" . $request->gender . "<br>";
        $email = "<b>Email : </b>" . $request->email . "<br>";
        $mobile = "<b>Mobile : </b>" . $request->phone . "<br>";
        $lPear = "<b>Language pair : </b>" . $request->lang_pair . "<br>";
        $DOC = "<b>Daily output capacity : </b>" . $request->daily_out_put_capacity . "<br>";
        $jType = "<b>Job Type : </b>" . $request->job_type . "<br>";
        $speciality = "<b>Speciality : </b>" . $request->speciality . "<br>";
        $yOEx = "<b>Years of experience : </b>" . $request->y_o_experience . "<br>";
        $address = "<b>Address : </b>" . $request->address . "<br>";
        $cv = "<b>CV : </b><a href='" . url('assets/images/career/' . $cv) . "'>Download</a><br>";

        $mail = $name . $gender . $email . $mobile . $lPear . $DOC . $jType . $speciality . $yOEx . $address . $cv;

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $to = config('vars.to_mails');
        $subject = "Daleel Message (Quotation)";

        // Return
        if($resource){
            if (mail($to, $subject, $mail, $headers)) {
                return back()->with('message', [
                    'type' => 'success',
                    'text' => trans('messages.Your_message_was_sent_successfully')
                ]);
            } else {
                return back()->with('message', [
                    'type' => 'warning',
                    'text' => trans('messages.massage_saved')
                ]);
            }
        }else{
            return back()->with('message', [
                'type' => 'error',
                'text' => trans('messages.Error_Please_try_again')
            ]);
        }
    }

    /**
     * Contact
     */
    public function index_contact()
    {
        $data['resource'] = Contact::where('id', 1)->first();
        return view('@public.contact.index', $data);
    }

    /**
     * store_contact
     */
    public function store_contact(Request $request)
    {
        // Validation
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ];

        $request->validate($rules);

        $resource = Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Send Emails
        $name = "<b>Name : </b>" . $request->name . "<br>";
        $email = "<b>Email : </b>" . $request->email . "<br>";
        $phone = "<b>Phone : </b>" .$request->phone . "<br>";
        $subject = "<b>Subject : </b>" .$request->subject . "<br>";
        $message = "<b>Message : </b>" .$request->message . "<br>";

        $mail = $name . $email . $phone. $subject . $message;

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $to = config('vars.to_mails');
        $subject = "Daleel Message (Contact Page)";

        // Return
        if($resource){
            if (mail($to, $subject, $mail, $headers)) {
                return back()->with('message', [
                    'type' => 'success',
                    'text' => trans('messages.Your_message_was_sent_successfully')
                ]);
            } else {
                return back()->with('message', [
                    'type' => 'warning',
                    'text' => trans('messages.massage_saved')
                ]);
            }
        }else{
            return back()->with('message', [
                'type' => 'error',
                'text' => trans('messages.Error_Please_try_again')
            ]);
        }
    }
}
