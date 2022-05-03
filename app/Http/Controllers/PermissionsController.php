<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, Closure $next) {
            if (!Auth::getUser()->hasPermission('permissions.admin')) {
                throw new AuthorizationException();
            }
            return $next($request);
        });
    }

    public function upload(Request $request): RedirectResponse
    {
        Storage::putFileAs('', $request->file('permissions'), 'permissions.yaml');
        Cache::forget('permissions');
        return redirect()->route('home', ['permissions' => 1]);
    }

    public function download(): BinaryFileResponse
    {
        return response()->download(Storage::path('permissions.yaml'));
    }
}
