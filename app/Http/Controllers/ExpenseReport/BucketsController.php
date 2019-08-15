<?php

namespace App\Http\Controllers\ExpenseReport;

use App\ExpenseReport\Bucket;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BucketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Auth::user()->buckets()->orderByDesc('created_at')->paginate(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
        ]);

        Bucket::create(array_merge(
            [ 'user_id' => $request->user()->id ],
            $request->only('name', 'description')
        ));

        return response()->json([
            'status' => 'ok',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExpenseReport\Bucket  $bucket
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Bucket $bucket)
    {
        $this->authorize('view', $bucket);

        return response()->json([
            'data' => $bucket,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExpenseReport\Bucket  $bucket
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Bucket $bucket)
    {
        $this->authorize('update', $bucket);

        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
        ]);

        $bucket->update($request->only(['name', 'description']));

        return response()->json([
            'status' => 'ok',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExpenseReport\Bucket  $bucket
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Bucket $bucket)
    {
        $this->authorize('delete', $bucket);

        $bucket->delete();

        return response()->json([
            'status' => 'ok',
        ], 200);
    }
}
