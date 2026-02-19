<?php

use App\Models\Publisher;
use App\Models\PublisherProfile;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

const TABLE_NAME = 'publisher_profiles';

// list
test('Display a listing of the resource.', function () {
    $firstPublisher = PublisherProfile::factory()->count(5)->create()->first();
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
    $required = ['company_name', 'summary', 'website_url'];
    $publisherResponse = $this->postJson('/publishers');

    // publisher
    $publisherResponse
        ->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors' => $required,
        ]);

    // update
    $publisherResponse = $this->postJson('/publishers');
    $publisherResponse
        ->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors' => $required,
        ]);

});

// store action
test('Store a newly created resource in storage.', function () {
    $payload = [
        'company_name' => 'My Company',
        'summary' => 'Game publisher company developing video game software.',
        'website_url' => 'www.mycompany.com'
    ];

    $this->assertDatabaseCount('publisher_profiles', 0);

    $response = $this->post('/publishers', $payload);

    // dd(PublisherProfile::all());

    $this->assertDatabaseHas('publisher_profiles', $payload);
    // $this->assertDatabaseHas('users', ['id' => $payload['user_id']]);

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
        'company_name' => 'Updated Company',
        'summary' => 'Game publisher company developing video game software.',
        'website_url' => 'www.my-updated-company.com',
    ];

    $publisher = Publisher::factory()->create();

    // update
    $response = $this->put("/publishers/{$publisher->id}", $payload);

    $this->assertDatabaseHas(TABLE_NAME, [
        'company_name' => $payload['name'],
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
