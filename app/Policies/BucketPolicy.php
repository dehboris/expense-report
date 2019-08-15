<?php

namespace App\Policies;

use App\User;
use App\ExpenseReport\Bucket;
use Illuminate\Auth\Access\HandlesAuthorization;

class BucketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any buckets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the bucket.
     *
     * @param  \App\User  $user
     * @param  \App\ExpenseReport\Bucket  $bucket
     * @return mixed
     */
    public function view(User $user, Bucket $bucket)
    {
        return (int) $user->id === (int) $bucket->user_id;
    }

    /**
     * Determine whether the user can create buckets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the bucket.
     *
     * @param  \App\User  $user
     * @param  \App\ExpenseReport\Bucket  $bucket
     * @return mixed
     */
    public function update(User $user, Bucket $bucket)
    {
        return (int) $user->id === (int) $bucket->user_id;
    }

    /**
     * Determine whether the user can delete the bucket.
     *
     * @param  \App\User  $user
     * @param  \App\ExpenseReport\Bucket  $bucket
     * @return mixed
     */
    public function delete(User $user, Bucket $bucket)
    {
        return (int) $user->id === (int) $bucket->user_id;
    }

    /**
     * Determine whether the user can restore the bucket.
     *
     * @param  \App\User  $user
     * @param  \App\ExpenseReport\Bucket  $bucket
     * @return mixed
     */
    public function restore(User $user, Bucket $bucket)
    {
        return (int) $user->id === (int) $bucket->user_id;
    }

    /**
     * Determine whether the user can permanently delete the bucket.
     *
     * @param  \App\User  $user
     * @param  \App\ExpenseReport\Bucket  $bucket
     * @return mixed
     */
    public function forceDelete(User $user, Bucket $bucket)
    {
        return (int) $user->id === (int) $bucket->user_id;
    }
}
