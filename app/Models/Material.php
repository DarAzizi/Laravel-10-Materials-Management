<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'Name',
        'ItemCode',
        'Description',
        'Quantity',
        'equipment_code_id',
        'jet_position_id',
        'nature_id',
    ];

    protected $searchableFields = ['*'];

    public function equipmentCode()
    {
        return $this->belongsTo(EquipmentCode::class);
    }

    public function jetPosition()
    {
        return $this->belongsTo(JetPosition::class);
    }

    public function nature()
    {
        return $this->belongsTo(Nature::class);
    }
}
