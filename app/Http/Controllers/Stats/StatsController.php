<?php
namespace App\Http\Controllers\Stats;

use App\Http\Controllers\Controller;

use App\Modules\Statistics\Statistics;
use App\Modules\Statistics\StatisticsTransformer;

class StatsController extends Controller
{
    /**
     * Get list of genres
     *
     * @param Statistics $statistics
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Statistics $statistics)
    {
        return $this->response()->item($statistics, new StatisticsTransformer());
    }
}
