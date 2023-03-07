<?php

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisplacementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('displacements', function (Blueprint $table) {
            $table->id();
            $table->string('to');
            $table->float('to_lat');
            $table->float('to_lon');
            $table->string('from');
            $table->float('from_lat');
            $table->float('from_lon');
            $table->double('distance');
            $table->double('price');
            $table->enum('status', ['broadcasting', 'pending', 'ongoing', 'ended'])->default('broadcasting');
            $table->enum('type', ['depot', 'course', 'voyage'])->default('depot');
            $table->foreignIdFor(Car::class)->nullable()->index();
            $table->foreignIdFor(User::class)->index()->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('displacements');
    }
}
