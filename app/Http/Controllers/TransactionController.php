<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Transaction as Transactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $transaction = DB::table('transactions')
        //     ->join('users', 'users.id', '=', 'transactions.user_id')
        //     ->join('donaturs', 'donaturs.id', '=', 'transactions.donatur_id')
        //     ->select('users.name', 'donaturs.nama', 'transactions.*')
        //     ->get();
        $transaction = Transaction::with('user')->with('donatur')->orderBy('created_at','desc')->paginate(5);
        return view('transaksi.index', ['transactions' => $transaction]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('transaksi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Transactions $request)
    {
        $validateData = $request->validated();
        // dump($validateData);
        $validateData['user_id'] = Auth::user()->id;
        Transaction::create($validateData);
        return redirect('transactions')->with('pesan', 'Transaksi '.request()->post('nama').' berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('transaksi.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction): JsonResponse
    {
        $validateData = $request->validate([
            'keterangan' => 'required',
            'nominal' => 'required',
            'status' => 'required',
        ]);

        $transaction->update($validateData);

        return response()->json(['success' => 'Update data berhasil.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction): JsonResponse
    {
        $transaction->delete();
        return response()->json(['success' => 'Hapus data berhasil.']);
    }
}
