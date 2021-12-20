<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasFactory;

    protected $connection = "conn_proyek";
    protected $table = "users";
    protected $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'email',
        'status',
        'role'
    ];

    public function favorites(){
        return $this->belongsToMany(Manga::class, 'user_favorite', 'id_user', 'id_manga');
    }
}
