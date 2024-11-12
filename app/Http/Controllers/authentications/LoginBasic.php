<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginBasic extends Controller
{
  /**
   * Display the login page or redirect to the dashboard if already logged in.
   *
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
   */
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];

    // Check if the user is authenticated
    // If authenticated, redirect to the dashboard
    // Otherwise, show the login page
    return Auth::check() ? redirect()->route('dashboard') : view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
  }

  /**
   * Handle the login request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function loginRequest(Request $request)
  {
    $credentials = $request->only('email', 'password');
    $response = [
      'status' => 'error',
      'message' => 'Oops! You have entered invalid credentials'
    ];

    // Attempt to authenticate the user with the provided credentials
    if (Auth::attempt($credentials)) {
      $response = [
        'status' => 'success',
        'message' => 'You are logged in',
        'url' => route('dashboard')
      ];
    }

    // Return the response as JSON
    return response()->json($response);
  }

  /**
   * Log the user out and redirect to the login page.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function logout(Request $request)
  {
    // Log the user out
    Auth::logout();

    // Redirect to the login page
    return redirect()->route('auth-login');
  }
}
