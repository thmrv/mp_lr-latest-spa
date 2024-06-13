<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\PageType;
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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('(UUID())'));
            $table->string('name')->nullable();
            $table->boolean('enabled')->default(true); 
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->string('pathname')->nullable();
            $table->longText('content_json')->nullable();
            $table->longText('content_html')->nullable();
            $table->string('template_name')->default('single');
            $table->string('cover_image_url')->default('default_banner_slim.png');
            $table->timestamps();
            $table->softDeletes();
        });

        Metable::attachToMigration('pages');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
