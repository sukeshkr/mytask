<?php

namespace Modules\Api\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Admin\Entities\Employee;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $res = [
                'errorcode' => 3,
                'message' => $validator->errors()->all(),
            ];
        } else {

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

            $res = [
                'errorcode' => 1,
                'message' => 'Unauthorized!',
                'status' => 401,
            ];
        }
        return response()->json($res);
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
