<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\User;
use App\Models\Reseller;
use App\Models\Supplier;
use Illuminate\Support\Str;
use App\Models\ProfileImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        $validatorResponse = Validator::make($request->all(), [
            'name' => ['required', 'alpha_num'],
            'email' => ['required', 'email', 'unique:users'],
            'role' => ['required', 'in:Supplier,Reseller'],
            'Address' => ['required', 'string'],
            'contactNumber' => ['required', 'integer', 'digits:10'],
            'file' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
        ]);

        if ($validatorResponse->fails()) {
            return redirect()->back()->withErrors($validatorResponse)->withInput();
        }

        $validatedDate = $validatorResponse->getData();

        if ($validatedDate['role'] === 'Supplier') {

            $roleId =  Supplier::insertGetId([
                'address' => $validatedDate['Address'],
                'contact_no' => $validatedDate['contactNumber']
            ]);
        } else {
            $roleId =  Reseller::insertGetId([
                'address' => $validatedDate['Address'],
                'contact_no' => $validatedDate['contactNumber']
            ]);
        }

        $userId = User::insertGetId([
            'name' => $validatedDate['name'],
            'email' => $validatedDate['email'],
            'role_id' => $roleId,
            'role_type' => $validatedDate['role']
        ]);

        $validatedDate['file']->storeAs('public/images', Str::slug(pathInfo($validatedDate['file']->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $validatedDate['file']->extension());

        ProfileImage::insert([
            'user_id' => $userId,
            'file_original_name' => $validatedDate['file']->getClientOriginalName(),
            'file_name' => Str::slug(pathInfo($validatedDate['file']->getClientOriginalName(), PATHINFO_FILENAME)),
            'file_size' => $validatedDate['file']->getSize(),
            'extension' => $validatedDate['file']->extension()
        ]);

        return redirect()->route('users');
    }

    public function userList()
    {
        $users = User::with('reseller')
            ->with('supplier')
            ->get();

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('contact_no', function ($users) {
                if ($users->supplier && $users->role_type === 'Supplier') {
                    return $users->supplier->contact_no;
                } else {
                    return $users->reseller->contact_no;
                }
            })
            ->addColumn('address', function ($users) {
                if ($users->supplier && $users->role_type === 'Supplier') {
                    return $users->supplier->address;
                } else {

                    return $users->reseller->address;
                }
            })
            ->rawColumns([])
            ->make(true);;
    }
}
