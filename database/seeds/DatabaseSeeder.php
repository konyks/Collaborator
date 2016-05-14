<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $time = Carbon::now();

        $departments = array("Automotive Tech", "Anthropology", "Arabic","Architectural Technology","Art History","Aviation","Computer Systems","Biology","Business","Chinese","Chemistry","Construction","Criminal Justice","Dental Hygiene","Economics","Electrical Engineering","English","Environmental Studies","ESL","French","Freshman Experience","Geography","German","History","Horticulture","Health Studies","Industrial Technology","Italian","Mechanical Engineering","Modern Languages","Medical Technology","Mathematics","Nursing","Communications","Physical Education","Philosophy","Physics","Politics","Psychology","Software Technology","Sport Management","Sociology","Spanish","Speech","Science and Tech","Telecommunications","Theatre","Visual Communications");
        $acr=array("AET",
        "ANT",
        "ARA",
        "ARC",
        "ART",
        "AVN",
        "BCS",
        "BIO",
        "BUS",
        "CHI",
        "CHM",
        "CON",
        "CRJ",
        "DEN",
        "ECO",
        "EET",
        "EGL",
        "ENV",
        "ESL",
        "FRE",
        "FRX",
        "GEO",
        "GER",
        "HIS",
        "HOR",
        "HST",
        "IND",
        "ITA",
        "MET",
        "MLG",
        "MLT",
        "MTH",
        "NUR",
        "PCM",
        "PED",
        "PHI",
        "PHY",
        "POL",
        "PSY",
        "SET",
        "SMT",
        "SOC",
        "SPA",
        "SPE",
        "STS",
        "TEL",
        "THE",
        "VIS");

        foreach (range(1, 40) as $index) {
            DB::table('users')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => strtolower($faker->firstName . $faker->randomNumber($nbDigits=3)),
                'email' => $faker->email,
                'major' => $departments[$index],
                'bio' => $faker->text(500),
                'location' => $faker->city,
                'user_pic' => 'default.png',
                'created_at' => $time,
                'updated_at' => $time,
                'password' => bcrypt('password'),
            ]);
        }

        foreach (range(1, 40) as $index) {

            DB::table('groups')->insert([
                'name' => $acr[$index].$faker->numberBetween($min = 100, $max = 450),
                'user_id'=>$index,
                'description' => $faker->text(500),
                'department'=> $departments[$index],
                'created_at' => $time,
                'updated_at' => $time,
            ]);
            DB::table('user_group')->insert([
                'user_id' => $index,
                'group_id' => $index,
            ]);
        }

        foreach (range(1, 80) as $index) {
            DB::table('user_group')->insert([
                'user_id' => $faker->numberBetween($min = 1, $max = 40),
                'group_id' => $faker->numberBetween($min = 1, $max = 40),
            ]);
        }
    }
}
