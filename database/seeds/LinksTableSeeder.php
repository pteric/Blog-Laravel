<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
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
                'links_name'        => 'github',
                'links_description' => '国内口碑最好的PHP培训机构',
                'links_url'         => 'https://github.com',
            ],
            [
                'links_name'        => '后盾网',
                'links_description' => '后盾网，人人做后盾',
                'links_url'         => 'http://bbs.houdunwang.com',
            ]
        ];
        DB::table('links')->insert($data);
    }
}
