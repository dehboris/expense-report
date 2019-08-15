<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseReportBucketItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_report_bucket_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bucket_id');
            $table->string('type', 20);
            $table->string('name', 255);
            $table->bigInteger('amount');
            $table->timestamps();

            $table->foreign('bucket_id')
                ->references('id')->on('expense_report_buckets')
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
        Schema::dropIfExists('expense_report_bucket_items');
    }
}
