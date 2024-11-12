<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AccountModel;

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
                '000000001',
                'Admin',
                'password',
                'Employee',
                'default_pic.jpg',
            ],
            [
                'hazel',
                '000000001',
                'Admin',
                'password',
                'Employee',
                'default_pic.jpg',
            ],
            [
                'tisha-law-ay',
                '000000001',
                'Admin',
                'password',
                'Employee',
                'default_pic.jpg',
            ],
            [
                'rheyan',
                '000000001',
                'Admin',
                'password',
                'Employee',
                'default_pic.jpg',
            ],
            [
                'jp',
                '000000001',
                'Admin',
                'password',
                'Employee',
                'default_pic.jpg',
            ],
            [
                'albert',
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
            $model->acc_company_id = $acc[1];
            $model->acc_email = $acc[2]; 
            $model->acc_password = $acc[3];
            $model->acc_type = $acc[4];
            $model->acc_pic = $acc[5];
            $model->save();
        }
    }
}
