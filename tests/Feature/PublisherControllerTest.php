<?php

use App\Models\Publisher;
use Inertia\Testing\AssertableInertia as Assert;

/** @covers \App\Http\Controllers\PublisherController::index */
test('Publisher page shows publishers list.', function () {
    $firstPublisher = Publisher::factory()->count(5)->create()->first();
    $response = $this->get(uri: '/publishers');

    $response->assertInertia(function (Assert $page) use ($firstPublisher) {
        $page
            // view component
            ->component('publisher/index')
            // passing data into component
            ->has('publishers', 5)
            ->where('publishers.0.id', $firstPublisher->id)
            ->where('publishers.0.name', $firstPublisher->name)
            ->where('publishers.0.about', $firstPublisher->about)
            ->where('publishers.0.website_url', $firstPublisher->website_url);
    });
});
