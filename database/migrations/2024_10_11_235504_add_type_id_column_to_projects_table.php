<?php

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
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable()->after('id');
            // creo la relazione
            // quando cancello una tipolgia, il valore diventa null nella colonna type_id
            $table->foreign('type_id')->references('id')->on('projects')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('pojects_type_id_foreign');
            // dopo aver cancellato il legame, cancello la colonna
            $table->dropClumn('type_id');
        });
    }
};
