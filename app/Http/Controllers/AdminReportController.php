<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportRating;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Http\Requests\UpdateReportStatusRequest;

class AdminReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function show(Report $report)
    {
        //
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

        return view('reports.popular', ['reports' => $reports]); //later modify the view
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
}
