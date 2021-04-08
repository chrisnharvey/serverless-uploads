<?php

namespace Tests\Feature;

use App\Models\File;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadFileTest extends TestCase
{
    use RefreshDatabase;

    public function test_file_can_be_uploaded()
    {
        $file = File::factory()->create();

        Storage::fake();

        $upload = UploadedFile::fake()->create('demo.jpg', $file->min_size + 1, 'image/jpeg');

        $response = $this->postJson("/api/files/{$file->id}", [
            'file' => $upload,
            'token' => Crypt::encryptString($file->id)
        ]);

        $response->assertStatus(200)->assertJson([
            'data' => [
                'id' => (string) $file->id,
                'name' => 'demo.jpg',
                'size' => ($file->min_size + 1) * 1024,
                'mimetype' => 'image/jpeg'
            ]
        ]);

        Storage::assertExists($file->fresh()->path);
    }
}
