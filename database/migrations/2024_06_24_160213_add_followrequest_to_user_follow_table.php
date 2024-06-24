<?php
/**フォロー申請許可作ろうとしてやめました**/

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
        Schema::table('user_follow', function (Blueprint $table) {
            #$table->unsignedBigInteger('followrequest')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_follow', function (Blueprint $table) {
            $table->dropColumn('followrequest');  //カラムの削除
        });
    }
};
