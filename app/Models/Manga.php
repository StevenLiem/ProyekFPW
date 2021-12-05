<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manga extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = "conn_proyek";
    protected $table = "manga";
    protected $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'title',
        'id_author',
        'id_artist',
        'synopsis',
        'path'
    ];

    public function author(){
        return $this->belongsTo(Author::class, 'id_author');
    }

    public function artist(){
        return $this->belongsTo(Artist::class, 'id_artist');
    }

    public function genres(){
        return $this->belongsToMany(Genre::class, 'manga_genre', 'id_manga', 'id_genre');
    }
}
