<?php

namespace App\Http\Controllers;

use App\ExpenseReportBucket;
use Illuminate\Http\Request;

class ExpenseReportBucketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('expense-report.buckets.index')
            ->with([
                'buckets' => $request->user()->buckets,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expense-report.buckets.create');
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

        ExpenseReportBucket::create(array_merge(
            [ 'user_id' => $request->user()->id ],
            $request->only('name', 'description')
        ));

        return redirect(route('expense-report.buckets.index'))
            ->with('flash', [
                'type' => 'success',
                'message' => 'Bucket created successfully',
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExpenseReportBucket  $bucket
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ExpenseReportBucket $bucket)
    {
        if ((int) $bucket->owner->id !== (int) $request->user()->id) {
            return redirect(route('expense-report.buckets.index'))
                ->with('flash', [
                    'type' => 'danger',
                    'message' => 'You do not have access to that bucket',
                ]);
        }

        return view('expense-report.buckets.show')
            ->with([
                'bucket' => $bucket,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExpenseReportBucket  $bucket
     *
     * @return void
     */
    public function edit(Request $request, ExpenseReportBucket $bucket)
    {
        if ((int) $bucket->owner->id !== (int) $request->user()->id) {
            return redirect(route('expense-report.buckets.index'))
                ->with('flash', [
                    'type' => 'danger',
                    'message' => 'You do not have access to that bucket',
                ]);
        }

        return view('expense-report.buckets.edit')
            ->with([
                'bucket' => $bucket,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExpenseReportBucket  $bucket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseReportBucket $bucket)
    {
        if ((int) $bucket->owner->id !== (int) $request->user()->id) {
            return redirect(route('expense-report.buckets.index'))
                ->with('flash', [
                    'type' => 'danger',
                    'message' => 'You do not have access to that bucket',
                ]);
        }

        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
        ]);

        $bucket->update($request->only(['name', 'description']));

        return redirect(route('expense-report.buckets.show', $bucket))
            ->with('flash', [
                'type' => 'success',
                'message' => 'Bucket updated successfully',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExpenseReportBucket  $bucket
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, ExpenseReportBucket $bucket)
    {
        if ((int) $bucket->owner->id !== (int) $request->user()->id) {
            return redirect(route('expense-report.buckets.index'))
                ->with('flash', [
                    'type' => 'danger',
                    'message' => 'You do not have access to that bucket',
                ]);
        }

        $bucket->delete();

        return redirect(route('expense-report.buckets.index'))
            ->with('flash', [
                'type' => 'success',
                'message' => 'Bucket deleted successfully'
            ]);
    }
}
