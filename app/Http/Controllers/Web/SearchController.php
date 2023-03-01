<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SearchRequest;
use App\Services\GoogleService;
use Exception;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    private $googleService;

    public function __construct(GoogleService $googleService)
    {
        $this->googleService = $googleService;
    }

    public function index(SearchRequest $request)
    {
        try {
            if ($request->keyword) {
                $res = $this->googleService->customSearch($request->keyword, $request->search_type, $request->limit, (int) $request->start ?? 1);
            } else {
                $res = collect();
            }
        } catch (Exception $e) {
            Log::error($e);

            return view('errors.500');
        }

        return view('search.list', compact('res'));
    }
}
