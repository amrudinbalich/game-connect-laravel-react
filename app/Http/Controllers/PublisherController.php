<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\PublisherCollection;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @see \Tests\Feature\PublisherControllerTest
     */
    public function index(): InertiaResponse
    {
        $resource = new PublisherCollection(Publisher::all());

        return Inertia::render('publisher/index', [
            'publishers' => $resource,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        //
    }
}
