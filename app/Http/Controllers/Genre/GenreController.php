<?php
namespace App\Http\Controllers\Genre;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Modules\Genre\Genre;
use App\Modules\Genre\GenreTransformer;

class GenreController extends Controller
{
    /**
     * Get list of genres
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return $this->response()->collection(Genre::all(), new GenreTransformer());
    }
}
