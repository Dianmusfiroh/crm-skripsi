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
    public $tableName = 't_log_broadcast';

    /**
     * Run the migrations.
     * @table t_log_broadcast
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('kd_log_broadcast')->primary();
            $table->timestamp('create_time')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('update_time')->nullable();
            $table->string('nomor', 45)->nullable();
            $table->enum('status', ['proses', 'failed', 'sukses'])->nullable();
            $table->string('t_broadcast_kd_list_broadcast');

            $table->index(["t_broadcast_kd_list_broadcast"], 'fk_t_log_broadcast_t_broadcast1_idx');


            $table->foreign('t_broadcast_kd_list_broadcast', 'fk_t_log_broadcast_t_broadcast1_idx')
                ->references('kd_list_broadcast')->on('t_broadcast')
                ->onDelete('no action')
                ->onUpdate('no action');
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
