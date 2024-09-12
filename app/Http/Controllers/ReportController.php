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

    public function forum($timeFrame = 'weekly')
    {
        // Define the valid time frames
        $validTimeFrames = ['weekly', 'monthly'];

        // If the provided time frame is invalid, default to 'weekly'
        if (!in_array($timeFrame, $validTimeFrames)) {
            $timeFrame = 'weekly';
        }

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
            default:
                $reportsQuery->where('created_at', '>=', now()->subWeek());
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

        // Fetch newest reports
        $newestReports = Report::orderBy('created_at', 'desc')->take(10)->get();

        // Fetch upvote and downvote counts for the newest reports
        $newestUpvoteCounts = ReportRating::select('laporan_id', DB::raw('COUNT(*) as upvote_count'))
            ->whereIn('laporan_id', $newestReports->pluck('id'))
            ->where('rating_type', 'up')
            ->groupBy('laporan_id')
            ->get()
            ->keyBy('laporan_id');

        $newestDownvoteCounts = ReportRating::select('laporan_id', DB::raw('COUNT(*) as downvote_count'))
            ->whereIn('laporan_id', $newestReports->pluck('id'))
            ->where('rating_type', 'down')
            ->groupBy('laporan_id')
            ->get()
            ->keyBy('laporan_id');

        foreach ($newestReports as $report) {
            $report->upvote_count = $newestUpvoteCounts->get($report->id)->upvote_count ?? 0;
            $report->downvote_count = $newestDownvoteCounts->get($report->id)->downvote_count ?? 0;
        }

        return view('forum', ['popularReports' => $popularReports, 'newestReports' => $newestReports, 'currentTimeFrame' => $timeFrame]);
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
        // Handle file upload
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/media', $fileName);
        } else {
            $filePath = null;
        }

        // Create the report
        $report = Report::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'media' => $filePath,
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
        $userId = Auth::id();

        // Check if the user has already rated this report
        $existingRating = ReportRating::where('laporan_id', $reportId)
            ->where('user_id', $userId)
            ->first();

        if ($existingRating) {
            // Redirect back with a message if the user has already rated the report
            return redirect()->back()->withErrors(['error' => 'You have already rated this report.']);
        }

        // Proceed to create a new rating if none exists
        $report = Report::findOrFail($reportId);

        $report->ratings()->create([
            'user_id' => $userId,
            'laporan_id' => $reportId,
            'rating_type' => $validatedData['rating_type'],
        ]);

        return redirect('forum')->with('success', 'Rating submitted successfully.');
    }
}
