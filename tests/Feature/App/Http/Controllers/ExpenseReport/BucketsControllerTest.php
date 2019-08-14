<?php

namespace Tests\Feature\App\Http\Controllers\ExpenseReport;

use App\ExpenseReport\Bucket;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BucketsControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function bucket_belongs_to_user()
    {
        $bucket = factory(Bucket::class)->create();

        $this->assertInstanceOf(User::class, $bucket->owner);
    }

    /** @test */
    public function only_logged_in_users_can_access_buckets()
    {
        $this->withExceptionHandling();

        $this->get(route('expense-report.buckets.index'))
            ->assertRedirect('/login');

        $this->get(route('expense-report.buckets.create'))
            ->assertRedirect('/login');

        $this->post(route('expense-report.buckets.store'))
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_create_bucket()
    {
        $this->be($user = factory(User::class)->create());

        $bucket = factory(Bucket::class)->make();

        $this->get(route('expense-report.buckets.create'))
            ->assertViewIs('expense-report.buckets.create')
            ->assertOk();

        $this->post(route('expense-report.buckets.store'), $bucket->toArray())
            ->assertRedirect(route('expense-report.buckets.index'))
            ->assertSessionHas('flash', [
                'type' => 'success',
                'message' => 'Bucket created successfully',
            ]);

        $this->assertDatabaseHas('expense_report_buckets', [
            'user_id' => $user->id,
            'name' => $bucket->name,
            'description' => $bucket->description,
        ]);
    }

    /** @test */
    public function bucketsIndex_only_show_user_created_buckets()
    {
        $jane = factory(User::class)->create();
        $this->be($jon = factory(User::class)->create());

        $jons_buckets = [
            factory(Bucket::class)->create(['user_id' => $jon->id]),
            factory(Bucket::class)->create(['user_id' => $jon->id]),
            factory(Bucket::class)->create(['user_id' => $jon->id]),
        ];

        $janes_buckets = [
            factory(Bucket::class)->create(['user_id' => $jane->id]),
            factory(Bucket::class)->create(['user_id' => $jane->id]),
            factory(Bucket::class)->create(['user_id' => $jane->id]),
        ];

        $this->get(route('expense-report.buckets.index'))
            ->assertOk()
            ->assertViewIs('expense-report.buckets.index')
            ->assertSee($jons_buckets[0]->name)
            ->assertSee($jons_buckets[1]->name)
            ->assertSee($jons_buckets[2]->name)
            ->assertDontSee($janes_buckets[0]->name)
            ->assertDontSee($janes_buckets[1]->name)
            ->assertDontSee($janes_buckets[2]->name);
    }

    /** @test */
    public function user_cannot_view_other_users_buckets()
    {
        $jane = factory(User::class)->create();
        $this->be($jon = factory(User::class)->create());

        $janes_bucket =factory(Bucket::class)->create(['user_id' => $jane->id]);

        $this->get(route('expense-report.buckets.show', $janes_bucket))
            ->assertRedirect(route('expense-report.buckets.index'))
            ->with('flash', [
                'type' => 'danger',
                'message' => 'You do not have access to that bucket'
            ]);
    }

    /** @test */
    public function user_can_view_own_bucket()
    {
        $this->be($jon = factory(User::class)->create());

        $jons_bucket = factory(Bucket::class)->create(['user_id' => $jon->id]);

        $this->get(route('expense-report.buckets.show', $jons_bucket))
            ->assertOk()
            ->assertViewIs('expense-report.buckets.show');
    }

    /** @test */
    public function user_cannot_edit_other_users_buckets()
    {
        $jane = factory(User::class)->create();
        $this->be($jon = factory(User::class)->create());

        $janes_bucket =factory(Bucket::class)->create(['user_id' => $jane->id]);

        $this->get(route('expense-report.buckets.edit', $janes_bucket))
            ->assertRedirect(route('expense-report.buckets.index'))
            ->with('flash', [
                'type' => 'danger',
                'message' => 'You do not have access to that bucket'
            ]);

        $this->patch(route('expense-report.buckets.update', $janes_bucket))
            ->assertRedirect(route('expense-report.buckets.index'))
            ->with('flash', [
                'type' => 'danger',
                'message' => 'You do not have access to that bucket'
            ]);
    }

    /** @test */
    public function user_can_update_buckets()
    {
        $this->be($jon = factory(User::class)->create());

        $jons_bucket = factory(Bucket::class)->create(['user_id' => $jon->id]);

        $this->get(route('expense-report.buckets.edit', $jons_bucket))
            ->assertOk()
            ->assertViewIs('expense-report.buckets.edit');

        $this->patch(route('expense-report.buckets.update', $jons_bucket), [
            'name' => 'New Name',
            'description' => $jons_bucket->description,
        ])
            ->assertRedirect(route('expense-report.buckets.show', $jons_bucket))
            ->assertSessionHas('flash', [
                'type' => 'success',
                'message' => 'Bucket updated successfully'
            ]);

        $this->assertDatabaseHas('expense_report_buckets', [
            'user_id' => $jon->id,
            'name' => 'New Name',
            'description' => $jons_bucket->description,
        ]);
    }

    /** @test */
    public function user_cannot_delete_other_users_buckets()
    {
        $jane = factory(User::class)->create();
        $this->be($jon = factory(User::class)->create());

        $janes_bucket =factory(Bucket::class)->create(['user_id' => $jane->id]);

        $this->delete(route('expense-report.buckets.destroy', $janes_bucket))
            ->assertRedirect(route('expense-report.buckets.index'))
            ->with('flash', [
                'type' => 'danger',
                'message' => 'You do not have access to that bucket'
            ]);
    }

    /** @test */
    public function user_can_delete_own_bucket()
    {
        $this->be($jon = factory(User::class)->create());

        $jons_bucket =factory(Bucket::class)->create(['user_id' => $jon->id]);

        $this->delete(route('expense-report.buckets.destroy', $jons_bucket))
            ->assertRedirect(route('expense-report.buckets.index'))
            ->with('flash', [
                'type' => 'success',
                'message' => 'Bucket deleted successfully',
            ]);

        $this->assertDatabaseMissing('expense_report_buckets', [
            'user_id' => $jon->id,
            'name' => $jons_bucket->name,
            'description' => $jons_bucket->description,
        ]);
    }
}
