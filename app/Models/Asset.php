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

    public function scopeSearch($query, $request)
    {
        return $query
            ->when($request->has('search'), function ($query) use ($request) {
                $search = $request->query('search');
                $query
                    ->where("asset_code", "ilike", "%{$search}%")
                    ->orWhere("name", "ilike", "%{$search}%");
            });
    }

    public function scopeFilterByCategory($query, $request)
    {
        $filterByCategory = explode(',', $request->query('filterByCategory'));
        if (in_array(3, $filterByCategory)) {
            return $query;
        }
        return $query
            ->when($request->has('filterByCategory'), function ($query) use ($filterByCategory) {
                foreach ($filterByCategory as $key => $value) {
                    if ($key === 0) {
                        $query->where("category_id", "=", $value);
                    }
                    $query->orWhere("category_id", "=", $value);
                }
            });
    }

    public function scopeFilterByState($query, $request)
    {
        $filterByState = explode(',', $request->query('filterByState'));
        if (in_array(3, $filterByState)) {
            return $query;
        }
        return $query
            ->when($request->has('filterByState'), function ($query) use ($filterByState) {
                foreach ($filterByState as $key => $value) {
                    if ($key === 0) {
                        $query->where("state", "=", $value);
                    }
                    $query->orWhere("state", "=", $value);
                }
            });
    }

    public function scopeSortByAssetCode($query, $request)
    {
        return $query
            ->when($request->has('sortByAssetCode'), function ($query) use ($request) {
                $sortByAssetCode = $request->query('sortByAssetCode');
                $query
                    ->orderBy("asset_code", $sortByAssetCode);
            });
    }

    public function scopeSortByCategory($query, $request)
    {
        return $query
            ->when($request->has('sortByCategory'), function ($query) use ($request) {
                $sortByCategory = $request->query('sortByCategory');
                $query
                    ->orderBy("category_id", $sortByCategory);
            });
    }

    public function scopeSortByName($query, $request)
    {
        return $query
            ->when($request->has('sortByName'), function ($query) use ($request) {
                $sortByName = $request->query('sortByName');
                $query
                    ->orderBy("name", $sortByName);
            });
    }

    public function scopeSortByState($query, $request)
    {
        return $query
            ->when($request->has('sortByState'), function ($query) use ($request) {
                $sortByState = $request->query('sortByState');
                $query
                    ->orderBy("state", $sortByState);
            });
    }

    public function scopeSortByEditAsset($querry, $request)
    {
        return $querry
            ->when($request->has('sortByEditAsset'), function ($query) use ($request) {
                $query
                    ->orderBy("updated_at", 'desc');
            });
    }

    public function scopeSortByCreateAsset($querry, $request)
    {
        return $querry
            ->when($request->has('sortByCreateAsset'), function ($query) use ($request) {
                $query
                    ->orderBy("created_at", 'desc');
            });
    }
}
