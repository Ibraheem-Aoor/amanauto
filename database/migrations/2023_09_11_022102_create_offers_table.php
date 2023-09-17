<?php

use App\Enums\OfferStatus;
use App\Enums\VatType;
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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('added_by')->nullable()->constrained('admins')->references('id')->nullOnDelete();
            $table->date('end_date');
            $table->double('discount_value');
            $table->string('discount_type')->default(VatType::PERCENT->value);
            $table->string('status')->default(OfferStatus::ACTIVE->value);
            $table->foreignId('offer_company_id')->references('id')->on('offer_companies')->onDelete('cascade');
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
        Schema::dropIfExists('offers');
    }
};
