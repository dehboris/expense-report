<?php

namespace App\ExpenseReport;

use App\User;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class ExpenseReportBucket
 * @package App
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property \App\User $user_id
 * @property \App\ExpenseReport\BucketItem $items
 */
class Bucket extends Model
{
    protected $table = 'expense_report_buckets';

    protected $guarded = [];

    protected $appends = [
        'balance',
    ];

    /**
     * Owner relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Bucket Items relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(BucketItem::class, 'bucket_id')
            ->orderByDesc('created_at');
    }

    public function getBalanceAttribute()
    {
        return Money::USD((int) BucketItem::where('type', 'credit')->where('bucket_id', $this->id)->sum('amount'))
            ->subtract(Money::USD((int) BucketItem::where('type', 'debit')->where('bucket_id', $this->id)->sum('amount')));
    }
}
