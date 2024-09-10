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


class ReportController extends Controller
{
    
    // Display a listing of the resource.
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


    public function postReportRating(StoreReportRatingRequest $request, $reportId){
    // Validasi input rating
    $validatedData = $request->validate();

    // Cari report berdasarkan ID
    $report = Report::findOrFail($reportId);

    // Simpan rating
    $report->ratings()->create([
        'user_id' => Auth::id(),
        'laporan_id' => $validatedData['laporan_id'],
        'rating' => $validatedData['rating'],
    ]);

    //view belum ada.
    return view ('Rating Success');
    }


    public function getNewestReports(){

    // Ambil laporan terbaru dengan urutan descending berdasarkan waktu pembuatan
    $reports = Report::orderBy('created_at', 'desc')->take(10)->get();

    return view ('reports.newest', ['reports' => $reports]); //Belum Fix
    
    }
}
