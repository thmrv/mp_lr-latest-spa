<?php

use App\Models\Setting;
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
        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('label');
            $table->text('value')->nullable();
            $table->json('attributes')->nullable();
            $table->string('type');
            $table->timestamps();
        });

        Setting::create([
            'key' => 'site_name',
            'label' => 'Site Name',
            'value' => 'Megaputer',
            'type' => 'text',
        ]);

        Setting::create([
            'key' => 'contacts_phone',
            'label' => 'Phone Number',
            'value' => '+7(499)7530129',
            'type' => 'text',
        ]);

        Setting::create([
            'key' => 'copyright_label',
            'label' => 'Copyright Label',
            'value' => '©1993-2024. ООО «Компания «Мегапьютер Интеллидженс».',
            'type' => 'text',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};