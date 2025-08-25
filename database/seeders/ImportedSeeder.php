<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class ImportedSeeder extends Seeder
{
    public function run()
    {
        $categories = require 'categories.php';

        foreach ($categories as $category) {
            $category = PostCategory::create([
                'id' => $category['id'],
                'name' => json_decode($category['name'], true),
                'slug' => $category['slug'],
                'created_at' => $category['created_at'],
                'updated_at' => $category['updated_at'],
            ]);
        }

        $catIds = PostCategory::pluck('id')->toArray();

        $posts = require 'posts.php';

        foreach ($posts as $post) {
            $newPost = Post::create([
                'id' => $post['id'],
                'date' => $post['date'],
                'title' => json_decode($post['title'], true),
                'body' => json_decode($post['content'], true),
                'intro' => $post['intro'],
                'slug' => $post['slug'],
                'published' => $post['status'] === 'PUBLISHED',
                'created_at' => $post['created_at'],
                'updated_at' => $post['updated_at'],
            ]);

            if ($post['category_id'] && in_array($post['category_id'], $catIds)) {
                $newPost->categories()->attach($post['category_id']);
            }

            if ($post['imgs']) {
                $images = explode(',', $post['imgs']);

                $images = array_filter($images, function ($img) {
                    return strtoupper($img) != 'NULL';
                });

                foreach ($images as $img) {
                    $url = "https://apcas.cat/$img";

                    $newPost
                        ->addMediaFromUrl($url)
                        ->toMediaCollection('images');
                }
            }

            if ($post['fls']) {
                $files = explode(',', $post['fls']);

                $files = array_filter($files, function ($file) {
                    return strtoupper($file) != 'NULL';
                });

                foreach ($files as $file) {
                    $url = "https://apcas.cat/$file";

                    $newPost
                        ->addMediaFromUrl($url)
                        ->toMediaCollection('files');
                }
            }
        }
    }
}
