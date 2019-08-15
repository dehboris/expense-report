<?php

namespace App\Http\Livewire\ExpenseReport\Buckets;

use App\ExpenseReport\Bucket;
use App\ExpenseReport\BucketItem;
use Livewire\Component;

class Show extends Component
{
    public $bucket;
    public $balance;

    public $name;
    public $amount;
    public $type = 'debit';

    protected $listeners = ['updateBucket' => 'updateBucket'];

    public function mount(Bucket $bucket)
    {
        $this->bucket = $bucket;
        $this->balance = $this->getBalance();
    }

    public function render()
    {
        return view('livewire.expense-report.buckets.show');
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|string|regex:/^\d+\.\d{2}$/',
            'type' => 'required|string',
        ], [
            'name.required' => 'The title field is required.',
            'amount.regex' => 'Must be in xxx.xx format.'
        ]);

        BucketItem::create([
            'bucket_id' => $this->bucket['id'],
            'name' => $this->name,
            'amount' => ltrim(str_replace('.', '', $this->amount), '0'),
            'type' => $this->type,
        ]);

        $this->name = '';
        $this->amount = '';
        $this->type = 'debit';

        $this->bucket = Bucket::find($this->bucket['id']);
    }

    public function updateBucket($bucket_id)
    {
        $this->bucket = Bucket::find($bucket_id);
        $this->balance = $this->getBalance();
    }

    public function getBalance()
    {
        $amount = is_array($this->bucket) ? $this->bucket['balance']['amount'] : $this->bucket['balance']->getAmount();

        $wholeDollar = substr($amount, 0, \Illuminate\Support\Str::length($amount) - 2);
        $cents = substr($amount, \Illuminate\Support\Str::length($amount) - 2);
        $cents = $cents == 0 ? '00' : $cents;

        return [
            'amount' => $amount,
            'formatted' => ltrim(number_format((int) $wholeDollar) . '.' . $cents, '-'),
        ];
    }
}
