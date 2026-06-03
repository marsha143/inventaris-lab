    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up(): void
        {
    Schema::table('inventaris', function (Blueprint $table) {
        $table->string('foto_path')->nullable();
        $table->string('dokumen_path')->nullable();
    });
        }

        public function down(): void
        {
            Schema::table('inventaris', function (Blueprint $table) {
                $table->dropColumn(['foto_path', 'dokumen_path']);
            });
        }
    };