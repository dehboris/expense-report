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
    public function api_routes_can_only_be_accessed_via_json_requests()
    {
        $this->withExceptionHandling();

        $this->be(factory(User::class)->create());
        $bucket = factory(Bucket::class)->create();

        $this->get(route('api.expense-report.buckets.index'))
            ->assertNotFound();

        $this->get(route('api.expense-report.buckets.show', $bucket))
            ->assertNotFound();

        $this->post(route('api.expense-report.buckets.store'))
            ->assertNotFound();

        $this->patch(route('api.expense-report.buckets.update', $bucket))
            ->assertNotFound();

        $this->delete(route('api.expense-report.buckets.destroy', $bucket))
            ->assertNotFound();
    }

    /** @test */
    public function user_can_create_bucket()
    {
        $this->be($user = factory(User::class)->create());
        $bucket = factory(Bucket::class)->make();

        $this->json('POST', route('api.expense-report.buckets.store'), $bucket->toArray())
            ->assertOk()
            ->assertJson([
                'status' => 'ok',
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
            factory(Bucket::class)->create(['user_id' => $jon->id, 'created_at' => now()->subWeek()]),
            factory(Bucket::class)->create(['user_id' => $jon->id, 'created_at' => now()->subDay()]),
            factory(Bucket::class)->create(['user_id' => $jon->id]),
        ];

        $janes_buckets = [
            factory(Bucket::class)->create(['user_id' => $jane->id, 'created_at' => now()->subWeek()]),
            factory(Bucket::class)->create(['user_id' => $jane->id, 'created_at' => now()->subDay()]),
            factory(Bucket::class)->create(['user_id' => $jane->id]),
        ];

        $this->json('GET', route('api.expense-report.buckets.index'))
            ->assertOk()
            ->assertJson([
                'data' => [
                    [
                        'name' => $jons_buckets[2]->name,
                        'description' => $jons_buckets[2]->description,
                    ],
                    [
                        'name' => $jons_buckets[1]->name,
                        'description' => $jons_buckets[1]->description,
                    ],
                    [
                        'name' => $jons_buckets[0]->name,
                        'description' => $jons_buckets[0]->description,
                    ],
                ],
            ])
            ->assertJsonMissing([
                'data' => [
                    [
                        'name' => $janes_buckets[2]->name,
                        'description' => $janes_buckets[2]->description,
                    ],
                    [
                        'name' => $janes_buckets[1]->name,
                        'description' => $janes_buckets[1]->description,
                    ],
                    [
                        'name' => $janes_buckets[0]->name,
                        'description' => $janes_buckets[0]->description,
                    ],
                ],
            ]);
    }

    /** @test */
    public function user_cannot_view_other_users_buckets()
    {
        $this->withExceptionHandling();

        $jane = factory(User::class)->create();
        $this->be($jon = factory(User::class)->create());

        $janes_bucket =factory(Bucket::class)->create(['user_id' => $jane->id]);

        $this->json('GET', route('api.expense-report.buckets.show', $janes_bucket))
            ->assertForbidden();
    }

    /** @test */
    public function user_can_view_own_bucket()
    {
        $this->be($jon = factory(User::class)->create());

        $jons_bucket = factory(Bucket::class)->create(['user_id' => $jon->id]);

        $this->json('GET', route('api.expense-report.buckets.show', $jons_bucket))
            ->assertOk()
            ->assertJson([
                'data' => [
                    'name' => $jons_bucket->name,
                    'description' => $jons_bucket->description,
                ],
            ]);
    }

    /** @test */
    public function user_cannot_edit_other_users_buckets()
    {
        $this->withExceptionHandling();

        $jane = factory(User::class)->create();
        $this->be($jon = factory(User::class)->create());

        $janes_bucket =factory(Bucket::class)->create(['user_id' => $jane->id]);

        $this->json('PATCH', route('api.expense-report.buckets.update', $janes_bucket))
            ->assertForbidden();
    }

    /** @test */
    public function user_can_update_own_buckets()
    {
        $this->be($jon = factory(User::class)->create());

        $jons_bucket = factory(Bucket::class)->create(['user_id' => $jon->id]);

        $this->json('PATCH', route('api.expense-report.buckets.update', $jons_bucket), [
            'name' => 'New Name',
            'description' => $jons_bucket->description,
        ])
            ->assertOk()
            ->assertJson([
                'status' => 'ok',
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
        $this->withExceptionHandling();

        $jane = factory(User::class)->create();
        $this->be($jon = factory(User::class)->create());

        $janes_bucket =factory(Bucket::class)->create(['user_id' => $jane->id]);

        $this->json('DELETE', route('api.expense-report.buckets.destroy', $janes_bucket))
            ->assertForbidden();
    }

    /** @test */
    public function user_can_delete_own_bucket()
    {
        $this->be($jon = factory(User::class)->create());

        $jons_bucket =factory(Bucket::class)->create(['user_id' => $jon->id]);

        $this->json('DELETE', route('api.expense-report.buckets.destroy', $jons_bucket))
            ->assertOk()
            ->assertJson([
                'status' => 'ok',
            ]);

        $this->assertDatabaseMissing('expense_report_buckets', [
            'user_id' => $jon->id,
            'name' => $jons_bucket->name,
            'description' => $jons_bucket->description,
        ]);
    }
}
