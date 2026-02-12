<?php

namespace App\Models;

use App\Http\Resources\PublisherCollection;
use App\Http\Resources\PublisherResource;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Database\Eloquent\Attributes\UseResourceCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[UseResource(PublisherResource::class)]
#[UseResourceCollection(PublisherCollection::class)]
class Publisher extends Model
{
    /** @use HasFactory<\Database\Factories\PublisherFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'about',
        'website_url',
    ];
}
