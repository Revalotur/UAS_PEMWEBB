<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up()
{
Schema::create('feedback', function (Blueprint $table) {
$table->id();
$table->string('user_id', 20); // Sesuaikan dengan tipe user_id Anda
$table->text('message');
$table->timestamps();

// Relasi ke tabel users
$table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
});
}

public function down()
{
Schema::dropIfExists('feedback');
}
};