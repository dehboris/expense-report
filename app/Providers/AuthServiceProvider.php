<?php

namespace App\Providers;

use App\ExpenseReport\Bucket;
use App\ExpenseReport\BucketItem;
use App\Policies\BucketItemPolicy;
use App\Policies\BucketPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Bucket::class => BucketPolicy::class,
        BucketItem::class => BucketItemPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
