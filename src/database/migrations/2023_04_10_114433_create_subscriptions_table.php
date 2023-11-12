<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignIdFor(\Plutuss\Models\Plan::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();

//            $table->unsignedInteger('plan_id')->nullable();
            $table->string('stripe_subscription_id')->nullable();
            $table->string('stripe_price_id')->nullable();
            $table->string('date_subscription')->nullable();
            $table->timestamp('current_period_end')->nullable();
            $table->timestamp('expire_at')->nullable();
            $table->boolean('is_active')->default(1);
            $table->decimal('price')->default(0);

            $table->timestamps();


//            $table->foreign('plan_id')
//                ->nullable()
//                ->references('id')
//                ->on('plans')
//                ->cascadeOnUpdate()
//                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
