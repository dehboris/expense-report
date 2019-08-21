<?php

namespace App\Http\Controllers\ExpenseReport;

use App\ExpenseReport\Bucket;
use App\ExpenseReport\BucketItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BucketItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\ExpenseReport\Bucket  $bucket
     *
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Bucket $bucket)
    {
        $this->authorize('view', [new BucketItem(), $bucket]);

        return response()->json($bucket->items()->orderByDesc('created_at')->paginate(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @param  \App\ExpenseReport\Bucket  $bucket
     *
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, Bucket $bucket)
    {
        $this->authorize('create', [new BucketItem(), $bucket]);

        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|string|regex:/^\d+\.\d{2}$/',
            'type' => 'required|string',
        ], [
            'name.required' => 'Title field is required.',
            'amount.regex' => 'Amount must be in the following format: xxxx.xx'
        ]);

        $bucket_item = BucketItem::create([
            'bucket_id' => $bucket->id,
            'name' => $request->get('name'),
            'amount' => str_replace('.', '', $request->get('amount')),
            'type' => $request->get('type'),
        ]);

        return response()->json([
            'status' => 'ok',
            'data' => $bucket_item,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExpenseReport\BucketItem  $bucketItem
     *
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy(BucketItem $bucketItem)
    {
        $this->authorize('delete', $bucketItem);

        $bucketItem->delete();

        return response()->json([
            'status' => 'ok'
        ], 200);
    }
}
