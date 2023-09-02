<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    use HasFactory;
    protected $table = 'hobbys';
    protected $fillable = [
        'title',
        'description',
        'icon',
        'user_id',
    ];
    public function user(){
        return $this-> belongsTo(User::class);
    }
}
