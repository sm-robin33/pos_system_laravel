<?php

use App\Models\Customer;
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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name',100);
            $table->string('phone',11)->unique();
            $table->string('email',40)->unique();
            $table->string('address',255)->nullable();
            $table->string('password',50);
            $table->string('gender')->default(Customer::$genderArrays[0]);
            $table->string('status')->default(Customer::$statusArrays[0]);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            //  $table->foreign('created_by')->references('id')->on('users');
            //  ->onUpdate('cascade')->onDelete('cascade');
            //  $table->foreign('updated_by')->references('id')->on('users');
            //  ->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
