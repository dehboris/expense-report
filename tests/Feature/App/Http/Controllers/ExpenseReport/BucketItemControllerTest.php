<?php

namespace Tests\Feature\App\Http\Controllers\ExpenseReport;

use App\ExpenseReport\Bucket;
use App\ExpenseReport\BucketItem;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BucketItemControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function bucket_item_belongs_to_bucket()
    {
        $bucket_item = factory(BucketItem::class)->create();

        $this->assertInstanceOf(Bucket::class, $bucket_item->bucket);
    }

    /** @test */
    public function bucket_items_api_routes_can_only_be_accessed_via_json_requests()
    {
        $this->withExceptionHandling();

        $this->be($user = factory(User::class)->create());
        $bucket = factory(Bucket::class)->create(['user_id' => $user->id]);
        $bucket_item = factory(BucketItem::class)->create(['bucket_id' => $bucket->id]);

        $this->get(route('api.expense-report.buckets.items.index', $bucket))
            ->assertNotFound();

        $this->post(route('api.expense-report.buckets.items.store', $bucket))
            ->assertNotFound();

        $this->delete(route('api.expense-report.buckets.items.destroy', [$bucket, $bucket_item]))
            ->assertNotFound();
    }

    /** @test */
    public function user_cannot_create_bucket_item_on_not_owned_buckets()
    {
        $this->withExceptionHandling();

        $jane = factory(User::class)->create();
        $this->be($jon = factory(User::class)->create());

        $bucket = factory(Bucket::class)->create(['user_id' => $jane->id]);
        $bucket_item = factory(BucketItem::class)->make();

        $this->json('POST', route('api.expense-report.buckets.items.store', $bucket), $bucket_item->toArray())
            ->assertForbidden();
    }

    /** @test */
    public function user_can_create_bucket_item()
    {
        $this->be($user = factory(User::class)->create());
        $bucket = factory(Bucket::class)->create(['user_id' => $user->id]);

        $this->json('POST', route('api.expense-report.buckets.items.store', $bucket), [
            'name' => 'Test',
            'amount' => '125.50',
            'type' => 'credit',
        ])
            ->assertOk()
            ->assertJson([
                'status' => 'ok',
                'data' => [
                    'bucket_id' => $bucket->id,
                    'name' => 'Test',
                    'amount' => [
                        'amount' => '12550',
                        'currency' => 'USD',
                        'formatted' => '$125.50',
                    ],
                    'type' => 'credit',
                ],
            ]);

        $this->assertDatabaseHas('expense_report_bucket_items', [
            'bucket_id' => $bucket->id,
            'name' => 'Test',
            'amount' => '12550',
            'type' => 'credit',
        ]);
    }

    /** @test */
    public function bucketsIndex_only_show_that_bucket_items()
    {
        $jane = factory(User::class)->create();
        $this->be($jon = factory(User::class)->create());

        $jons_buckets = [
            factory(Bucket::class)->create(['user_id' => $jon->id, 'created_at' => now()->subWeek()]),
            factory(Bucket::class)->create(['user_id' => $jon->id]),
        ];

        $jons_bucket_items = [
            factory(BucketItem::class)->create(['bucket_id' => $jons_buckets[0]->id, 'created_at' => now()->subWeek()]),
            factory(BucketItem::class)->create(['bucket_id' => $jons_buckets[0]->id, 'created_at' => now()->subDay()]),
            factory(BucketItem::class)->create(['bucket_id' => $jons_buckets[1]->id]),
        ];

        $janes_buckets = [
            factory(Bucket::class)->create(['user_id' => $jane->id, 'created_at' => now()->subWeek()]),
        ];

        $janes_bucket_items = [
            factory(BucketItem::class)->create(['bucket_id' => $janes_buckets[0]->id, 'created_at' => now()->subWeek()]),
        ];

        $this->json('GET', route('api.expense-report.buckets.items.index', $jons_buckets[0]))
            ->assertOk()
            ->assertJson([
                'data' => [
                    [
                        'bucket_id' => (string) $jons_bucket_items[1]->bucket_id,
                    ],
                    [
                        'bucket_id' => (string) $jons_bucket_items[0]->bucket_id,
                    ],
                ],
            ])
            ->assertJsonMissing([
                'data' => [
                    [
                        'bucket_id' => (string) $janes_bucket_items[0]->bucket_id,
                    ],
                ],
            ])
            ->assertJsonMissing([
                'data' => [
                    [
                        'bucket_id' => (string) $jons_bucket_items[2]->bucket_id,
                    ],
                ],
            ]);
    }

    /** @test */
    public function user_cannot_delete_other_users_bucket_items()
    {
        $this->withExceptionHandling();

        $jane = factory(User::class)->create();
        $this->be($jon = factory(User::class)->create());

        $janes_bucket =factory(Bucket::class)->create(['user_id' => $jane->id]);
        $janes_bucket_item =factory(BucketItem::class)->create(['bucket_id' => $janes_bucket->id]);

        $this->json('DELETE', route('api.expense-report.buckets.items.destroy', $janes_bucket_item))
            ->assertForbidden();
    }

    /** @test */
    public function user_can_delete_own_bucket_item()
    {
        $this->be($jon = factory(User::class)->create());

        $bucket =factory(Bucket::class)->create(['user_id' => $jon->id]);
        $bucket_item =factory(BucketItem::class)->create(['bucket_id' => $bucket->id]);

        $this->json('DELETE', route('api.expense-report.buckets.items.destroy', $bucket_item))
            ->assertOk()
            ->assertJson([
                'status' => 'ok',
            ]);

        $this->assertDatabaseMissing('expense_report_buckets', [
            'bucket_id' => $jon->id,
            'name' => $bucket_item->name,
            'amount' => $bucket_item->amount,
        ]);
    }

    /** @test */
    public function values_less_than_zero_gets_trimmed()
    {
        $this->be($user = factory(User::class)->create());
        $bucket = factory(Bucket::class)->create(['user_id' => $user->id]);

        $this->json('POST', route('api.expense-report.buckets.items.store', $bucket), [
            'name' => 'Test',
            'amount' => '0.99',
            'type' => 'credit',
        ])
            ->assertOk()
            ->assertJson([
                'status' => 'ok',
                'data' => [
                    'bucket_id' => $bucket->id,
                    'name' => 'Test',
                    'amount' => [
                        'amount' => '99',
                        'currency' => 'USD',
                        'formatted' => '$0.99',
                    ],
                    'type' => 'credit',
                ],
            ]);

        $this->assertDatabaseHas('expense_report_bucket_items', [
            'bucket_id' => $bucket->id,
            'name' => 'Test',
            'amount' => '99',
            'type' => 'credit',
        ]);
    }
}
