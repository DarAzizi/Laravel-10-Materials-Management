<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubSubCategory extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['Name', 'sub_category_id'];

    protected $searchableFields = ['*'];

    protected $table = 'sub_sub_categories';

    public function subSubSubCategories()
    {
        return $this->hasMany(SubSubSubCategory::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
