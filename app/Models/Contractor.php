<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contractor extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['Name', 'Image', 'Description'];

    protected $searchableFields = ['*'];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
