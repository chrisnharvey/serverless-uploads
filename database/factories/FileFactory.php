<?php

namespace Database\Factories;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'types' => ['jpg'],
            'min_size' => 100,
            'max_size' => 1000,
            'file_expires_in' => 3600,
            'link_expires' => now()->addSeconds(3600)
        ];
    }
}
