<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['Name', 'Description'];

    protected $searchableFields = ['*'];

    public function subLocations()
    {
        return $this->hasMany(SubLocation::class);
    }
}
