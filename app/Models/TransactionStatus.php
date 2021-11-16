<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionStatus extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaction_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'status_name', 'status_description'
    ];

    /**
     * Relation One to Many with `transaction` table
     */
    public function transaction () {
        return $this->hasMany(Transaction::class, 'category_id', 'id');
    }
}
