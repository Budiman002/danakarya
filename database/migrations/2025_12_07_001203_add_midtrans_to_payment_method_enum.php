<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE donations MODIFY COLUMN payment_method ENUM('bank_transfer', 'ewallet', 'credit_card', 'midtrans') NOT NULL");
    }

    public function down()
    {
        DB::statement("ALTER TABLE donations MODIFY COLUMN payment_method ENUM('bank_transfer', 'ewallet', 'credit_card') NOT NULL");
    }
};