<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRatingRequest;
use App\Models\Report;
use App\Models\Status;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ReportRating;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{

    // Display a listing of the resource.
    public function index()
    {
        $reports = Report::where('user_id', Auth::id())->get();
        return view('reports.index', compact('reports'));
    }

    public function forum()
    {
        // Fetch report IDs with the count of upvotes
        $reportIdsWithCounts = ReportRating::select('laporan_id', DB::raw('COUNT(*) as upvote_count'))
            ->where('rating_type', 'up')
            ->groupBy('laporan_id')
            ->orderBy('upvote_count', 'DESC')
            ->limit(5)
            ->get();

        // Extract the report IDs
        $reportIds = $reportIdsWithCounts->pluck('laporan_id');

        // Fetch the reports based on the report IDs
        $reportsQuery = Report::whereIn('id', $reportIds);

        // Apply time frame filtering
        $reportsQuery->where('created_at', '>=', now()->subWeek());

        // Get the popular reports
        $popularReports = $reportsQuery->get();

        // Fetch downvote counts for the report IDs
        $downvoteCounts = ReportRating::select('laporan_id', DB::raw('COUNT(*) as downvote_count'))
            ->whereIn('laporan_id', $reportIds)
            ->where('rating_type', 'down')
            ->groupBy('laporan_id')
            ->get()
            ->keyBy('laporan_id');

        // Merge upvote and downvote counts into popular reports
        foreach ($popularReports as $report) {
            $upvoteData = $reportIdsWithCounts->firstWhere('laporan_id', $report->id);
            $report->upvote_count = $upvoteData ? $upvoteData->upvote_count : 0;
            $report->downvote_count = $downvoteCounts->get($report->id)->downvote_count ?? 0;
        }

        // Fetch the newest reports
        $newestReports = Report::orderBy('created_at', 'desc')->take(10)->get();

        // Extract report IDs for newest reports
        $newestReportIds = $newestReports->pluck('id');

        // Fetch upvote counts for newest reports
        $newestUpvoteCounts = ReportRating::select('laporan_id', DB::raw('COUNT(*) as upvote_count'))
            ->whereIn('laporan_id', $newestReportIds)
            ->where('rating_type', 'up')
            ->groupBy('laporan_id')
            ->get()
            ->keyBy('laporan_id');

        // Fetch downvote counts for newest reports
        $newestDownvoteCounts = ReportRating::select('laporan_id', DB::raw('COUNT(*) as downvote_count'))
            ->whereIn('laporan_id', $newestReportIds)
            ->where('rating_type', 'down')
            ->groupBy('laporan_id')
            ->get()
            ->keyBy('laporan_id');

        // Merge upvote and downvote counts into newest reports
        foreach ($newestReports as $report) {
            $report->upvote_count = $newestUpvoteCounts->get($report->id)->upvote_count ?? 0;
            $report->downvote_count = $newestDownvoteCounts->get($report->id)->downvote_count ?? 0;
        }

        return view('forum', ['popularReports' => $popularReports, 'newestReports' => $newestReports]);
    }


    public function getPopularReports($timeFrame)
    {
        // Fetch report IDs with the count of upvotes
        $reportIdsWithCounts = ReportRating::select('laporan_id', DB::raw('COUNT(*) as upvote_count'))
            ->where('rating_type', 'up')
            ->groupBy('laporan_id')
            ->orderBy('upvote_count', 'DESC')
            ->limit(5)
            ->get();

        // Extract the report IDs
        $reportIds = $reportIdsWithCounts->pluck('laporan_id');

        // Fetch the reports based on the report IDs
        $reportsQuery = Report::whereIn('id', $reportIds);

        // Apply time frame filtering
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

        // Get the popular reports
        $popularReports = $reportsQuery->get();

        // Fetch downvote counts for the report IDs
        $downvoteCounts = ReportRating::select('laporan_id', DB::raw('COUNT(*) as downvote_count'))
            ->whereIn('laporan_id', $reportIds)
            ->where('rating_type', 'down')
            ->groupBy('laporan_id')
            ->get()
            ->keyBy('laporan_id');

        // Merge upvote and downvote counts into reports
        foreach ($popularReports as $report) {
            $upvoteData = $reportIdsWithCounts->firstWhere('laporan_id', $report->id);
            $report->upvote_count = $upvoteData ? $upvoteData->upvote_count : 0;
            $report->downvote_count = $downvoteCounts->get($report->id)->downvote_count ?? 0;
        }

        $newestReports = Report::orderBy('created_at', 'desc')->take(10)->get();

        return view('forum', ['popularReports' => $popularReports, 'newestReports' => $newestReports]);
    }


    // Display the specified resource.
    public function show(Report $report)
    {
        return view('reports.detail', [
            'report' => $report,
        ]);
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $categories = Category::all();

        return view('reports.create', ['categories' => $categories]);
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
        return redirect()->back()->with('success', 'Laporan berhasil dikirim.');
    }


    // Search Report by title
    public function getReportByTitle(Request $request)
    {
        $query = $request->input('query');
        $reports = Report::where('title', 'like', '%' . $query . '%')
            ->with(['user', 'category', 'status'])
            ->get();

        return response()->json($reports);
        // return view('partials.report_list', ['reports' => $reports]);
    }


    public function postReportRatings(StoreReportRatingRequest $request, $reportId)
    {
        $validatedData = $request->validated();

        // Find the report or fail if not found
        $report = Report::findOrFail($reportId);

        // Create a new rating
        $report->ratings()->create([
            'user_id' => Auth::id(),
            'laporan_id' => $reportId, // Use $reportId here
            'rating_type' => $validatedData['rating_type'],
        ]);

        return redirect('forum');
    }


    public function getNewestReports()
    {
        $newestReports = Report::orderBy('created_at', 'desc')->take(10)->get();
        return view('reports.newest', ['newesrTreports' => $newestReports]); //Belum Fix
    }
}
