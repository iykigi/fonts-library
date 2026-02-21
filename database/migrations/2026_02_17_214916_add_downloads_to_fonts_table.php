<?php
// database/migrations/xxxx_xx_xx_add_downloads_to_fonts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('fonts', function (Blueprint $table) {
            $table->integer('downloads')->default(0)->after('file_path');
        });
    }

    public function down()
    {
        Schema::table('fonts', function (Blueprint $table) {
            $table->dropColumn('downloads');
        });
    }
};