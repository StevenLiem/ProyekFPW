<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $connection = "conn_proyek";
    protected $table = "author";
    protected $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function mangas()
    {
        return $this->hasMany(Manga::class, 'id_artist');
    }
}
