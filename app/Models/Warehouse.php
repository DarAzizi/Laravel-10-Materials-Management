<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warehouse extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'Name',
        'Description',
        'project_id',
        'user_id',
        'Address',
        'email',
    ];

    protected $searchableFields = ['*'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
