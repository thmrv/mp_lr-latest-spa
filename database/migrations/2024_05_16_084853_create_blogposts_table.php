<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Traits\Meta\Metable;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    use Metable;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogposts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('(UUID())'));
            $table->string('name')->nullable();
            $table->boolean('enabled')->default(true); 
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->string('pathname')->nullable();
            $table->longText('content')->nullable();
            $table->string('template_name')->default('blogpost');
            $table->string('cover_image_url')->nullable();;
            $table->timestamps();
            $table->softDeletes();
        });

        Metable::attachToMigration('blogposts');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogposts');
    }
};
