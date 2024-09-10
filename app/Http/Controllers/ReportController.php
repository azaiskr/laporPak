<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Status;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    
    // Display a listing of the resource.
    public function index()
    {
        //
    }


    // Display the specified resource.
    public function show(Report $report) {     
        return view('reports.detail', [
            'report' => $report,
        ]);
    }

    // Show the form for creating a new resource.
    public function create(){
        $categories = Category::all();

        return view('reports.create',['categories' => $categories]);
    }


    // Store a newly created resource in storage.
    public function store(StoreReportRequest $request)
    {
        $report = Report::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'media' => $request->input('media'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'address' => $request->input('address'),
            'status_id' => $request->input('status_id', 1),
        ]);
        return redirect()->route('reports.index')->with('message', 'Report created successfully');
    }


    // Search Report by title
    public function getReportByTitle(Request $request){
        $query = $request->input('query');
        $reports = Report::where('title', 'like', '%' . $query . '%')
            ->with(['user', 'category', 'status'])
            ->get();
        
        return response()->json($reports);
        // return view('partials.report_list', ['reports' => $reports]);
    }

}
