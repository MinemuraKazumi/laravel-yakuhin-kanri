<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reagents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reagent_name');//文字：薬品名
            $table->integer('reagent_number');//数字：薬品本数
            $table->integer('reagent_capcity');//数字：薬品容量
            $table->integer('reagent_barcode');//数字：薬品のバーコード
            $table->string('reagent_epuipment');//文字：保護具
            $table->string('reagent_correspondence');//文字：緊急対応
            $table->string('reagent_storage');//文字：保護具
            $table->string('reagent_document');//文字：SDS
            $table->integer('user_id');//4/20ここを追記
            $table->datetime('published');//
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reagents');
    }
};
