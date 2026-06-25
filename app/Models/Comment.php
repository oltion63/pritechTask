<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use hasFactory;

    protected $table = 'comments';
    protected $fillable = [
        'issue_id',
        'author_id',
        'body',
    ];

    public function issue(){
        return $this->belongsTo(Issue::class);
    }
}
