<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function reset_password_link_screen_can_be_rendered()
    {
        $response = $this->get(route('password.request'));
        $response->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page->component('auth/password/reset-request')
            );
    }

    #[Test]
    public function reset_password_link_can_be_requested()
    {
        Notification::fake();

        $user = User::factory()->create();

        $response = $this->post(route('password.email'), [
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class);
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Password reset link sent successfully',
            ]);
    }

    #[Test]
    public function reset_password_screen_can_be_rendered()
    {
        Notification::fake();

        $user = User::factory()->create();

        $response = $this->post(route('password.email'), [
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
            $response = $this->get(route('password.reset', $notification->token));
            $response->assertStatus(200)
                ->assertInertia(fn (Assert $page) => $page->component('auth/password/reset')
                );

            return true;
        });
    }

    #[Test]
    public function password_can_be_reset_with_valid_token()
    {
        Notification::fake();

        $user = User::factory()->create();

        $response = $this->post(route('password.email'), [
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $response = $this->post(route('password.update'), [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'new-password-123',
                'password_confirmation' => 'new-password-123',
            ]);

            $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'message' => 'Password reset successfully',
                ]);

            $this->assertTrue(
                Hash::check('new-password-123', $user->fresh()->password)
            );

            return true;
        });
    }
}
