<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['Name', 'Description', 'city_id', 'contractor_id'];

    protected $searchableFields = ['*'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function contractor()
    {
        return $this->belongsTo(Contractor::class);
    }

    public function warehouses()
    {
        return $this->hasMany(Warehouse::class);
    }
}
