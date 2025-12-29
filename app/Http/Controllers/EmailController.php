<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;

class EmailController extends Controller
{
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'nullable|string',
        ]);

        $email = $request->email;
        $name = $request->name;

        // Get the user with this email
        $user = User::where('email', $email)->first();

        // If user exists and is already verified
        if ($user && $user->verified == 1) {
            return response()->json([
                'status' => 'already_verified',
                'message' => 'Email is already verified'
            ]);
        }

        // If user exists but not verified
        if ($user && $user->verified == 0) {
            // Generate a random 6-digit code
            $verificationCode = random_int(100000, 999999);

            // Save the code to the database
            $user->email_code = $verificationCode;
            $user->save();

            // Send the verification code via email
            try {
                Mail::to($user->email)->send(new VerificationCodeMail($verificationCode, $user->name));

                return response()->json([
                    'status' => 'code_sent',
                    'message' => 'Verification code sent to your email'
                ]);
            } catch (\Exception $e) {
                \Log::error('Email sending failed: ' . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to send verification email: ' . $e->getMessage()
                ], 500);
            }
        }

        // If email does not exist in DB - create new user
        if (!$user) {
            // Generate a random 6-digit code
            $verificationCode = random_int(100000, 999999);

            // Create new user
            $newUser = User::create([
                'name' => $name ?? 'User',
                'email' => $email,
                'email_code' => $verificationCode,
                'role' => 'User',
                'verified' => false
            ]);

            // Send the verification code via email
            try {
                Mail::to($newUser->email)->send(new VerificationCodeMail($verificationCode, $newUser->name));

                return response()->json([
                    'status' => 'code_sent',
                    'message' => 'Verification code sent to your email'
                ]);
            } catch (\Exception $e) {
                \Log::error('Email sending failed: ' . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to send verification email: ' . $e->getMessage()
                ], 500);
            }
        }
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        if ($user->email_code == $request->code) {
            $user->verified = true;
            $user->email_verified_at = now();
            $user->email_code = null; // Clear the code after verification
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Email verified successfully'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid verification code'
        ], 400);
    }
}
