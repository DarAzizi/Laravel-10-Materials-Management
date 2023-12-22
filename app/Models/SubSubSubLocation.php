<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubSubSubLocation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['Name', 'sub_sub_location_id'];

    protected $searchableFields = ['*'];

    protected $table = 'sub_sub_sub_locations';

    public function subSubLocation()
    {
        return $this->belongsTo(SubSubLocation::class);
    }
}
