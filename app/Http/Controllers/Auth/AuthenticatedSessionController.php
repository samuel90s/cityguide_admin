<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $credentials = filter_var($request->id_user, FILTER_VALIDATE_EMAIL)
            ? ['email' => $request->id_user]
            : ['username' => $request->id_user];
        $credentials['password'] = $request->password;

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'id_user' => __('auth.failed'),
            ]);
        }

        $user = $request->user();

        // Untuk API
        if ($request->wantsJson()) {
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ]);
        }

        // Untuk Web
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        if ($request->wantsJson()) {
            $token = $request->user()->currentAccessToken();

            if (!$token) {
                return response()->json([
                    'success' => false,
                    'message' => 'No valid token found',
                ], 400);
            }

            // Revoke the current token
            $token->delete();

            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully',
            ]);
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
