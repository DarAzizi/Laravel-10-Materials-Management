<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['Name', 'category_id'];

    protected $searchableFields = ['*'];

    protected $table = 'sub_categories';

    public function subSubCategories()
    {
        return $this->hasMany(SubSubCategory::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
