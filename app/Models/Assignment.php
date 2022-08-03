<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $table = 'assignment';
    protected $fillable = [
        'asset_id',
        'staff_id',
        'note',
        'assigned_date',
        'assigned_by',
        'state'
    ];
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
