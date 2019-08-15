<?php

namespace App\ExpenseReport;

use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BucketItem
 * @package App\ExpenseReport
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property int $amount
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property \App\ExpenseReport\Bucket $bucket
 */
class BucketItem extends Model
{
    protected $table = 'expense_report_bucket_items';

    protected $guarded = [];

    public const CREDIT = 'credit';

    public const DEBIT = 'debit';

    /**
     * Bucket relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bucket()
    {
        return $this->belongsTo(Bucket::class, 'bucket_id')
            ->orderBy('created_at');
    }

    /**
     * @return \Cknow\Money\Money
     */
    public function getAmountAttribute($value)
    {
        return Money::USD($value);
    }
}
