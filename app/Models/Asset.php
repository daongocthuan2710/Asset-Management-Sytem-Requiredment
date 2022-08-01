<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'asset';
    protected $fillable = [
        'asset_code',
        'name',
        'category_id',
        'specification',
        'installed_date',
        'state',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
