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
    public $tableName = 't_broadcast';

    /**
     * Run the migrations.
     * @table t_broadcast
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('kd_list_broadcast')->primary();
            $table->timestamp('create_time')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('update_time')->nullable();
            $table->enum('status', ['1', '0'])->nullable();
            $table->string('nomor', 45)->nullable();
            $table->text('pesan')->nullable();
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
