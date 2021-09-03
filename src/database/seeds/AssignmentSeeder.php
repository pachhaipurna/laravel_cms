<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        DB::table('assignments')->insert([
            [
                'title' => 'Divergent',
                'author_name' => 'Veronica Roth',
                'updated_at' => new \DateTime(),
                'created_at' => new \DateTime()
            ],
            [
                'title' => 'Danger’s Kiss',
                'author_name' => 'Glynnis Campbell',
                'updated_at' => new \DateTime(),
                'created_at' => new \DateTime()
            ],
            [
                'title' => 'Everyone\'s a Aliebn When Ur a Aliebn Too',
                'author_name' => 'Jomny Sunt',
                'updated_at' => new \DateTime(),
                'created_at' => new \DateTime()
            ],
            [
                'title' => 'The Very Hungry Caterpillar',
                'author_name' => 'Eric Carle',
                'updated_at' => new \DateTime(),
                'created_at' => new \DateTime()
            ],
            [
                'title' => 'Men Explain Things to Me',
                'author_name' => 'Rebecca Solnit',
                'updated_at' => new \DateTime(),
                'created_at' => new \DateTime()
            ]


        ]);
    }
}
