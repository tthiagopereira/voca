<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNumberRequest;
use App\Http\Requests\UpdateNumberRequest;
use App\Models\Number;

class NumbersApiController extends Controller
{
    public function index()
    {
        $numbers = Number::all();

        return $numbers;
    }

    public function store(StoreNumberRequest $request)
    {
        return Number::create($request->all());
    }

    public function update(UpdateNumberRequest $request, Number $product)
    {
        return $number->update($request->all());
    }

    public function show(Number $number)
    {
        return $number;
    }

    public function destroy(Number $number)
    {
        return $number->delete();
    }
}
