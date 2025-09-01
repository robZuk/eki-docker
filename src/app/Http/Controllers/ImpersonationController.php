<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonationController extends Controller
{
    public function impersonate($userId)
    {
        $user = \App\Models\User::findOrFail($userId);
        $originalUserId = Auth::id();
        session()->put('impersonator_id', $originalUserId);
        Auth::login($user);

        return redirect()->route('zasoby');
    }

    public function stopImpersonating()
    {
        $originalUserId = session('impersonator_id');
        session()->forget('impersonator_id');
        if ($originalUserId) {
            $user = \App\Models\User::findOrFail($originalUserId);
            Auth::login($user);
        } else {
            Auth::logout();
        }

        return redirect()->route('zasoby');
    }
}
