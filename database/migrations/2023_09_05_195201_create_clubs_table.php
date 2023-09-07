<?php

use App\Enums\VatType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->integer('duration');
            $table->string('duration_type');
            $table->string('times');
            $table->string('status');
            $table->double('price');
            $table->double('prev_price')->default(0);
            $table->string('color');
            $table->boolean('is_coming_soon')->default(false);
            $table->double('vat')->default(0);
            $table->string('vat_type')->default(VatType::PERCENT->value);
            $table->foreignId('added_by')->nullable()->constrained('admins')->references('id')->nullOnDelete();
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
        Schema::dropIfExists('clubs');
    }
};
