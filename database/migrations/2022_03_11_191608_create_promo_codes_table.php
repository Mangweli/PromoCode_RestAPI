<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->increments("id");
            $table->string("promo_code");
            $table->string("country")->index("country");
            $table->string("city")->index("city");
            $table->string("promo_type")->default('INPUT');
            $table->string("promo_category")->default('RIDE');
            $table->longText("description")->nullable();
            $table->decimal("minimum_amount", 10,2)->nullable();
            $table->decimal("amount", 10,2)->nullable();
            $table->decimal("amount_percentage", 10,2)->default('0.00');
            $table->integer("number_of_usage_per_rider")->nullable();
            $table->decimal("max_total_amount")->nullable();
            $table->integer("current_usage")->nullable();
            $table->timestamp("start_date")->index("start_date");
            $table->timestamp("end_date")->index("end_date");
            $table->boolean("disabled")->default(1);
            $table->string("gender")->nullable();
            $table->string("pick_up_address")->nullable();
            $table->string("pick_up_ll")->nullable();
            $table->string("pick_up_variance")->nullable();
            $table->string("drop_off_address")->nullable();
            $table->string("drop_off_ll")->nullable();
            $table->string("drop_off_variance")->nullable();
            $table->string("payment_type")->nullable();
            $table->string("device_os")->nullable();
            $table->timestamps();
            $table->index(["created_at", "updated_at"]);
            $table->unique('promo_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promo_codes');
    }
}
