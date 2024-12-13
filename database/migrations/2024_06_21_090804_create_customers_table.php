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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company')->nullable();
            $table->string('name');
            $table->string('surname');
            $table->string('address');
            $table->string('po_box')->nullable();
            $table->string('zip');
            $table->string('city');
            $table->string('email');
            $table->string('phone');
            $table->string('iban');
            $table->string('bankname');
            $table->string('alt_title')->nullable();
            $table->string('alt_name')->nullable();
            $table->string('alt_surname')->nullable();
            $table->string('alt_address')->nullable();
            $table->string('alt_zip')->nullable();
            $table->string('alt_city')->nullable();
            $table->string('oral_suggestion')->nullable();
            $table->string('ricardo_suggestion')->nullable();
            $table->string('socialmedia_suggestion')->nullable();
            $table->string('flyer_suggestion')->nullable();
            $table->boolean('incorporated')->default(false);
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
        // Create the 'customers_archive' table
        Schema::create('customers_archive', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company')->nullable();
            $table->string('name');
            $table->string('surname');
            $table->string('address');
            $table->string('po_box')->nullable();
            $table->string('zip');
            $table->string('city');
            $table->string('email');
            $table->string('phone');
            $table->string('iban');
            $table->string('bankname');
            $table->string('alt_title')->nullable();
            $table->string('alt_name')->nullable();
            $table->string('alt_surname')->nullable();
            $table->string('alt_address')->nullable();
            $table->string('alt_zip')->nullable();
            $table->string('alt_city')->nullable();
            $table->string('oral_suggestion')->nullable();
            $table->string('ricardo_suggestion')->nullable();
            $table->string('socialmedia_suggestion')->nullable();
            $table->string('flyer_suggestion')->nullable();
            $table->boolean('incorporated')->default(false);
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
        Schema::dropIfExists('customers_archive');
    }
};
