<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Jobs\DeleteRecord;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function deleteRecord()
    {

        $delete =  new DeleteRecord();
        dispatch($delete);
    }
}