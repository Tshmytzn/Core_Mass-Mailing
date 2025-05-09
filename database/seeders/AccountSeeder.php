<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AccountModel;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $account = [

            [
                'pit',
                'Admin',
                '000000001',
                'Admin',
                'password',
                'Employee',
                'default_pic.jpg',
            ],
            [
                'hazel',
                'Admin',
                '000000001',
                'Admin',
                'password',
                'Employee',
                'default_pic.jpg',
            ],
            [
                'tisha',
                'Admin',
                '000000001',
                'Admin',
                'password',
                'Employee',
                'default_pic.jpg',
            ],
            [
                'rheyan',
                'Admin',
                '000000001',
                'Admin',
                'password',
                'Employee',
                'default_pic.jpg',
            ],
            [
                'jp',
                'Admin',
                '000000001',
                'Admin',
                'password',
                'Employee',
                'default_pic.jpg',
            ],
            [
                'albert',
                'Admin',
                '000000001',
                'Admin',
                'Admin123',
                'Admin',
                'default_pic.jpg',
            ],

        ];
        foreach($account as $acc){
            $model = new AccountModel();
            $model->acc_username = $acc[0];
            $model->acc_fullname = $acc[1];
            $model->acc_company_id = $acc[2];
            $model->acc_email = $acc[3]; 
            $model->acc_password = Hash::make($acc[4]);
            $model->acc_type = $acc[5];
            $model->acc_pic = $acc[6];
            $model->save();
        }
    }
}
