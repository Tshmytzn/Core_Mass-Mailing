<?php

namespace App\Http\Controllers\DashboardAnalytics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountModel;
use App\Models\LeadRecords;
use App\Models\SingleMailHistory;
use App\Models\MailRecordModel;

class AnalyticsController extends Controller
{
    public function getleadsoverview() {

        $accuser = AccountModel::select('acc_id', 'acc_username', 'acc_type')
            ->where('acc_type', '!=', 'Admin') 
            ->get();
    
        $accleadsCount = [];
    
        foreach ($accuser as $account) {

            $leadsCount = LeadRecords::where('acc_id', $account->acc_id)->count();
    
            $accleadsCount[] = [
                'acc_username' => $account->acc_username,
                'leads_count' => $leadsCount
            ];
        }
    
        $categories = array_column($accleadsCount, 'acc_username');
        $leadCounts = array_column($accleadsCount, 'leads_count');
    
        return response()->json([
            'categories' => $categories,
            'series' => [
                [
                    'name' => 'Leads',
                    'data' => $leadCounts
                ]
            ]
        ]);
    }
    
    

    public function getemailsoverview()
    {
        $accuser = AccountModel::select('acc_id', 'acc_username', 'acc_type')
        ->where('acc_type', '!=', 'Admin') 
        ->get();
        
        $emailData = []; 
    
        foreach ($accuser as $user) {

            $emailCounts1 = SingleMailHistory::where('acc_id', $user->acc_id)
                ->selectRaw('DATE(created_at) as email_date, COUNT(*) as count')
                ->groupBy('email_date')
                ->get()
                ->pluck('count', 'email_date');
    
            $emailCounts2 = MailRecordModel::where('acc_id', $user->acc_id)
                ->selectRaw('DATE(created_at) as email_date, COUNT(*) as count')
                ->groupBy('email_date')
                ->get()
                ->pluck('count', 'email_date');
    
            $mergedCounts = [];
            foreach (array_merge($emailCounts1->toArray(), $emailCounts2->toArray()) as $date => $count) {
                $mergedCounts[$date] = ($mergedCounts[$date] ?? 0) + $count;
            }
    
            $emailData[] = [
                'username' => $user->acc_username,
                'data' => $mergedCounts
            ];
        }
    
        $allDates = array_unique(array_merge(...array_map(fn($user) => array_keys($user['data']), $emailData)));
        sort($allDates); 
    
        $series = [];
        foreach ($emailData as $entry) {
            $series[] = [
                'name' => $entry['username'],
                'data' => array_map(fn($date) => $entry['data'][$date] ?? 0, $allDates)
            ];
        }
    
        return response()->json([
            'labels' => $allDates, 
            'series' => $series    
        ]);
    }
    
}
