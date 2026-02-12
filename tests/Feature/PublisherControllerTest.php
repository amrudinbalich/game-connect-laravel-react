<?php

use App\Models\Publisher;
use Inertia\Testing\AssertableInertia as Assert;

// list
test('Display a listing of the resource.', function () {
    $firstPublisher = Publisher::factory()->count(5)->create()->first();
    $response = $this->get('/publishers');

    $response->assertInertia(function (Assert $page) use ($firstPublisher) {
        $page
            // view component
            ->component('publisher/index')
            // passing data into component
            ->has('publishers', 5)
            ->where('publishers.0.id', $firstPublisher->id);
    });
});

// create form
test('Show the form for creating a new resource.', function () {
    $response = $this->get('/publishers/create');

    $response->assertInertia(
        fn (Assert $page) => $page->component('publisher/create')
    );
    $response->assertStatus(200);
});

// input validation
test('Input validation for store and update actions.', function () {

    $publisherResponse = $this->postJson('/publishers');

    // publisher
    $publisherResponse
        ->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors' => ['name', 'about', 'website_url'],
        ]);

    // update
    $publisherResponse = $this->postJson('/publishers');
    $publisherResponse
        ->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors' => ['name', 'about', 'website_url'],
        ]);

});

// store action
test('Store a newly created resource in storage.', function () {
    $payload = [
        'name' => 'My Company',
        'about' => 'Game publisher company developing video game software.',
        'website_url' => 'www.mycompany.com',
    ];

    $this->assertDatabaseCount('publishers', 0);

    $response = $this->post('/publishers', $payload);

    $this->assertDatabaseHas('publishers', ['id' => 1]);

    $response->assertStatus(201); // created
});

// specified
test('Display the specified resource.', function () {
    $publisher = Publisher::factory()->count(1)->create()->first();
    $response = $this->get("/publishers/{$publisher->id}");

    $response->assertInertia(
        fn (Assert $page) => $page->component('publisher/show')
            ->has('publisher')
            ->where('publisher.id', $publisher->id)
    );
});

// edit form
test('Show the form for editing the specified resource.', function () {
    $publisher = Publisher::factory()->create();
    $response = $this->get("/publishers/{$publisher->id}/edit");

    $response->assertInertia(
        fn (Assert $page) => $page->component('publisher/edit')
            ->has('publisher')
            ->where('publisher.id', $publisher->id)
    );
});

// edit action
test('Update the specified resource in storage.', function () {
    $payload = [
        'name' => 'Updated Company',
        'about' => 'Game publisher company developing video game software.',
        'website_url' => 'www.my-updated-company.com',
    ];

    $publisher = Publisher::factory()->create();

    // update
    $response = $this->put("/publishers/{$publisher->id}", $payload);

    $this->assertDatabaseHas('publishers', [
        'name' => $payload['name'],
    ]);

    $response->assertStatus(200);
    $response->assertJsonStructure(['name', 'about', 'website_url']);
});

// destroy
test('Remove the specified resource from storage.', function () {
    $publisher = Publisher::factory()->create();

    // has
    $this->assertDatabaseHas('publishers', [
        'id' => $publisher->id,
    ]);

    // response
    $response = $this->delete("/publishers/{$publisher->id}");
    $response->assertStatus(204);

    // is deleted
    $this->assertDatabaseMissing('publishers', [
        'id' => $publisher->id,
    ]);
});
