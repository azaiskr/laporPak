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
    // Display the specified resource.
    public function show(Report $report)
    {
        $statuses = Status::all();
        return view('reports.detail', [
            'report' => $report,
            'statuses' => $statuses,
        ]);
    }

    public function destroy($reportId){
        $report = Report::findOrFail($reportId);
        $report->delete();

        return redirect()->back()->with('success', 'Report deleted successfully.');
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

    public function getReportByTitle(Request $request){
        $query = $request->input('query');
        $reports = Report::where('title', 'like', '%' . $query . '%')
            ->with(['user', 'category', 'status'])
            ->get();
        
        return response()->json($reports);
        // return view('partials.report_list', ['reports' => $reports]);
    }
    
}
