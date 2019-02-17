<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Sighting extends Model
{

    use SpatialTrait;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 
        'position', 
        'sighted_at'
    ];

    /**
     * The attributes that are spatial fields.
     *
     * @var array
     */
    protected $spatialFields = [
        'position'
    ];

    /**
     * Extending the create function in order to take Lat / Long and put it into a Point field in the db
     */
    public static function create(array $attributes = [])
    {
        $attributes['position'] = new Point($attributes['latitude'], $attributes['longitude']); 

        $model = static::query()->create($attributes);
        return $model;
    }
}