<?php

namespace App\Traits\Meta;

use Illuminate\Support\Facades\Schema;

trait Metable {

    public function getMetaTitle() {
        return $this->fillable['meta_title'];
    }

    public function getMetaDesciption() {
        return $this->fillable['meta_description'];
    }

    public function getMetaKeywords() {
        return $this->fillable['meta_keywords'];
    }

    public function getMetaRobots() {
        return $this->fillable['meta_robots'];
    }

    public function attachToFillable() {
        return isset($this->fillable) ? array_push($this->fillable, ['meta_title', 'meta_description', 'meta_keywords', 'meta_googleBot', 'meta_google_verification', 'meta_googlebot', 'meta_robots']) : $this->fillable = ['meta_title', 'meta_description', 'meta_keywords', 'meta_googleBot', 'meta_google_verification', 'meta_googlebot', 'meta_robots'];
    }

    public static function attachToMigration($tableName) {
        return Schema::table($tableName, function($table) {
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keywords');
            $table->string('meta_googlebot');
            $table->string('meta_google_verification');
            $table->string('meta_robots');
        });
    }

    public function attachToPanel() {

    }
}