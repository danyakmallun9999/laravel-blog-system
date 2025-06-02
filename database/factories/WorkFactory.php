<?php

namespace Database\Factories;

use App\Models\Work;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkFactory extends Factory
{
    protected $model = Work::class;

    public function definition(): array
    {
        $workCategories = ['Web Development', 'UI/UX Design', 'Mobile App', 'Branding', 'Consulting', 'Dashboard', 'Illustration', 'Typography'];
        
        // Daftar kata kunci yang relevan untuk gambar proyek portfolio
        $workImageKeywords = ['design', 'development', 'office', 'portfolio', 'mockup', 'ui', 'ux', 'website', 'application', 'desk', 'workspace', 'technology'];
        $randomWorkKeyword = $this->faker->randomElement($workImageKeywords);

        return [
            'title' => $this->faker->catchPhrase() . ' Project',
            'description' => $this->faker->paragraph(rand(3, 7)),
            // Menggunakan Unsplash untuk gambar
            'image' => "https://source.unsplash.com/600x400/?{$randomWorkKeyword}&sig=" . $this->faker->randomNumber(5),
            'year' => $this->faker->numberBetween(2018, date('Y')),
            'category' => $this->faker->randomElement($workCategories),
            'project_url' => $this->faker->optional(0.7)->url(),
            'created_at' => $this->faker->dateTimeBetween('-3 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
}