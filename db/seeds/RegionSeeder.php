<?php


use Phinx\Seed\AbstractSeed;

class RegionSeeder extends AbstractSeed
{

    public function run()
    {
        $data = [];

        function generateRandomString($length = 10)
        {
            return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
        }

        for ($i = 0; $i <= 250; ++$i) {
            $data[] = [
                'parent_id' => 0,
                'name' => generateRandomString(random_int(3, 20))
            ];
        }

        for ($i = 251; $i <= 2500; ++$i) {
            $data[] = [
                'parent_id' => random_int(0, 250),
                'name' => generateRandomString(random_int(3, 20))
            ];
        }

        for ($i = 2501; $i <= 25000; ++$i) {
            $data[] = [
                'parent_id' => random_int(251, 2500),
                'name' => generateRandomString(random_int(3, 20))
            ];
        }

        for ($i = 25001; $i <= 250000; ++$i) {
            $data[] = [
                'parent_id' => random_int(2501, 25000),
                'name' => generateRandomString(random_int(3, 20))
            ];
        }


        $this->table('region')->insert($data)->save();
    }
}
