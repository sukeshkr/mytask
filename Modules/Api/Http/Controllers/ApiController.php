<?php

namespace Modules\Api\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Admin\Entities\Employee;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            $data['user_id'] = $user->id;
            $data['token_type'] = 'bearer';
            $data['token'] = $token;

            $res = [
                'errorcode' => 0,
                'data' => $data,
                'message' => 'Success!',
                'status' => 200,
            ];

            return response()->json($res);
        }


        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function userIndex(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        $res = [
            'errorcode' => 0,
            'data' => $user,
            'message' => 'Success!',
            'status' => 200,
        ];

        return response()->json($res);
    }

    public function employeeIndex(Request $request)
    {
        // Get employees with company details
        $employees = Employee::with('company')->get();

        foreach ($employees as $employee) {
            $res['data'][] = [
                'employee' => $employee,
            ];
        }

        return response()->json($res);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out'], 200);
    }
}
