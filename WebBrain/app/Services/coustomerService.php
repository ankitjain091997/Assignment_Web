<?php

namespace App\Services;

use App\Models\User;

class coustomerService
{
    public function coustomerList()
    {
        $coustomers = User::where('role', 'coustomer')->get();

        return view('admin.coustomer', compact('coustomers'));
    }

    // single coustomer delete 
    public function coustomerDestroy($request, $id)
    {
        $coustomer = User::find($id);
        $coustomer->delete();
        return redirect()->back()->with('success', 'Customer deleted successfully');
    }
    // multiple coustomer delete
    public function coustomerMulipleDestroy($request)
    {
        $ids = $request->ids;
        User::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['status' => true, 'message' => "Customers deleted successfully."]);
    }
}