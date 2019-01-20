<?php
ini_set('memory_limit', '2G');

use Phinx\Seed\AbstractSeed;

class PeopleSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $data = [];

        for ($i = 0; $i < 1400000; ++$i) {
            $data[] = [
                'region_id' => random_int(1, 250000),
                'name' => substr($faker->name, 0, 20)
            ];
            if (is_int($i / 100000) && $i !== 0) {
            	$this->table('people')->insert($data)->save();
            	$faker = Faker\Factory::create();
            	$data = [];
            }
        }


        $this->table('people')->insert($data)->save();
    }
}
