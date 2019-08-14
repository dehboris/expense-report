<?php

namespace App\ExpenseReport;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpenseReportBucket
 * @package App
 *
 * @property \App\User $owner
 */
class ExpenseReportBucket extends Model
{
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
