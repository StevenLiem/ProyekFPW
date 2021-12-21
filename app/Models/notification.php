<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class notification extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = "conn_proyek";
    protected $table = "notify";
    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'id_manga',
        'created_at',
        'update_at'
    ];

    // public function favorites(){
    //     return $this->belongsToMany(Manga::class, 'user_favorite', 'id_user', 'id_manga');
    // }
}
