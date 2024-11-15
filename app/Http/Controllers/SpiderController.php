<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Spider;
use App\Http\Requests\StoreSpiderRequest;
use App\Http\Requests\UpdateSpiderRequest;

class SpiderController extends Controller
{
    public function index()
    {
        $spiders = Spider::with('user')->paginate(10);
        return response()->json([
            'success' => true,
            'data' => $spiders
        ]);
    }

    public function store(StoreSpiderRequest $request)
    {
        $spider = Spider::create($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Spider created successfully',
            'data' => $spider
        ], 201);
    }

    public function show(Spider $spider)
    {
        return response()->json([
            'success' => true,
            'data' => $spider->load('user')
        ]);
    }

    public function update(UpdateSpiderRequest $request, Spider $spider)
    {
        $spider->update($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Spider updated successfully',
            'data' => $spider
        ]);
    }

    public function destroy(Spider $spider)
    {
        $spider->delete();
        return response()->json([
            'success' => true,
            'message' => 'Spider deleted successfully'
        ]);
    }
}