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
    public $tableName = 't_tugas';

    /**
     * Run the migrations.
     * @table t_tugas
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->timestamp('create_time')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('update_time')->nullable();
            $table->string('judul')->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['urgent', 'normal'])->nullable();
            $table->dateTime('target_awal')->nullable();
            $table->dateTime('target_akhir')->nullable();
            $table->integer('id_anggota')->unsigned();

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
