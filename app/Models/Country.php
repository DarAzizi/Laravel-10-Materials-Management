<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['Name', 'Image'];

    protected $searchableFields = ['*'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
