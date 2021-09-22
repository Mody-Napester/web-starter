<?php

namespace App\Http\Controllers;

use App\Exports\QuotationsExport;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuotationController extends Controller
{
    // Export Resource
    public function export()
    {
        // Check Authority
        if (!check_authority('export.quotation')){
            return redirect('/');
        }

        return Excel::download(new QuotationsExport(), 'quotations-'. time() . '-' . date('d-m-Y') .'.xlsx');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check Authority
        if (!check_authority('index.quotation')){
            return redirect('/');
        }

        $data['resources'] = Quotation::all();
        return view('@dashboard.quotation.index', $data);
    }
}
