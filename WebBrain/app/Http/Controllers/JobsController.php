<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Jobs\DeleteRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JobsController extends Controller
{
    public function deleteRecord()
    {

        $delete =  new DeleteRecord();
        dispatch($delete);
    }

    public function login(Request $request)
    {

        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()->first()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken('Api Token')
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'id' => ['required', 'integer'],
            'firstName' => ['string'],
            'lastName' => ['string'],
            'mobile' => ['number'],
            'email' => ['email'],
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation failed',
                'errors' => $validatedData->errors()->first()
            ], 401);
        }
        $updateData  = $validatedData->getData();

        $mappedData = collect($updateData)->mapWithKeys(function ($item, $key) {
            switch ($key) {
                case 'firstName':
                    return ['first_name' => $item];
                case 'lastName':
                    return ['last_name' => $item];
                case 'mobile':
                    return ['mobile' => $item];
                case 'email':
                    return ['email' => $item];
                default:
                    return [];
            }
        })->toArray();

        User::whereId($updateData['id'])->update($mappedData);

        return response()->json([
            'success' => true,
            'status' => 'Sucessfully updated',
        ]);
    }
}