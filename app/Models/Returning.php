<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returning extends Model
{
    use HasFactory;

    protected $table = 'returning';

    protected $fillable = [
        'assignment_id',
        'requested_by',
        'accepted_by',
        'returned_date',
        'state_key',
    ];

    public const WAITING_FOR_RETURNING = 0;
    public const COMPLETED = 1;


    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function acceptedBy()
    {
        return $this->belongsTo(User::class, 'accepted_by');
    }

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
}
