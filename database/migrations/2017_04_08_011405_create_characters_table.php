<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {

            $table->uuid('id');
            $table->primary('id');

            $table->integer('user_id');


            $table->string('name');
            $table->string('race')->nullable();
            $table->string('profession')->nullable();

            $table->integer('gender')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('age')->nullable();
            $table->string('hair')->nullable();
            $table->string('eyes')->nullable();
            $table->string('culture')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('title')->nullable();
            $table->string('social')->nullable();

            $table->integer('MU');
            $table->integer('KL');
            $table->integer('IN');
            $table->integer('CH');
            $table->integer('FF');
            $table->integer('GE');
            $table->integer('KO');
            $table->integer('KK');

            $table->integer('lep')->nullable();
            $table->integer('asp')->nullable();
            $table->integer('kap')->nullable();
            $table->integer('lep_max')->nullable();
            $table->integer('asp_max')->nullable();
            $table->integer('kap_max')->nullable();
            $table->integer('sp')->nullable();

            $table->integer('SK')->nullable();
            $table->integer('ZK')->nullable();
            $table->integer('AW')->nullable();
            $table->integer('IT')->nullable();
            $table->integer('GW')->nullable();


            $table->integer('ap_total');
            $table->integer('ap_spend')->nullable();

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
        Schema::dropIfExists('characters');
    }
}
