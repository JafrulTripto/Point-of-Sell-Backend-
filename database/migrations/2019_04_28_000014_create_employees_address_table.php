<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesAddressTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'employees_address';

    /**
     * Run the migrations.
     * @table employees_address
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('employees_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->timestamps();

            $table->index(["address_id"], 'fk_employees_has_address_address1_idx');

            $table->index(["employees_id"], 'fk_employees_has_address_employees1_idx');


            $table->foreign('employees_id', 'fk_employees_has_address_employees1_idx')
                ->references('id')->on('employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('address_id', 'fk_employees_has_address_address1_idx')
                ->references('id')->on('address')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
