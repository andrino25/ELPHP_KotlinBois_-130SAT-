<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\JsonResponse;

class CatalogController extends Controller
{
    public function index(): JsonResponse
    {
        $catalogs = Catalog::all();
        return response()->json($catalogs);
    }

    public function show(Catalog $catalog): JsonResponse
    {
        return response()->json($catalog);
    }
}
