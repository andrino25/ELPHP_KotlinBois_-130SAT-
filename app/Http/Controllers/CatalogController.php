<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;
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

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'catalogName' => 'required|string|max:255',
            'catalogDescription' => 'nullable|string',
            'catalogImageRef' => 'nullable|string',
        ]);

        $catalog = Catalog::create($validated);
        return response()->json($catalog, 201);
    }

    public function update(Request $request, Catalog $catalog): JsonResponse
    {
        $validated = $request->validate([
            'catalogName' => 'sometimes|required|string|max:255',
            'catalogDescription' => 'nullable|string',
            'catalogImageRef' => 'nullable|string',
        ]);

        $catalog->update($validated);
        return response()->json($catalog);
    }

    public function destroy(Catalog $catalog): JsonResponse
    {
        $catalog->delete();
        return response()->json(['message' => 'Catalog deleted successfully.']);
    }
}
