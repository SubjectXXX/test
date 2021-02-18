<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Posts
        $i = 1;
        DB::table('posts')
            ->insert([
                [
                    'title' => 'Tečaj s chef kuharjem',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'data' => json_encode([
                        'image' => 'posts/post1.jpg',
                        'video' => 'posts/video1.mp4',
                    ]),
                    'status' => true,
                    'sort' => $i,
                ],
                [
                    'title' => 'Naj slovensko pecivo',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'data' => json_encode([
                        'image' => 'posts/post2.jpg',
                        'video' => 'posts/video2.mp4',
                    ]),
                    'status' => true,
                    'sort' => $i,
                ],
                [
                    'title' => 'TIKTAK obrok',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'data' => json_encode([
                        'image' => 'posts/post3.jpg',
                    ]),
                    'status' => true,
                    'sort' => $i,
                ],
                [
                    'title' => 'Fit brez izgovorov',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'data' => json_encode([
                        'image' => 'posts/post4.jpg',
                        'video' => 'posts/video2.mp4',
                    ]),
                    'status' => false,
                    'sort' => $i,
                ],
                [
                    'title' => 'Tik Tok kultura',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'data' => json_encode([
                    ]),
                    'status' => true,
                    'sort' => $i,
                ]
            ]);


        // Tags
        DB::table('tags')
            ->insert([
                [
                    'title' => 'Kulinarika'
                ],
                [
                    'title' => 'Hrana'
                ],
                [
                    'title' => 'Jorg Zupan'
                ],
                [
                    'title' => 'Telovadba'
                ],
                [
                    'title' => 'Fitnes'
                ],
                [
                    'title' => 'Fitnes'
                ],
                [
                    'title' => 'Toni Cetinski'
                ]
            ]);

        $allPosts = DB::table('posts')->count();
        $allTags = DB::table('tags')->count();
        $dataArray = [];
        for ($i = 0; $i<20; $i++) {
            $dataArray[] = [
                'post_id' => random_int(1, $allPosts),
                'tag_id' => random_int(1, $allTags)
            ];
        }
        DB::table('post_tag')->insert($dataArray);
    }
}
