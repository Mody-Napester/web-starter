<?php

namespace App\Http\Controllers;

use App\Exports\MessagesExport;
use App\Models\Message;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MessageController extends Controller
{
    // Export Resource
    public function export()
    {
        // Check Authority
        if (!check_authority('export.message')){
            return redirect('/');
        }

        return Excel::download(new MessagesExport(), 'messages-'. time() . '-' . date('d-m-Y') .'.xlsx');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check Authority
        if (!check_authority('index.message')){
            return redirect('/');
        }

        $data['resources'] = Message::all();
        return view('@dashboard.message.index', $data);
    }
}
