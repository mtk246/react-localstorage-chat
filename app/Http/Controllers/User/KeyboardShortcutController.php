<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\BillingCompany\GetKeyboardShortcut;
use App\Actions\BillingCompany\StoreKeyboardShortcut;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreKeyboardShortcutRequest;
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
        StoreKeyboardShortcut $storeKeyboardShortcut
    ): JsonResponse {
        $rs = $storeKeyboardShortcut->invoke($request->toArray(), $request->user());

        return response()->json($rs);
    }
}
