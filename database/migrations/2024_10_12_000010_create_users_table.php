<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->integer('role_id')->unsigned();
            $table->foreign('id')->references('id')->on('t_role')->onDelete('cascade')->onUpdate('cascade');

            // $table->index(["t_role_id"], 'fk_users_t_role1_idx');


            // $table->foreign('t_role_id', 'fk_users_t_role1_idx')
            //     ->references('id')->on('t_role')
            //     ->onDelete('no action')
            //     ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
