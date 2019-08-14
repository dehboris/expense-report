<?php

namespace App\ExpenseReport;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpenseReportBucket
 * @package App
 *
 * @property \App\User $owner
 */
class Bucket extends Model
{
    protected $table = 'expense_report_buckets';

    protected $guarded = [];

    /**
     * Owner relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
