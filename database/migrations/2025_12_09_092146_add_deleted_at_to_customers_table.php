<?php

// database/migrations/..._add_deleted_at_to_customers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // ⭐️ This line adds the 'deleted_at' timestamp column ⭐️
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // This line safely removes the 'deleted_at' column
            $table->dropSoftDeletes();
        });
    }
};
