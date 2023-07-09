<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\UserDatas;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UsersSync implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::with('reseller', 'supplier')->get()->toArray();

        $userDataModify =   array_map(function ($item) {
            if ($item['role_type'] === 'Supplier') {
                $item['contact_no'] = $item['supplier']['contact_no'];
                $item['address'] = $item['supplier']['address'];
            } elseif ($item['role_type'] === 'Reseller') {
                $item['contact_no'] = $item['reseller']['contact_no'];
                $item['address'] = $item['reseller']['address'];
            }
            $item['role'] = $item['role_type'];
            return $item;
        }, $user);

        foreach ($userDataModify as $user) {
            UserDatas::updateOrInsert(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'address' => $user['address'],
                    'contact_no' => $user['contact_no']
                ]
            );
        }

        return response()->json(
            [
                'status' => 'success',

            ]
        );
    }
}
