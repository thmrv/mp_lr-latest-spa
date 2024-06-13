<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Traits\Meta\Metable;

return new class extends Migration
{

    use Metable;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('slug')->nullable();
            $table->string('pathname')->nullable();
            $table->float('charge_annual')->nullable();
            $table->float('price_static')->default(0);
            $table->integer('discount')->default(0);
            $table->string('title')->nullable();
            $table->string('template_name')->default('service');
            $table->string('cover_image_url')->default('default_banner_slim.png');
            $table->string('page_name')->nullable();
            $table->softDeletes();
        });

        DB::statement('
            ALTER TABLE services
            ADD CONSTRAINT services_discount_check CHECK (discount >= 0 AND discount <= 100)
        ');

        Metable::attachToMigration('services');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
