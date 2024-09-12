<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Resources\ReportResource;
use App\Http\Resources\ReportCollection;
use Illuminate\Support\Facades\DB;


class ApiReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 10);

        // Validate page and size parameters
        if (!filter_var($page, FILTER_VALIDATE_INT) || !filter_var($size, FILTER_VALIDATE_INT)) {
            return response()->json(['message' => 'Invalid parameters'], 400);
        }

        // Start the query with relations loaded
        $reportsQuery = Report::with(['category', 'status'])
            ->select(
                'reports.*',
                DB::raw('COALESCE(SUM(CASE WHEN report_ratings.rating_type = "up" THEN 1 ELSE 0 END), 0) as up_rate'),
                DB::raw('COALESCE(SUM(CASE WHEN report_ratings.rating_type = "down" THEN 1 ELSE 0 END), 0) as down_rate')
            )
            ->leftJoin('report_ratings', 'reports.id', '=', 'report_ratings.laporan_id')
            ->groupBy('reports.id');

        // Filter by title if provided
        $title = $request->input('title');
        if ($title) {
            $reportsQuery->where('reports.title', 'like', '%' . $title . '%');
        }

        // Determine filter and apply ordering
        $filter = $request->input('filter');
        switch ($filter) {
            case 'category':
                $reportsQuery->orderBy('category_id');
                break;
            case 'up_rate':
                $reportsQuery->orderBy('up_rate');
                break;
            case 'down_rate':
                $reportsQuery->orderBy('down_rate');
                break;
            default:
                if ($filter) {
                    return response()->json(['message' => 'Invalid filter parameter'], 400);
                }
                break;
        }

        // Apply sorting order and paginate results
        $order = $request->input('order', 'asc');
        $reportsQuery->orderBy('reports.id', $order);

        $reports = $reportsQuery->paginate($size, ['*'], 'page', $page);

        // Return the response as JSON
        return response()->json(new ReportCollection($reports), 200);
    }



    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $report = Report::find($id);

        if (!$report) {
            throw new HttpResponseException(response()->json([
                'message' => 'Report not found'
            ])->setStatusCode(404));
        }

        return response()->json(new ReportResource($report), 200);
    }
}
