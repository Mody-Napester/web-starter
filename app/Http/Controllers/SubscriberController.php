<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return String
     */
    public function index()
    {
        $data['resources'] = Subscriber::all();
        return view('@dashboard.subscriber.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return String
     */
    public function create()
    {
        //
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
            'email' => 'required',
        ];

        $request->validate($rules);

        $resource = Subscriber::create([
            'email' => $request->email,
        ]);

        // Return
        if($resource){
            return back()->with('message', [
                'type' => 'success',
                'text' => 'Subscribed successfully'
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
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriber $subscriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriber $subscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        //
    }
}
