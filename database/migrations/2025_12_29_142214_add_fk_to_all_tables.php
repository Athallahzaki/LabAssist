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
            $table->foreign('role_id')
                ->references('id')->on('roles')
                ->cascadeOnDelete();
        });

        Schema::table('admins', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->cascadeOnDelete();
        });

        Schema::table('students', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->cascadeOnDelete();
        });

        Schema::table('labs', function (Blueprint $table) {
            $table->foreign('lab_status_id')
                ->references('id')->on('statuses');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->foreign('student_id')
                ->references('id')->on('students')
                ->cascadeOnDelete();

            $table->foreign('lab_id')
                ->references('id')->on('labs')
                ->cascadeOnDelete();

            $table->foreign('booking_status_id')
                ->references('id')->on('statuses');
        });

        Schema::table('approvals', function (Blueprint $table) {
            $table->foreign('booking_id')
                ->references('id')->on('bookings')
                ->cascadeOnDelete();

            $table->foreign('admin_id')
                ->references('id')->on('admins')
                ->cascadeOnDelete();

            $table->foreign('approval_status_id')
                ->references('id')->on('statuses');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign('student_id')
                ->references('id')->on('students')
                ->cascadeOnDelete();

            $table->foreign('lab_id')
                ->references('id')->on('labs')
                ->cascadeOnDelete();

            $table->foreign('ticket_status_id')
                ->references('id')->on('statuses');
        });

        Schema::table('ticket_assignments', function (Blueprint $table) {
            $table->foreign('ticket_id')
                ->references('id')->on('tickets')
                ->cascadeOnDelete();

            $table->foreign('admin_id')
                ->references('id')->on('admins')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ticket_assignments', function (Blueprint $table) {
            $table->dropForeign(['ticket_id']);
            $table->dropForeign(['admin_id']);
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['lab_id']);
            $table->dropForeign(['ticket_status_id']);
        });

        Schema::table('approvals', function (Blueprint $table) {
            $table->dropForeign(['booking_id']);
            $table->dropForeign(['admin_id']);
            $table->dropForeign(['approval_status_id']);
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['lab_id']);
            $table->dropForeign(['booking_status_id']);
        });

        Schema::table('labs', function (Blueprint $table) {
            $table->dropForeign(['lab_status_id']);
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('admins', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
        });
    }
};
