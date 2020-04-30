<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $statuses = [
            [
                'id'   => 1,
                'name' => 'New',
            ],
            [
                'id'   => 2,
                'name' => 'In Progress',
            ],
            [
                'id'   => 3,
                'name' => 'Completed',
            ],
        ];

        Status::insert($statuses);
    }
}
