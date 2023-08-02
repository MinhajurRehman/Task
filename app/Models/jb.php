<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jb extends Model
{
    use HasFactory;
    protected $table = 'jobs';
    protected $primarykey = 'id';
}
