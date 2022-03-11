<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\StorePromoCodeRequest;
use App\Http\Requests\UpdatePromoCodeRequest;
use App\Http\Controllers\Controller;
use App\Models\PromoCode;

class PromoCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PromoCode::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePromoCodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromoCodeRequest $request)
    {
       $promoCode =  PromoCode::create($request->all());
       return $promoCode;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PromoCode  $promoCode
     * @return \Illuminate\Http\Response
     */
    public function show(PromoCode $promoCode)
    {
        dd($promoCode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePromoCodeRequest  $request
     * @param  \App\Models\PromoCode  $promoCode
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePromoCodeRequest $request, PromoCode $promoCode)
    {
        $promoCode->update($request->all());

        return $promoCode;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PromoCode  $promoCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromoCode $promoCode)
    {
        $promoCode->delete();

        return response('', 204);
    }
}
