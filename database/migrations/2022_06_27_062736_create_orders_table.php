<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            /* да, я знаю, что тут лучше timyInteger... но так как это уже работающий проект, оставлю, как было... */
            $table->text('status')->default(1);
            $table->text('manager_id');
            $table->text('service');
            $table->text('product');
            $table->text('product_complection');
            $table->text('model');
            $table->text('model_full_name');
            $table->text('malfunction');
            $table->text('appearance');
            $table->text('marks');
            $table->text('client_login');
            $table->text('client_phone');

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
        Schema::dropIfExists('orders');
    }
}
