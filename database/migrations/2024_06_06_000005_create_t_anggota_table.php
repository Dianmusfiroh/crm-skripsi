<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 't_anggota';

    /**
     * Run the migrations.
     * @table t_anggota
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->timestamp('create_time')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('update_time')->nullable();
            $table->string('name')->nullable();
            $table->string('no_hp', 45)->nullable();
            $table->text('alamat')->nullable();
            $table->integer('id_tim')->unsigned();
            $table->integer('user_id')->unsigned();
   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
};
