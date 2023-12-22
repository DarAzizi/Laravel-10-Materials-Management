<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipmentCode extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['Name', 'Description', 'Drawing', 'jet_position_id'];

    protected $searchableFields = ['*'];

    protected $table = 'equipment_codes';

    public function jetPosition()
    {
        return $this->belongsTo(JetPosition::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}
