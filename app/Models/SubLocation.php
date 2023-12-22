<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubLocation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['Name', 'location_id'];

    protected $searchableFields = ['*'];

    protected $table = 'sub_locations';

    public function subSubLocations()
    {
        return $this->hasMany(SubSubLocation::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
