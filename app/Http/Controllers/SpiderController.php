<?php

namespace App\Http\Controllers;

use App\Models\Spider;
use Illuminate\Http\Request;
use App\Helpers\ImgBBHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Gate;

class SpiderController extends Controller implements HasMiddleware
{
    private $imgBBApiKey = '850208925c2606494ecd65c4b368ad04';

    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum')
        ];
    }

    public function index(Request $request)
    {
        try {
            $spiders = Spider::where('userId', $request->user()->id)->get();
            return response()->json($spiders, 200);
        } catch (\Exception $e) {
            Log::error('Spider index error: ' . $e->getMessage());
            return response()->json(['message' => 'Error fetching spiders'], 500);
        }
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'spiderName' => 'required|string',
            'spiderHealthStatus' => 'required|string',
            'spiderSize' => 'required|string',
            'spiderEstimatedMarketValue' => 'required|numeric',
            'spiderDescription' => 'required|string',
            'spiderImageRef' => 'required|image|mimes:jpeg,png,jpg,svg|max:512',
        ]);

        if ($request->hasFile('spiderImageRef')) {
            $uploadedUrl = ImgBBHelper::uploadToImgBB($request->file('spiderImageRef'), $this->imgBBApiKey);
            if ($uploadedUrl) {
                $fields['spiderImageRef'] = $uploadedUrl;
            }
        }

        try {
            $spider = Spider::create([
                'userId' => $request->user()->id,
                'spiderName' => $fields['spiderName'],
                'spiderHealthStatus' => $fields['spiderHealthStatus'],
                'spiderSize' => $fields['spiderSize'],
                'spiderEstimatedMarketValue' => $fields['spiderEstimatedMarketValue'],
                'spiderDescription' => $fields['spiderDescription'],
                'spiderImageRef' => $fields['spiderImageRef'],
            ]);

            // Create success notification with spider_id
            $request->user()->notifications()->create([
                'spider_id' => $spider->spiderId,
                'notifName' => 'Spider Added',
                'notifContent' => "$spider->spiderName has been successfully stored.",
                'notifType' => 'Creation'
            ]);

            return response()->json($spider, 201);
        } catch (\Exception $e) {
            // Create error notification without spider_id
            $request->user()->notifications()->create([
                'notifName' => 'Spider Storage Failed',
                'notifContent' => 'Failed to store the spider.',
                'notifType' => 'error'
            ]);

            Log::error('Spider store error: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to store spider'], 500);
        }
    }

    public function show(Request $request, Spider $spider)
    {
        Gate::authorize('access', $spider);

        return response()->json($spider, 200);
    }

    public function update(Request $request, Spider $spider)
    {
        Gate::authorize('access', $spider);

        try {
            // Log incoming content type for debugging
            Log::info('Content-Type:', ['type' => $request->header('Content-Type')]);
            Log::info('Request data:', $request->all());

            // Validate based on content type
            if ($request->hasFile('spiderImageRef')) {
                // Form-data validation
                $fields = $request->validate([
                    'spiderName' => 'sometimes|string',
                    'spiderHealthStatus' => 'sometimes|string',
                    'spiderSize' => 'sometimes|string',
                    'spiderEstimatedMarketValue' => 'sometimes|numeric',
                    'spiderDescription' => 'sometimes|string',
                    'spiderImageRef' => 'sometimes|image|mimes:jpeg,png,jpg,svg|max:512'
                ]);

                // Handle image upload
                $uploadedUrl = ImgBBHelper::uploadToImgBB($request->file('spiderImageRef'), $this->imgBBApiKey);
                if ($uploadedUrl) {
                    $fields['spiderImageRef'] = $uploadedUrl;
                }
            } else {
                // JSON data validation
                $fields = $request->validate([
                    'spiderName' => 'sometimes|string',
                    'spiderHealthStatus' => 'sometimes|string',
                    'spiderSize' => 'sometimes|string',
                    'spiderEstimatedMarketValue' => 'sometimes|numeric',
                    'spiderDescription' => 'sometimes|string',
                    'spiderImageRef' => 'sometimes|string'  // Changed to string for JSON updates
                ]);
            }

            // Convert spiderEstimatedMarketValue to numeric if present
            if (isset($fields['spiderEstimatedMarketValue'])) {
                $fields['spiderEstimatedMarketValue'] = floatval($fields['spiderEstimatedMarketValue']);
            }

            // Update fields
            foreach ($fields as $key => $value) {
                if ($value !== null) {  // Only update non-null values
                    $spider->{$key} = $value;
                }
            }
            
            $spider->save();
            
            // Create success notification
            $request->user()->notifications()->create([
                'spider_id' => $spider->spiderId,
                'notifName' => 'Spider Updated',
                'notifContent' => "{$spider->spiderName} has been successfully updated.",
                'notifType' => 'Update'
            ]);

            return response()->json($spider->fresh(), 200);
        } catch (\Exception $e) {
            Log::error('Spider update error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            // Create error notification
            $request->user()->notifications()->create([
                'notifName' => 'Spider Update Failed',
                'notifContent' => 'Failed to update the spider.',
                'notifType' => 'Error'
            ]);

            return response()->json([
                'message' => 'Failed to update spider',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request, Spider $spider)
    {
        Gate::authorize('access', $spider);

        try {
            $spiderName = $spider->spiderName;
            $spiderId = $spider->spiderId;

            $request->user()->notifications()->create([
                'spider_id' => $spiderId,
                'notifName' => 'Spider Deleted',
                'notifContent' => "{$spiderName} has been successfully deleted.",
                'notifType' => 'Deletion'
            ]);

            $spider->delete();

            return response()->json(['message' => "{$spiderName} deleted successfully"], 200);
        } catch (\Exception $e) {
            Log::error('Spider deletion error: ' . $e->getMessage());
            
            $request->user()->notifications()->create([
                'notifName' => 'Spider Deletion Failed',
                'notifContent' => 'Failed to delete the spider.',
                'notifType' => 'Error'  // Capitalized for consistency
            ]);

            return response()->json(['message' => 'Failed to delete spider'], 500);
        }
    }
}
