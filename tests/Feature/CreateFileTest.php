<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class CreateFileTest extends TestCase
{
    use RefreshDatabase;

    public function test_file_can_be_created()
    {
        $this->actingAs(
            User::factory()->create()
        );

        $this->travelTo(Carbon::create(2021, 4, 8, 20));

        $response = $this->postJson('/api/files', [
            'types' => ['jpg'],
            'minSize' => 100,
            'maxSize' => 1000,
            'linkExpires' => 3600,
            'fileExpires' => 3600
        ]);

        $response
            ->assertCreated()
            ->assertJson([
                'data' => [
                    'types' => ['jpg'],
                    'minSize' => 100,
                    'maxSize' => 1000,
                    'linkExpires' => '2021-04-08T21:00:00.000000Z'
                ]
            ]);

        $this->assertEquals(
            Crypt::decryptString($response['data']['token']),
            $response['data']['id']
        );

        $this->assertDatabaseHas('files', [
            'types' => json_encode(['jpg']),
            'min_size' => 100,
            'max_size' => 1000,
            'link_expires' => '2021-04-08 21:00:00'
        ]);
    }
}
