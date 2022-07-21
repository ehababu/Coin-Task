<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoinRequest;
use App\Http\Requests\UpdateCoinRequest;
use App\Models\Coin;
use Symfony\Component\HttpFoundation\Response;

class CoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coins = Coin::orderBy('created_at', 'DESC')->get();
        return response()->view('coins.index', compact('coins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('coins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoinRequest $request)
    {
        if($request->input('virtual')) {
            $vCoin = Coin::where('is_virtual', true)->get();
            if($vCoin->count() > 0) {
                return response()->json([
                    'message' => 'You can\'t create more than one virtual coin.'
                ], Response::HTTP_BAD_REQUEST);
            }
        }
            $coin = new Coin();
            $coin->name = $request->input('name');
            $coin->token = $request->input('token');
            $coin->max_decimal_numbers = $request->input('max');
            $coin->is_virtual = $request->input('virtual');
            $coin->is_active = $request->input('active');
            $isSaved = $coin->save();
            return response()->json([
                'message' => $isSaved ? 'Coin Created Successfully!' : 'Failed to create a coin, Please try again.',
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function show(Coin $coin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function edit(Coin $coin)
    {
        return response()->view('coins.edit', compact('coin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoinRequest $request, Coin $coin)
    {
        if($request->input('virtual')) {
            if(!$coin->is_virtual) {
                $vCoin = Coin::where('is_virtual', true)->get();
                if($vCoin->count() > 0) {
                    return response()->json([
                        'message' => 'There can\'t be more than one virtual coin'
                    ], Response::HTTP_BAD_REQUEST);
                }
            }
        }
            $coin->name = $request->input('name');
            $coin->token = $request->input('token');
            $coin->max_decimal_numbers = $request->input('max');
            $coin->is_virtual = $request->input('virtual');
            $coin->is_active = $request->input('active');

            $isSaved = $coin->save();
            return response()->json([
                'message' => $isSaved ? 'Coin Updated Successfully!' : 'Failed to update the coin, Please try again.',
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coin $coin)
    {
        $isDeleted = $coin->delete();
        return response()->json([
            'title' => $isDeleted ? 'Deleted!' : 'Failed',
            'message' => $isDeleted ? 'Coin Deleted Successfully!' : 'Failed to delete coin, Please try again.',
            'icon' => $isDeleted ? 'success' : 'error'
        ], $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }


    // //Function to toggle in the active Button
    // public function toggleActivation(Coin $coin) {

    //         $status = -1;
    //         if($coin->is_active) {
    //             $coin->is_active = false;
    //             $message = 'Coin Deactivated Successfully';
    //             $status = 2;
    //         } else {
    //             $coin->is_active = true;
    //             $message = 'Coin Activated Successfully';
    //             $status = 1;
    //         }
    //         $isSaved = $coin->save();
    //         return response()->json([
    //             'message' => $isSaved ? $message : 'Failed to toggle the coin, Please try again',
    //             'status' => $status,
    //         ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    // }
}
