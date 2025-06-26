<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * @group Authentication
 *
 * APIs for user authentication and account management
 */
class AuthController extends Controller
{
    /**
     * Register a new user
     *
     * Create a new user account. Email verification is required before login.
     *
     * @bodyParam username string required The unique username. Example: john_doe
     * @bodyParam name string required The user's full name. Example: John Doe
     * @bodyParam email string required The user's email address. Example: john@example.com
     * @bodyParam password string required The user's password (min 8 characters). Example: password123
     * @bodyParam birth_date string required The user's birth date (YYYY-MM-DD). Example: 1990-01-01
     *
     * @response 201 {
     *   "message": "Registration successful. Please verify your email.",
     *   "data": {
     *     "id": 1,
     *     "username": "john_doe",
     *     "name": "John Doe",
     *     "email": "john@example.com",
     *     "birth_date": "1990-01-01"
     *   }
     * }
     */
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users',
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
            'birth_date' => 'required|date',
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birth_date' => $request->birth_date,
        ]);

        event(new Registered($user));

        return response()->json([
            'message' => 'Registro realizado com sucesso. Por favor, verifique seu e-mail.',
            'data' => $user
        ], 201);
    }

    /**
     * Login user
     *
     * Authenticate user and return access token. Email must be verified.
     *
     * @bodyParam email string required The user's email address. Example: john@example.com
     * @bodyParam password string required The user's password. Example: password123
     *
     * @response 200 {
     *   "message": "Login successful",
     *   "data": {
     *     "user": {
     *       "id": 1,
     *       "username": "john_doe",
     *       "name": "John Doe",
     *       "email": "john@example.com"
     *     },
     *     "token": "1|abc123def456..."
     *   }
     * }
     *
     * @response 403 {
     *   "message": "Please verify your email before logging in."
     * }
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }

        $user = Auth::user();

        if (!$user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Por favor, verifique seu e-mail antes de fazer login.'
            ], 403);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Login realizado com sucesso',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ]);
    }

    /**
     * Logout user
     *
     * Revoke the current access token and logout the user.
     *
     * @authenticated
     * @header Authorization Bearer {YOUR_AUTH_KEY}
     *
     * @response 200 {
     *   "message": "Logout successful"
     * }
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso'
        ]);
    }

    /**
     * Get authenticated user
     *
     * Retrieve the currently authenticated user's information.
     *
     * @authenticated
     * @header Authorization Bearer {YOUR_AUTH_KEY}
     *
     * @response 200 {
     *   "data": {
     *     "id": 1,
     *     "username": "john_doe",
     *     "name": "John Doe",
     *     "email": "john@example.com",
     *     "birth_date": "1990-01-01",
     *     "avatar_url": null,
     *     "is_admin": false,
     *     "is_suspended": false,
     *     "email_verified_at": "2024-01-01T12:00:00.000000Z",
     *     "created_at": "2024-01-01T12:00:00.000000Z",
     *     "updated_at": "2024-01-01T12:00:00.000000Z"
     *   }
     * }
     */
    public function user(Request $request)
    {
        return response()->json([
            'data' => $request->user()
        ]);
    }

    /**
     * Verify email address
     *
     * Verify a user's email address using the verification link sent via email.
     *
     * @urlParam id integer required The user ID. Example: 1
     * @urlParam hash string required The verification hash. Example: abc123def456
     *
     * @response 200 {
     *   "message": "Email verified successfully"
     * }
     * @response 400 {
     *   "message": "Invalid verification link"
     * }
     * @response 404 {
     *   "message": "User not found"
     * }
     */
    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));
        $frontendUrl = config('app.frontend_url', 'http://localhost:3000');

        if (!$user) {
            return view('auth-result', [
                'title' => 'Verificação de E-mail',
                'success' => false,
                'message' => 'Usuário não encontrado',
                'description' => 'O link de verificação não é válido ou o usuário não existe.',
                'type' => 'email_verification',
                'frontendUrl' => $frontendUrl
            ]);
        }

        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            return view('auth-result', [
                'title' => 'Verificação de E-mail',
                'success' => false,
                'message' => 'Link de verificação inválido',
                'description' => 'O link de verificação expirou ou não é válido. Solicite um novo link de verificação.',
                'type' => 'email_verification',
                'frontendUrl' => $frontendUrl
            ]);
        }

        if ($user->hasVerifiedEmail()) {
            return view('auth-result', [
                'title' => 'Verificação de E-mail',
                'success' => true,
                'message' => 'E-mail já verificado',
                'description' => 'Seu e-mail já foi verificado anteriormente. Você pode fazer login normalmente.',
                'type' => 'email_verification',
                'frontendUrl' => $frontendUrl
            ]);
        }

        $user->markEmailAsVerified();

        return view('auth-result', [
            'title' => 'Verificação de E-mail',
            'success' => true,
            'message' => 'E-mail verificado com sucesso!',
            'description' => 'Seu e-mail foi verificado com sucesso. Agora você pode fazer login na sua conta.',
            'type' => 'email_verification',
            'frontendUrl' => $frontendUrl
        ]);
    }

    /**
     * Send password reset link
     *
     * Send a password reset link to the user's email address.
     *
     * @bodyParam email string required The user's email address. Example: john@example.com
     *
     * @response 200 {
     *   "message": "Password reset link sent"
     * }
     * @response 400 {
     *   "message": "Unable to send reset link"
     * }
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "email": ["The selected email is invalid."]
     *   }
     * }
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Link de redefinição de senha enviado']);
        }

        return response()->json(['message' => 'Não foi possível enviar o link de redefinição'], 400);
    }

    /**
     * Reset password
     *
     * Reset the user's password using the reset token received via email.
     *
     * @bodyParam token string required The password reset token. Example: abc123def456
     * @bodyParam email string required The user's email address. Example: john@example.com
     * @bodyParam password string required The new password (min 8 characters). Example: newpassword123
     * @bodyParam password_confirmation string required Password confirmation. Example: newpassword123
     *
     * @response 200 {
     *   "message": "Password reset successfully"
     * }
     * @response 400 {
     *   "message": "Unable to reset password"
     * }
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "password": ["The password confirmation does not match."]
     *   }
     * }
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Senha redefinida com sucesso']);
        }

        return response()->json(['message' => 'Não foi possível redefinir a senha'], 400);
    }

    /**
     * Show password reset form
     *
     * Display the password reset form with the token.
     *
     * @urlParam token string required The password reset token. Example: abc123def456
     * @urlParam email string required The user's email address. Example: john@example.com
     */
    public function showResetForm(Request $request, $token)
    {
        $frontendUrl = config('app.frontend_url', 'http://localhost:3000');
        $email = $request->query('email');

        if (!$email || !$token) {
            return view('auth-result', [
                'title' => 'Redefinição de Senha',
                'success' => false,
                'message' => 'Link inválido',
                'description' => 'O link de redefinição de senha é inválido ou está incompleto.',
                'type' => 'password_reset',
                'frontendUrl' => $frontendUrl
            ]);
        }

        // Redirect to frontend with token and email
        return redirect()->to($frontendUrl . '/reset-password?token=' . $token . '&email=' . urlencode($email));
    }

    /**
     * Resend email verification
     *
     * Resend the email verification notification to the authenticated user.
     *
     * @authenticated
     * @header Authorization Bearer {YOUR_AUTH_KEY}
     *
     * @response 200 {
     *   "message": "Verification email sent"
     * }
     * @response 200 {
     *   "message": "Email already verified"
     * }
     */
    public function resendVerification(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'E-mail já verificado']);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'E-mail de verificação enviado']);
    }
}
