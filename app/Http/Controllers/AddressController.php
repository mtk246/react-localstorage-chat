<?php

namespace App\Http\Controllers;

use App\Repositories\AddressRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class AddressController extends Controller
{
    public function __construct(private AddressRepository $addressRepository)
    {
    }

    public function getListCountries(): JsonResponse
    {
        return response()->json(
            $this->addressRepository->getListCountries(),
        );
    }

    public function getListStates(Request $request): JsonResponse
    {
        return response()->json(
            $this->addressRepository->getListStates($request->input()),
        );
    }
}
