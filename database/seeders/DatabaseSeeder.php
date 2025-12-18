<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Image;
use App\Models\FormSubmission; // Добавь это

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Создание категорий
        $categories = [
            ['name' => 'Технологии', 'slug' => 'tech', 'description' => 'Новости технологий', 'is_active' => true],
            ['name' => 'Наука', 'slug' => 'science', 'description' => 'Научные статьи', 'is_active' => true],
            ['name' => 'Спорт', 'slug' => 'sport', 'description' => 'Спортивные новости', 'is_active' => true],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create($categoryData);
            
            $category->images()->create([
                'url' => 'https://via.placeholder.com/400x300',
                'alt_text' => 'Category image for ' . $category->name,
            ]);
        }

        // Создание тегов
        $tags = [
            ['name' => 'Laravel', 'slug' => 'laravel'],
            ['name' => 'PHP', 'slug' => 'php'],
            ['name' => 'JavaScript', 'slug' => 'javascript'],
            ['name' => 'Веб-разработка', 'slug' => 'web-dev'],
            ['name' => 'Искусственный интеллект', 'slug' => 'ai'],
        ];

        foreach ($tags as $tagData) {
            Tag::create($tagData);
        }

        // Создание постов
        $allTags = Tag::all();
        
        for ($i = 1; $i <= 20; $i++) {
            $post = Post::create([
                'category_id' => Category::inRandomOrder()->first()->id,
                'title' => 'Пост номер ' . $i,
                'slug' => 'post-' . $i,
                'content' => 'Это содержимое поста номер ' . $i . '. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'excerpt' => 'Краткое описание поста ' . $i,
                'status' => $i % 3 === 0 ? 'draft' : 'published',
                'published_at' => $i % 3 === 0 ? null : now()->subDays(rand(1, 30)),
                'views_count' => rand(10, 500),
            ]);

            $post->tags()->attach($allTags->random(rand(1, 3))->pluck('id'));

            for ($j = 0; $j < rand(1, 3); $j++) {
                $post->images()->create([
                    'url' => 'https://via.placeholder.com/800x600',
                    'alt_text' => 'Image ' . $j . ' for post ' . $i,
                ]);
            }

            for ($k = 0; $k < rand(2, 5); $k++) {
                Comment::create([
                    'post_id' => $post->id,
                    'author_name' => 'Автор ' . $k,
                    'author_email' => 'author' . $k . '@example.com',
                    'content' => 'Комментарий ' . $k . ' к посту ' . $i,
                    'is_approved' => rand(0, 1),
                ]);
            }
        }

        for ($i = 1; $i <= 10; $i++) {
            FormSubmission::create([
                'name' => 'Пользователь ' . $i,
                'email' => 'user' . $i . '@example.com',
                'message' => 'Это тестовое сообщение номер ' . $i . '. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'created_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}