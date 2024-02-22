<?php

namespace App\Exports;

use App\Models\Donatur;
use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class RekapTransactionExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  Donatur::all();
    }

    public function view(): View
    {
        $transaction = Transaction::selectRaw('sum(nominal) as sum')->get();
        return view('exports.donaturs', [
            'donaturs' => Transaction::select('transactions.*','donaturs.nama','donaturs.kode','donaturs.nama_outlet','users.name')->leftJoin('donaturs','transactions.donatur_id','=','donaturs.id')->leftJoin('users','transactions.user_id','=','users.id')->get(),
            'transaction' => $transaction
        ]);
    }
}
