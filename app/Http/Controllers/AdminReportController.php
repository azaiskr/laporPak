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

    public function getPopularReports($timeFrame)
    {
        $reportIds = ReportRating::select('laporan_id')
            ->where('rating_type', 'up')
            ->groupBy('laporan_id')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(5)
            ->pluck('laporan_id');

        $reportsQuery = Report::whereIn('id', $reportIds);

        switch ($timeFrame) {
            case 'monthly':
                $reportsQuery->where('created_at', '>=', now()->subMonth());
                break;
            case 'weekly':
                $reportsQuery->where('created_at', '>=', now()->subWeek());
                break;
            default:
                if (is_numeric($timeFrame) && $timeFrame > 0) {
                    $reportsQuery->where('created_at', '>=', now()->subDays($timeFrame));
                } else {
                    return redirect()->back()->with('error', 'Invalid time frame specified.');
                }
                break;
        }

        $reports = $reportsQuery->get();

        return view('reports.popular', ['reports' => $reports]);
    }

    public function updateReportStatus(UpdateReportStatusRequest $request, $reportId)
    {
        $status = $request->validated()['status'];

        $report = Report::find($reportId);

        if (!$report) {
            return redirect()->back()->with('error', 'Report not found.');
        }

        $report->status = $status;
        $report->save();

        return redirect()->back()->with('success', 'Report status updated successfully.');
    }
}
