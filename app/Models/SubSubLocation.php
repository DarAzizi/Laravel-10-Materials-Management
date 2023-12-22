<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubSubLocation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['Name', 'sub_location_id'];

    protected $searchableFields = ['*'];

    protected $table = 'sub_sub_locations';

    public function subSubSubLocations()
    {
        return $this->hasMany(SubSubSubLocation::class);
    }

    public function subLocation()
    {
        return $this->belongsTo(SubLocation::class);
    }
}
