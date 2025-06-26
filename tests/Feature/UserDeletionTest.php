<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

class UserDeletionTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_delete_active_user()
    {
        // Create admin user
        $admin = User::factory()->create(['is_admin' => true]);

        // Create regular user
        $user = User::factory()->create();

        // Authenticate as admin
        Sanctum::actingAs($admin);

        // Delete user
        $response = $this->deleteJson("/api/users/{$user->id}");

        $response->assertStatus(200);
        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }

    public function test_admin_can_delete_soft_deleted_user()
    {
        // Create admin user
        $admin = User::factory()->create(['is_admin' => true]);

        // Create regular user and soft delete it
        $user = User::factory()->create();
        $user->delete(); // Soft delete

        // Verify user is soft deleted
        $this->assertSoftDeleted('users', ['id' => $user->id]);

        // Authenticate as admin
        Sanctum::actingAs($admin);

        // Try to delete the already soft-deleted user (should force delete)
        $response = $this->deleteJson("/api/users/{$user->id}");

        // Should succeed (not return 404)
        $response->assertStatus(200);

        // User should now be completely removed
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_admin_can_update_soft_deleted_user()
    {
        // Create admin user
        $admin = User::factory()->create(['is_admin' => true]);

        // Create regular user and soft delete it
        $user = User::factory()->create();
        $user->delete(); // Soft delete

        // Verify user is soft deleted
        $this->assertSoftDeleted('users', ['id' => $user->id]);

        // Authenticate as admin
        Sanctum::actingAs($admin);

        // Try to update the soft-deleted user
        $response = $this->putJson("/api/users/{$user->id}", [
            'name' => 'Updated Name',
            'email' => $user->email,
            'username' => $user->username,
        ]);

        // Should succeed (not return 404)
        $response->assertStatus(200);

        // Verify the user was updated
        $updatedUser = User::withTrashed()->find($user->id);
        $this->assertEquals('Updated Name', $updatedUser->name);
    }

    public function test_admin_can_suspend_soft_deleted_user()
    {
        // Create admin user
        $admin = User::factory()->create(['is_admin' => true]);

        // Create regular user and soft delete it
        $user = User::factory()->create();
        $user->delete(); // Soft delete

        // Verify user is soft deleted
        $this->assertSoftDeleted('users', ['id' => $user->id]);

        // Authenticate as admin
        Sanctum::actingAs($admin);

        // Try to suspend the soft-deleted user
        $response = $this->postJson("/api/users/{$user->id}/suspend");

        // Should succeed (not return 404)
        $response->assertStatus(200);

        // Verify the user was suspended
        $suspendedUser = User::withTrashed()->find($user->id);
        $this->assertTrue($suspendedUser->is_suspended);
    }

    public function test_non_admin_cannot_delete_user()
    {
        // Create regular users
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // Authenticate as non-admin
        Sanctum::actingAs($user1);

        // Try to delete another user
        $response = $this->deleteJson("/api/users/{$user2->id}");

        $response->assertStatus(403);
    }

    public function test_delete_nonexistent_user_returns_404()
    {
        // Create admin user
        $admin = User::factory()->create(['is_admin' => true]);

        // Authenticate as admin
        Sanctum::actingAs($admin);

        // Try to delete non-existent user
        $response = $this->deleteJson("/api/users/99999");

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Usuário não encontrado. O ID informado não existe ou foi removido.'
        ]);
    }
}
