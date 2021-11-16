<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'date', 'amount', 'transaction_status_id', 'description', 'category_id', 'creator_id'
    ];

    /**
     * Relation One to Many with `transaction_status` table
     */
    public function transaction_status () {
        return $this->belongsTo(TransactionStatus::class, 'transaction_status_id', 'id');
    }

    /**
     * Relation One to Many with `categories` table
     */
    public function category ()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Relation One to Many with `users` table
     */
    public function creator ()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
}
