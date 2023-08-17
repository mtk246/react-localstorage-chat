<?php

namespace App\Http\Controllers\BillingCompany;

use App\Actions\BillingCompany\GetKeyboardShortcut;
use App\Actions\BillingCompany\StoreKeyboardShortcut;
use App\Http\Controllers\Controller;
use App\Http\Requests\BillingCompany\StoreKeyboardShortcutRequest;
use App\Models\BillingCompany;
use Illuminate\Http\JsonResponse;

final class KeyboardShortcutController extends Controller
{
    public function index(GetKeyboardShortcut $getKeyboardShortcut): JsonResponse
    {
        $rs = $getKeyboardShortcut->getAll();

        return response()->json($rs);
    }

    public function show(GetKeyboardShortcut $getKeyboardShortcut, int $id): JsonResponse
    {
        $rs = $getKeyboardShortcut->getSingle($id);

        return response()->json($rs);
    }

    public function store(
        StoreKeyboardShortcutRequest $request,
        StoreKeyboardShortcut $storeKeyboardShortcut,
        BillingCompany $billingCompany,
    ): JsonResponse {
        $rs = $storeKeyboardShortcut->invoke($request->toArray(), $billingCompany);

        return response()->json($rs);
    }
}
