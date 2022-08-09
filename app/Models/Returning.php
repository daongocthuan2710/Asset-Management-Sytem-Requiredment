<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returning extends Model
{
    use HasFactory;
    protected $table = 'returning';

    public const WAITING_FOR_RETURNING = 0;
    public const COMPLETED = 1;

    protected $fillable = ['state','returned_date'];

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
