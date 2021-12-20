<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $connection = "conn_proyek";
    protected $table = "genre";
    protected $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function mangas(){
        return $this->belongsToMany(Manga::class, 'manga_genre', 'id_manga', 'id_genre');
    }
}
