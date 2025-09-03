<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(rand(5, 10));
        $content = '<p>'.implode('</p><p>', $this->faker->paragraphs(rand(10, 20))).'</p>';

        // Daftar kata kunci yang relevan untuk gambar postingan blog
        $postImageKeywords = ['technology', 'code', 'writing', 'nature', 'abstract', 'desk', 'office', 'programming', 'developer'];
        $randomPostKeyword = $this->faker->randomElement($postImageKeywords);

        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $content,
            // Menggunakan Unsplash untuk gambar
            // Format: https://source.unsplash.com/WIDTHxHEIGHT/?keyword1,keyword2
            // Menambahkan timestamp atau string acak untuk variasi jika URL sama di-cache
            'image' => "https://source.unsplash.com/800x600/?{$randomPostKeyword}&sig=".$this->faker->randomNumber(5),
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
