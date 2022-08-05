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

    public function assigned_by()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function staff_id()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function scopeSearch($query, $request)
    {
        return $query
            ->when($request->has('search'), function ($query) use ($request) {
                $search = $request->query('search');
                $query
                    ->whereRelation("asset", "asset_code", "ilike", "%{$search}%")
                    ->orWhereRelation("asset", "name", "ilike", "%{$search}%")
                    ->orWhereRelation("staff_id", "username", "ilike", "%{$search}%");
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
                $query->whereIn("state", $filterByState);
            });
    }

    public function scopeFilterByDate($query, $request)
    {
        $filterByDate = $request->query('filterByDate');
        return $query
            ->when($request->has('filterByDate'), function ($query) use ($filterByDate) {
                $query->where("assigned_date", $filterByDate);
            });
    }

    public function scopeSortByNo($query, $request)
    {
        return $query
            ->when($request->has('sortByNo'), function ($query) use ($request) {
                $sortByNo = $request->query('sortByNo');
                $query
                    ->orderBy("id", $sortByNo);
            });
    }

    public function scopeSortByAssetCode($query, $request)
    {
        return $query
            ->when($request->has('sortByAssetCode'), function ($query) use ($request) {
                $sortByAssetCode = $request->query('sortByAssetCode');
                $query
                    ->with('asset')
                    ->orderBy(
                        Asset::select('asset_code')->whereColumn('asset.id', 'assignment.asset_id'),
                        $sortByAssetCode
                    );
            });
    }

    public function scopeSortByAssetName($query, $request)
    {
        return $query
            ->when($request->has('sortByAssetName'), function ($query) use ($request) {
                $sortByAssetName = $request->query('sortByAssetName');
                $query
                    ->with('asset')
                    ->orderBy(
                        Asset::select('name')->whereColumn('asset.id', 'assignment.asset_id'),
                        $sortByAssetName
                    );
            });
    }

    public function scopeSortByAssignedTo($query, $request)
    {
        return $query
            ->when($request->has('sortByAssignedTo'), function ($query) use ($request) {
                $sortByAssignedTo = $request->query('sortByAssignedTo');
                $query
                    ->with('staff_id')
                    ->orderBy(
                        User::select('username')->whereColumn('user.id', 'assignment.staff_id'),
                        $sortByAssignedTo
                    );
            });
    }

    public function scopeSortByAssignedBy($query, $request)
    {
        return $query
            ->when($request->has('sortByAssignedBy'), function ($query) use ($request) {
                $sortByAssignedBy = $request->query('sortByAssignedBy');
                $query
                    ->with('assigned_by')
                    ->orderBy(
                        User::select('username')->whereColumn('user.id', 'assignment.assigned_by'),
                        $sortByAssignedBy
                    );
            });
    }

    public function scopeSortByAssignedDate($query, $request)
    {
        return $query
            ->when($request->has('sortByAssignedDate'), function ($query) use ($request) {
                $sortByAssignedDate = $request->query('sortByAssignedDate');
                $query->orderBy("assigned_date", $sortByAssignedDate);
            });
    }

    public function scopeSortByAssignedState($query, $request)
    {
        return $query
            ->when($request->has('sortByState'), function ($query) use ($request) {
                $sortByState = $request->query('sortByState');
                $query->orderBy("state", $sortByState);
            });
    }
    public function scopeLocation($query, $location)
    {
        $users = User::where('location', $location)->pluck('id');
        return $query->whereIn('staff_id', $users);
    }
}
