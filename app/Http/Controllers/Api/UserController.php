<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
// get user controller
    public function user(Request $request) {
        return response()->json($request->user());
    }
// login controller
    public function login(LoginRequest $request) {

        $user = User::where('email', $request->email)->first();

        if (Hash::check($request->password, $user->password)) {
            $tokenResult = $user->createToken('Personal Access Token');

            $token = $tokenResult->token;

            $token->save();

            return response()->json([

                'access_token' => $tokenResult->accessToken,

                'token_type' => 'Bearer',
                'message' => 'You have loged in successfully.',

                'expires_at' => Carbon::parse(

                    $tokenResult->token->expires_at

                )->toDateTimeString(),

                'user' => $user,

            ]);
        } else {
            return response()->json([
                "message" => "The given data was invalid.",
                "errors" => [
                    "password" => ["password is invalid"],
                ],
            ], 422);
        }

    }
    // register controller
    public function register(RegisterRequest $request) {

        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;

        $token->save();

        return response()->json([

            'access_token' => $tokenResult->accessToken,

            'token_type' => 'Bearer',
            'message' => 'You have registered successfully.',

            'expires_at' => Carbon::parse(

                $tokenResult->token->expires_at

            )->toDateTimeString(),
        ]);

    }
}
