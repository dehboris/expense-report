<?php

namespace App\Policies;

use App\ExpenseReport\Bucket;
use App\User;
use App\ExpenseReport\BucketItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class BucketItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any bucket items.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the bucket item.
     *
     * @param  \App\User  $user
     * @param  \App\ExpenseReport\BucketItem  $bucketItem
     * @param  \App\ExpenseReport\Bucket  $bucket
     *
     * @return mixed
     */
    public function view(User $user, BucketItem $bucketItem, Bucket $bucket)
    {
        return (int) $user->id === (int) $bucket->user_id;
    }

    /**
     * Determine whether the user can create bucket items.
     *
     * @param  \App\User  $user
     * @param  \App\ExpenseReport\BucketItem  $bucketItem
     * @param  \App\ExpenseReport\Bucket  $bucket
     *
     * @return mixed
     */
    public function create(User $user, BucketItem $bucketItem, Bucket $bucket)
    {
        return (int) $user->id === (int) $bucket->user_id;
    }

    /**
     * Determine whether the user can update the bucket item.
     *
     * @param  \App\User  $user
     * @param  \App\ExpenseReport\BucketItem  $bucketItem
     * @return mixed
     */
    public function update(User $user, BucketItem $bucketItem)
    {
        return (int) $user->id === (int) $bucketItem->bucket->user_id;
    }

    /**
     * Determine whether the user can delete the bucket item.
     *
     * @param  \App\User  $user
     * @param  \App\ExpenseReport\BucketItem  $bucketItem
     * @return mixed
     */
    public function delete(User $user, BucketItem $bucketItem)
    {
        return (int) $user->id === (int) $bucketItem->bucket->user_id;
    }

    /**
     * Determine whether the user can restore the bucket item.
     *
     * @param  \App\User  $user
     * @param  \App\ExpenseReport\BucketItem  $bucketItem
     * @return mixed
     */
    public function restore(User $user, BucketItem $bucketItem)
    {
        return (int) $user->id === (int) $bucketItem->bucket->user_id;
    }

    /**
     * Determine whether the user can permanently delete the bucket item.
     *
     * @param  \App\User  $user
     * @param  \App\ExpenseReport\BucketItem  $bucketItem
     * @return mixed
     */
    public function forceDelete(User $user, BucketItem $bucketItem)
    {
        return (int) $user->id === (int) $bucketItem->bucket->user_id;
    }
}
