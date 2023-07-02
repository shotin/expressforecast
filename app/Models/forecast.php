<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class forecast extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'option_a' => 'array',
        'option_b' => 'array',
        'option_c' => 'array'
    ];

    public function gamedetails() {
        return $this->belongsTo(OperatorGames::class, 'game_id', 'game_id');
    }

    public function operatordetails() {
        return $this->belongsTo(Operator::class, 'operator', 'operator_id');
    }
    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }
}
