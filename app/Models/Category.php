<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'description', 'color', 'creator_id', 'is_active'
    ];

    /**
     * Relation One to Many with `transactions` table
     */
    public function transactions ()
    {
        return $this->hasMany(Transaction::class, 'category_id', 'id');
    }

    /**
     * Relation One to Many with `users` table
     */
    public function creator ()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

}
