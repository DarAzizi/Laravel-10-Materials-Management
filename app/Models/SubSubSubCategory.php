<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubSubSubCategory extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['Name', 'sub_sub_category_id'];

    protected $searchableFields = ['*'];

    protected $table = 'sub_sub_sub_categories';

    public function subSubCategory()
    {
        return $this->belongsTo(SubSubCategory::class);
    }
}
