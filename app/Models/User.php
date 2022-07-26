<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    public $timestamps = false;
    protected $table = 'user';
    protected $id_user = 'SD';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'password',
        'state'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function scopeSearch($query,$request){
        return $query
        ->when($request->has('search'), function ($query) use ($request) {
            $search = $request->query('search');
            $query
                ->where("first_name", "LIKE", "%{$search}%")
                ->orWhere("staff_code", "LIKE", "%{$search}%");
        });
    }

    public function scopeFilter($querry,$request){
        return $querry
        ->when($request->has('filter'), function ($query) use ($request) {
            $filter = $request->query('filter');
            $query
                ->where("admin", "=", $filter);
        });
    }
    public function scopeSortByFullname($query, $request){
        return $query
        ->when($request->has('sortByFullName'), function ($query) use ($request) {
            $sortByFullName = $request->query('sortByFullName');
            $query
                ->orderBy("first_name", $sortByFullName);
        });
    }

    public function scopeSortByStaffCode($querry, $request){
        return $querry
        ->when($request->has('sortByStaffCode'), function ($query) use ($request) {
            $sortByStaffCode = $request->query('sortByStaffCode');
            $query
                ->orderBy("staff_code", $sortByStaffCode);
        });
    }

    public function scopeSortByJoinedDate($querry, $request){
        return $querry
        ->when($request->has('sortByJoinedDate'), function ($query) use ($request) {
            $sortByJoinedDate = $request->query('sortByJoinedDate');
            $query
                ->orderBy("created_at", $sortByJoinedDate);
        });
    }

    public function scopeSortByType($querry, $request){
        return $querry
        ->when($request->has('sortByType'), function ($query) use ($request) {
            $sortByType = $request->query('sortByType');
            $query
                ->orderBy("admin", $sortByType);
        });    
    }
}
