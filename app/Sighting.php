<?php

namespace App;

use App\Tag;
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
     * The tags that belong to the sighting.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Extending the create function in order to take Lat / Long and put it into a Point field in the db
     */
    public static function create(array $attributes = [])
    {
        $attributes['position'] = new Point($attributes['latitude'], $attributes['longitude']); 

        $model = static::query()->create($attributes);

        if (isset($attributes['tags'])) {
            $tags = explode(',', $attributes['tags']);
            foreach ($tags as $tag) {
                $newtag = Tag::firstOrCreate(['tag_text' => $tag]);
                $model->tags()->attach($newtag);
            }
        }

        return $model;
    }

    /**
     * Extending the update function in order to take Lat / Long and put it into a Point field in the db
     */
    public function update(array $attributes = [], array $options = [])
    {
        if (isset($attributes['latitude']) && isset($attributes['longitude'])) {
            $attributes['position'] = new Point($attributes['latitude'], $attributes['longitude']); 
        }
        $this->fill($attributes)->save();

        if (isset($attributes['tags'])) {
            $this->tags()->detach();
            $tags = explode(',', $attributes['tags']);
            foreach ($tags as $tag) {
                $newtag = Tag::firstOrCreate(['tag_text' => $tag]);
                $this->tags()->attach($newtag);
            }
        }

        return true;
    }


}