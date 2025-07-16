<?php
// Category model for the categories table

namespace App\Models;

use Illuminate\Support\Facades\bootstrap;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
