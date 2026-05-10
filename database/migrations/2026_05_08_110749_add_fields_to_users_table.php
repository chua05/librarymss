<?php

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
        Schema::table('users', function (Blueprint $table) {

                if (!Schema::hasColumn('users', 'username')) {
                    $table->string('username')->unique()->after('name');
                }
        
                if (!Schema::hasColumn('users', 'contact_number')) {
                    $table->string('contact_number')->nullable()->after('username');
                }
        
                if (!Schema::hasColumn('users', 'address')) {
                    $table->text('address')->nullable()->after('contact_number');
                }
        
                if (!Schema::hasColumn('users', 'role')) {
                    $table->string('role')->default('user')->after('password');
                }
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'username')) {
                $table->dropColumn('username');
            }
    
            if (Schema::hasColumn('users', 'contact_number')) {
                $table->dropColumn('contact_number');
            }
    
            if (Schema::hasColumn('users', 'address')) {
                $table->dropColumn('address');
            }
    
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
};
