<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToHomesTable extends Migration
{
    public function up()
    {
        Schema::table('homes', function (Blueprint $table) {
            $table->string('image')->nullable()->after('skills'); // Tambahkan kolom image
        });
    }

    public function down()
    {
        Schema::table('homes', function (Blueprint $table) {
            $table->dropColumn('image'); // Hapus kolom image jika rollback
        });
    }
}
