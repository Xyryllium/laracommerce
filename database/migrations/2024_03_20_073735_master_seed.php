<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $usersSeedValue = [];

    public function __construct()
    {
        $this->usersSeedValue = [
            [
                "first_name" => "Admin",
                "last_name" => "Admin",
                "email" => "admin@laracommerce.com",
                "username" => "admin",
                "password" => bcrypt("password"),
                "created_at" => now()
            ]
        ];
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table("users")->insert($this->usersSeedValue);
    }

    public function down()
    {
        DB::table("users")->whereIn(
            "email",
            array_map(
                function ($row) {
                    return $row["email"];
                },
                $this->usersSeedValue
            )
        )->delete();
    }
};
