<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRatingRequest;
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

        return view('reports.popular', ['reports' => $reports]); // later modify the view
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
