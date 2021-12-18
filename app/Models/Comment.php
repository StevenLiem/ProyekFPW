<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $connection = "conn_proyek";
    protected $table = "comment";
    protected $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'id_manga',
        'content'
    ];

    public function owner(){
        return $this->belongsTo(Users::class, 'id_user');
    }
}
