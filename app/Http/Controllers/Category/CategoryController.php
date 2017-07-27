<?php
namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Modules\Category\Category;
use App\Modules\Category\CategoryTransformer;

class CategoryController extends Controller
{
    /**
     * Get list of categories
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return $this->response()->collection(Category::all(), new CategoryTransformer());
    }
}
