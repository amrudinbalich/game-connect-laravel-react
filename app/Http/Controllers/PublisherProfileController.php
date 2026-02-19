<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublisherProfileRequest;
use App\Http\Requests\UpdatePublisherProfileRequest;
use App\Http\Resources\PublisherProfileCollection;
use App\Http\Resources\PublisherProfileResource;
use App\Models\PublisherProfile;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PublisherProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): InertiaResponse
    {
        $resource = new PublisherProfileCollection(PublisherProfile::all());

        return Inertia::render('publisher/index', [
            'publishers' => $resource,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): InertiaResponse
    {
        return Inertia::render('publisher/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePublisherProfileRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = 1;

        PublisherProfile::create($validated);

        return response()->json([
            'message' => 'Created',
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(PublisherProfile $publisherProfile): InertiaResponse
    {
        return Inertia::render('publisher/show', [
            'publisher' => new PublisherProfileResource($publisherProfile),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PublisherProfile $publisherProfile): InertiaResponse
    {
        return Inertia::render('publisher/edit', [
            'publisher' => new PublisherProfileResource($publisherProfile),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePublisherProfileRequest $request, PublisherProfile $publisherProfile): JsonResponse
    {
        $validated = $request->validated();
        $publisherProfile->update($validated);

        return response()->json($publisherProfile, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PublisherProfile $publisherProfile): Response
    {
        $publisherProfile->delete();

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
