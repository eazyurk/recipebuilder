<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->dateTime('last_seen')->default(now());

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recipes');
    }
};
