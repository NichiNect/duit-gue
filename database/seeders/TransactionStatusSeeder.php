<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransactionStatus;

class TransactionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionStatus::insert([
            ['status_name' => 'Transaction In', 'status_description' => 'Transaction In'],
            ['status_name' => 'Transaction Out', 'status_description' => 'Transaction Out']
        ]);
    }
}
