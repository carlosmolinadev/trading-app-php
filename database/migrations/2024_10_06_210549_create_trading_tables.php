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
        Schema::create('exchanges', function (Blueprint $table)
        {
            $table->smallIncrements('id');
            $table->string('name');
        });

        Schema::create('order_statuses', function (Blueprint $table)
        {
            $table->smallIncrements('id');
            $table->string('name');
        });

        Schema::create('trade_statuses', function (Blueprint $table)
        {
            $table->smallIncrements('id');
            $table->string('name');
        });

        Schema::create('order_types', function (Blueprint $table)
        {
            $table->smallIncrements('id');
            $table->string('name');
        });
        Schema::create('api_keys', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('public', 100);
            $table->string('private', 100);
            $table->integer('exchange_id');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('symbols', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('quantity_precision');
            $table->integer('price_precision');
            $table->integer('exchange_id');
            $table->string('margin_asset', 25);
            $table->string('base_asset', 25);
        });

        Schema::create('trades', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('symbol');
            $table->integer('derivate_id');
            $table->string('side');
            $table->integer('trade_status_id');
            $table->integer('trade_setting_id')->nullable;
            $table->integer('exchange_id');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('trade_orders', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('quantity');
            $table->integer('stop_price');
            $table->integer('take_price');
            $table->integer('limit_price');
            $table->integer('parent_order')->nullable();
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('trade_id');
            $table->timestamps();
        });

        Schema::create('trade_settings', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('risk_reward')->nullable();
            $table->integer('retry_attempt')->nullable();
            $table->integer('skip_attempt')->nullable();
            $table->integer('risked_amount');
            $table->boolean('candle_close_trigger');
            $table->boolean('stop_loss_wick_close');
            $table->integer('stop_loss_wick_close_value');
            $table->boolean('secure_trade_on_profit');
            $table->integer('secure_trade_value');
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trade_orders');
        Schema::dropIfExists('trades');
        Schema::dropIfExists('symbols');
        Schema::dropIfExists('api_keys');
        Schema::dropIfExists('order_types');
        Schema::dropIfExists('order_statuses');
        Schema::dropIfExists('exchanges');
        Schema::dropIfExists('trade_statuses');
        Schema::dropIfExists('trade_settings');
    }
};
