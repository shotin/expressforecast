<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatorGames extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function operatorData()
    {
        return $this->belongsTo(Operator::class, 'operator', 'operator_id');
    }

    public function getOperatorNameAttribute() {
        return $this->operatorData->operator_name;
    }
}
