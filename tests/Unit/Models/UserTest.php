<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

/**
 * @coversDefaultClass App\Models\User
 */
class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers ::fillable
     */
    public function fillable(): void
    {
        $user = User::factory()->create();

        $expected = $user->toArray();
        $expected['name'] = 'test_name';

        $user->fill([
            'name' => 'test_name',
            'none' => 'none',
        ])->save();
        $this->assertEquals(
            $expected,
            User::find($user->id)->toArray(),
        );
    }

    /**
     * @test
     * @covers ::hidden
     */
    public function hidden(): void
    {
        $user = User::factory()->create();

        $this->assertEquals(
            [
                'id',
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at',
            ],
            array_keys(User::find($user->id)->toArray()),
        );
    }

    /**
     * @test
     * @covers ::casts
     */
    public function casts(): void
    {
        $user = User::factory()->create();

        $this->assertEquals(
            Carbon::class,
            get_class(User::find($user->id)->email_verified_at)
        );
    }
}
