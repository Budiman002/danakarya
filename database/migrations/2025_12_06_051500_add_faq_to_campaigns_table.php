<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->text('faq_goal')->nullable()->after('description');
            $table->text('faq_fund_usage')->nullable();
            $table->text('faq_timeline')->nullable();
            $table->string('faq_custom_1_question', 255)->nullable();
            $table->text('faq_custom_1_answer')->nullable();
            $table->string('faq_custom_2_question', 255)->nullable();
            $table->text('faq_custom_2_answer')->nullable();
        });
    }

    public function down()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn([
                'faq_goal',
                'faq_fund_usage',
                'faq_timeline',
                'faq_custom_1_question',
                'faq_custom_1_answer',
                'faq_custom_2_question',
                'faq_custom_2_answer',
            ]);
        });
    }
};