<?php

use ReclutaTI\UserGroup;
use Illuminate\Database\Seeder;

class UserGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	[
        		'name' => 'candidate'
        	],

        	[
        		'name' => 'recruiter'
        	],

        	[
        		'name' => 'admin'
        	]
        ];

        foreach ($data as $item) {
        	UserGroup::insert($item);
        }
    }
}
