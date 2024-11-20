<?php

namespace App\Http\Controllers;

use App\Models\Spider;
use Illuminate\Http\Request;
use App\Helpers\ImgBBHelper;
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
        $spiders = Spider::where('user_id', $request->user()->id)->get();
        return response()->json($spiders, 200);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'spiderSpecies' => 'required|string',
            'spiderHealthStatus' => 'required|string',
            'spiderBuyCost' => 'required|numeric',
            'spiderSellPrice' => 'required|numeric',
            'spiderQuantity' => 'required|integer',
            'spiderImageRef' => 'required|image|mimes:jpeg,png,jpg,svg|max:512',
        ]);

        if ($request->hasFile('spiderImageRef')) {
            $uploadedUrl = ImgBBHelper::uploadToImgBB($request->file('spiderImageRef'), $this->imgBBApiKey);
            if ($uploadedUrl) {
                $fields['spiderImageRef'] = $uploadedUrl;
            }
        }

        try {
            $spider = $request->user()->spiders()->create($fields);
            // Create a notification for successful storage
            $request->user()->notifications()->create([
                'spider_id' => $spider->id,
                'notifName' => 'Spider Added',
                'notifContent' => "$spider->spiderSpecies has been successfully stored.",
                'notifType' => 'Creation',
            ]);
            return response()->json($spider, 200);
        } catch (\Exception $e) {
            // Create a notification for failed storage
            $request->user()->notifications()->create([
                'notifName' => 'Spider Storage Failed',
                'notifContent' => 'Failed to store the spider.',
                'notifType' => 'error',
            ]);
            return response()->json(['message' => 'Failed to store spider'], 500);
        }
    }

    public function show(Request $request, Spider $spider)
    {
        Gate::authorize('access', $spider);

        $user = $request->user();
        if ($user->id !== $spider->user_id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json($spider, 200);
    }

    public function update(Request $request, Spider $spider)
    {
        Gate::authorize('access', $spider);

        $fields = $request->validate([
            'spiderSpecies' => 'sometimes|string',
            'spiderHealthStatus' => 'sometimes|string',
            'spiderBuyCost' => 'sometimes|numeric',
            'spiderSellPrice' => 'sometimes|numeric',
            'spiderQuantity' => 'sometimes|integer',
            'spiderImageRef' => 'sometimes|image|mimes:jpeg,png,jpg,svg|max:512'
        ]);

        if ($request->hasFile('spiderImageRef')) {
            $uploadedUrl = ImgBBHelper::uploadToImgBB($request->file('spiderImageRef'), $this->imgBBApiKey);
            if ($uploadedUrl) {
                $fields['spiderImageRef'] = $uploadedUrl;
            }
        }

        try {
            $spider->update($fields);
            // Create a notification for successful update
            $request->user()->notifications()->create([
                'spider_id' => $spider->id,
                'notifName' => 'Spider Updated',
                'notifContent' => "$spider->spiderSpecies has been successfully updated.",
                'notifType' => 'Update',
            ]);
            return response()->json($spider, 200);
        } catch (\Exception $e) {
            // Create a notification for failed update
            $request->user()->notifications()->create([
                'notifName' => 'Spider Update Failed',
                'notifContent' => 'Failed to update the spider.',
                'notifType' => 'error',
            ]);
            return response()->json(['message' => 'Failed to update spider'], 500);
        }
    }

    public function destroy(Request $request, Spider $spider)
    {
        Gate::authorize('access', $spider);

        try {
            $spiderSpecies = $spider->spiderSpecies;
            $spiderId = $spider->id;
            $spider->delete();
            // Create a notification for successful deletion
            $request->user()->notifications()->create([
                'spider_id' => $spiderId,
                'notifName' => 'Spider Deleted',
                'notifContent' => "$spiderSpecies has been successfully deleted.",
                'notifType' => 'Deletion'
            ]);
            return response()->json(['message' => "$spiderSpecies deleted successfully"], 200);
        } catch (\Exception $e) {
            // Create a notification for failed deletion
            $request->user()->notifications()->create([
                'notifName' => 'Spider Deletion Failed',
                'notifContent' => 'Failed to delete the spider.',
                'notifType' => 'error',
            ]);
            return response()->json(['message' => 'Failed to delete spider'], 500);
        }
    }
}
