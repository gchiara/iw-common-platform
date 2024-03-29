<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Dataset extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'country',
        'file_path'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
