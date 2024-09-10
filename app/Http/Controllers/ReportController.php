<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportRating;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::where('user_id', Auth::id())->get();

        return view('reports.index', compact('reports'));
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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
