<?php

namespace App\Http\Controllers\LeadsManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeadRecords;
class LeadsController extends Controller
{
    public function InsertLeadsData(Request $request)
    {
        $validated = $request->validate([
            'data' => 'required|array', // Ensure data is an array
        ]);

        // Access the extracted data (which is a chunk in each request)
        $data = $validated['data'];

        // Loop through each row in the chunk and insert into the database
        foreach ($data as $row) {
            // Validate that at least one of firstname, lastname, or company exists
            if (empty($row['firstname']) && empty($row['lastname']) && empty($row['email'])) {
                continue; // Skip rows that don't have at least one of the required fields
            }

            // Prepare the data for insertion
            $dataToInsert = [
                'acc_id'        => session('acc_id'),  // Assuming session contains account ID
                'lead_firstname' => $row['firstname'] ?? '',
                'lead_lastname'  => $row['lastname'] ?? '',
                'lead_email'     => $row['email'] ?? '',
                'lead_company'   => $row['company'] ?? '',
                'lead_number'    => $row['number'] ?? '',
                'lead_type'    => $row['type'] ?? '',
            ];

            // Insert the data into the database
            LeadRecords::create($dataToInsert);
        }

        // Return a success response after processing the chunk
        return response()->json(['message' => 'Data imported successfully!'], 200);
    }

    public function GetLeadsData(){
        $data = LeadRecords::where('acc_id',session('acc_id'))->get();
        return response()->json(['data' => $data]);
    }

}
