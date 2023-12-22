<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JetPosition extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['Position', 'Description', 'jet_id'];

    protected $searchableFields = ['*'];

    protected $table = 'jet_positions';

    public function jet()
    {
        return $this->belongsTo(Jet::class);
    }

    public function equipmentCodes()
    {
        return $this->hasMany(EquipmentCode::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}
