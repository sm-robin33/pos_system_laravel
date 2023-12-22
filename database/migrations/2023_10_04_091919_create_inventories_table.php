<?php

use App\Models\Inventory;
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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->Integer('product_id')->nullable();
            $table->Integer('category_id')->nullable();
            $table->Integer('sub-category_id')->nullable();
            $table->Integer('brand_id')->nullable();
            $table->Integer('store_id')->nullable();
            $table->Integer('quantity')->nullable();
            $table->string('status')->default(Inventory::$statusArrays[0]);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('inventories');
    }
};
