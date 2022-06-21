<?php

namespace App\Http\Controllers;

use App\Enums\CartType;
use App\PromoCode;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class PromoCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('setup.promos.index');
    }

    public function datatable()
    {
        $promos = PromoCode::orderBy('code', 'ASC');


        return Datatables::eloquent($promos)->editColumn('code', function ($item) {

            return '<a href="' . route('promos.edit', $item->id) . '">' . $item->code . '</a>';
        })
            ->addColumn('value', function ($item) {
                return $item->value;
            })
            ->addColumn('action', function ($item) {

                return '<a class="btn btn-sm btn-danger delete-item" href="' . route('promos_delete', $item->id) . '"><i class="fas fa-minus-circle"></i></a>';
            })
            ->rawColumns([
                'code',
                'value',
                'action'
            ])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promo = null;
        return view('setup.promos.create', compact('promo'));
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
            'code' => 'required',
            'value' => 'required|numeric',
        ]);
        $users = [];

        PromoCode::create(
            [
                'code' => $request->code,
                'value' => $request->value,
                'users' => json_encode($users),
            ]
        );

        return redirect()->back()->withSuccess('promo Code Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function show(PromoCode $promo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function edit(PromoCode $promo)
    {
        return view('setup.promos.create', compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PromoCode $promo)
    {
        $request->validate([
            'code' => 'required',
            'value' => 'required|numeric',
        ]);
        $promo->update($request->all());
        return redirect()->back()->withSuccess('promo Code Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromoCode $promo)
    {
        $promo->delete();
        return redirect()->back()->withSuccess('Promo Code Deleted Successfully');
    }

    /**
     * Genreate promo code.
     */
    public function generateCode()
    {
        return Str::random(10);
    }

    // apply promo code
    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);

        $codeQuery = PromoCode::where('code', $request->code);
        $code = $codeQuery->first();
        if ($code) {
            // adding user in promo code users list
            $users = json_decode($code->users, true);
            if (in_array(auth()->id(), $users)) {
                // user has already apply code
                return redirect()->back()->with('error', 'You has already used coupon code.');
            } else {
                $users[] = auth()->id();
                $codeQuery->update(['users' => json_encode($users)]);
                // updating user balance in db
                $userWallet = DB::table('wallets')->where('user_id', auth()->id());
                $oldBalance = $userWallet->first()->balance;
                $newBalance = (float)$code->value + (float)$oldBalance;
                $userWallet->update(['balance' => $newBalance]);
                return redirect()->back()->with('success', 'Coupon Code Successfully Applied');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid Code');
        }
    }

    // apply promo code on payment secreen
    public function applyCodeOnPayment(Request $request, CartService $cart)
    {
        $codeQuery = PromoCode::where('code', $request->code);
        $code = $codeQuery->first();
        if ($code) {
            // adding user in promo code users list
            $users = json_decode($code->users, true);
            if (in_array(auth()->id(), $users)) {
                // user has already apply code
                return response()->json([
                    'error' => true,
                    'message' => 'You has already used coupon code.'
                ]);
            } else {
                $users[] = auth()->id();
                $codeQuery->update(['users' => json_encode($users)]);
                // apply code on amount and update cart ammount
                $newAmount = (float)$request->total - (float)$code->value;
                if ($newAmount < 0) {
                    $newAmount = 0;
                }
                $orderId = session()->get('cart')["order_id"];
                $orderNumber = session()->get('cart')["order_number"];
                $cartTotal = ltrim($newAmount, '$');
                $cart->setCart([
                    'order_id' => $orderId,
                    'order_number' => $orderNumber,
                    'cart_total' => $cartTotal
                ], CartType::NewOrder);


                return response()->json([
                    'error' => false,
                    'message' => 'Coupon Code Successfully Applied',
                    'amount' => format_money($newAmount),
                    'total' =>  $newAmount
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Invalid Code'
            ]);
        }
    }
}
