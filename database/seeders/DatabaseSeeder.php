<?php

use Illuminate\Database\Seeder;
use App\Models\ServiceModel;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('users')->pluck('id');
        for($i=0;$i<6;$i++){
            ServiceModel::create(
                [
                    'name' => Str::random(10),
                    'type' => Str::random(10),
                    'price' => random_int(100,10000),
                    'user_id' => 2,
                ]
            );
        }
    }
}
