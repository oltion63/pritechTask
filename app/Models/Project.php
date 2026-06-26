<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'deadline',
    ];

    public function issues(){
        return $this->hasMany(Issue::class);
    }
}


