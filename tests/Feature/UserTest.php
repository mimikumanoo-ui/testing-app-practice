<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_be_created()
    {
        // ユーザーを作成
        $user = User::factory()->create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
        ]);

        // データベースにユーザーが存在することを確認
        $this->assertDatabaseHas('users', [
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
        ]);
    }

    public function test_email_must_be_unique()
    {
        // 1人目のユーザーを作成
        User::factory()->create([
            'email' => 'duplicate@example.com',
        ]);

        // 同じメールアドレスで2人目を作成しようとすると例外が発生
        $this->expectException(\Illuminate\Database\QueryException::class);

        User::factory()->create([
            'email' => 'duplicate@example.com',
        ]);
    }
}

