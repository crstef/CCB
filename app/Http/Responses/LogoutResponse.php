<?php

namespace App\Http\Responses;

use Filament\Http\Responses\Auth\Contracts\LogoutResponse as Responsable;
use Illuminate\Http\RedirectResponse;

class LogoutResponse implements Responsable
{
    public function toResponse($request): RedirectResponse
    {
        // Clear any intended URL to prevent redirect to admin panel
        $request->session()->forget('url.intended');
        
        return redirect('/');
    }
}