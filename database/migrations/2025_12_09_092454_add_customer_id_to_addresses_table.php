<?php

// database/migrations/..._add_customer_id_to_addresses_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            // ⭐️ Add the column first (must be unsignedBigInteger to match customer ID) ⭐️
            $table->unsignedBigInteger('customer_id')->nullable()->after('id'); 
            
            // ⭐️ Define the Foreign Key Constraint ⭐️
            // Links 'customer_id' to the 'id' column on the 'customers' table.
            $table->foreign('customer_id')
                  ->references('id')
                  ->on('customers')
                  ->onDelete('cascade'); // Optional: Deletes addresses if the customer is deleted
        });
    }

    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['customer_id']); 
            
            // Then drop the column
            $table->dropColumn('customer_id'); 
        });
    }
};
