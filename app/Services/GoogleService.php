<?php

declare(strict_types=1);

namespace App\Services;

use Google\Client;
use Google\Service\CustomSearchAPI;
use Google\Service\CustomSearchAPI\Search;
use Illuminate\Support\Facades\Log;

class GoogleService
{
    /**
     * Custom Search API.
     *
     * @param string|null $keyword
     * @param string|null $searchType
     * @param integer $limit
     * @return Search
     */
    public function customSearch(string $keyword, ?string $searchType=null, int $limit=10, int $start=1): Search
    {
        $client = new Client();
        $client->setApplicationName(config('app.name'));
        $client->setDeveloperKey(config('services.google.custom_search_api_key'));

        $service = new CustomSearchAPI($client);

        return $service->cse->listCse([
            'q' => $keyword,
            'searchType' => $searchType,
            'cx' => config('services.google.search_engine_id'),
            'num' => $limit,
            'start' => $start,
        ]);
    }
}
