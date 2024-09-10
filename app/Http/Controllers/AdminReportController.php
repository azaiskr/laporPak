<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Status;
use App\Models\ReportRating;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Http\Requests\UpdateReportStatusRequest;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    // Display the specified resource.
    public function show(Report $report)
    {
        $statuses = Status::all();
        return view('reports.detail', [
            'report' => $report,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        //
    }

    public function getPopularReports()
    {
        $reportIds = ReportRating::select('laporan_id')
            ->where('rating_type', 'up')
            ->groupBy('laporan_id')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(10)
            ->pluck('laporan_id');

        $reports = Report::whereIn('id', $reportIds)
            ->get();

        return view('reports.popular', ['reports' => $reports]);
    }

    public function updateReportStatus(UpdateReportStatusRequest $request, $id)
    {
        $status = $request->validated()['status'];

        $report = Report::find($id);

        if (!$report) {
            return redirect()->back()->with('error', 'Report not found.');
        }

        $report->status = $status;
        $report->save();

        return redirect()->back()->with('success', 'Report status updated successfully.');
    }

    public function getReportByTitle(Request $request){
        $query = $request->input('query');
        $reports = Report::where('title', 'like', '%' . $query . '%')
            ->with(['user', 'category', 'status'])
            ->get();
        
        return response()->json($reports);
        // return view('partials.report_list', ['reports' => $reports]);
    }
    
}
