<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'winning_num' => 'array',
        'machine_num' => 'array'
    ];

    public function gamedetails(){
        return $this->belongsTo(OperatorGames::class, 'game_id', 'game_id');
    }

    
    public function operatordetails() {
        return $this->belongsTo(Operator::class, 'operator', 'operator_id');
    }
}
