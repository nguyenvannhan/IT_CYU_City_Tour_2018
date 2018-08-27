<?php

use Illuminate\Database\Seeder;

class MarkCriteriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mark_criterias')->insert([
            [
                'name' => 'Thử thách',
                'max_mark' => 50
            ],
            [
                'name' => 'Đúng gợi ý',
                'max_mark' => 30
            ],
            [
                'name' => 'Bonus',
                'max_mark' => 20
            ],
            [
                'name' => 'Điểm trừ',
                'max_mark' => -20
            ]
        ]);
    }
}
