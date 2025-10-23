<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uppgift extends Model {
    use HasFactory;

    protected $fillable=['id', 'text', 'done'];

    protected $table = 'todos';

    protected $primaryKey='id';

    public $incrementing=true;
    
    protected $keyType='integer';

}