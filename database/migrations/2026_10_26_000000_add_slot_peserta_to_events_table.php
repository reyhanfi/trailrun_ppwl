<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedInteger('slot_peserta')->default(0);
        });

        DB::table('events')->where('tipe_event', 'Run')
            ->update(['slot_peserta' => 500]);
        DB::table('events')->where('tipe_event', 'Trail Run')
            ->update(['slot_peserta' => 300]);
        DB::table('events')->where('tipe_event', 'Challenge')
            ->update(['slot_peserta' => 200]);
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('slot_peserta');
        });
    }
};
