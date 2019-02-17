<?php

namespace App;

use App\Sighting;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag_text', 
    ];

    public $timestamps = false;

   /**
     * The tags that belong to the sighting.
     */
    public function sightings()
    {
        return $this->belongsToMany(Sighting::class);
    }
}