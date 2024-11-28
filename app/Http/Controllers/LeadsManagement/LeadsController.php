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

    public function GetLeadsDataByService(Request $request)
    {
        $data = LeadRecords::where('acc_id', session('acc_id'))
            ->where('lead_type', $request->type)
            ->where('lead_status',null)
            ->take(10) // Limit to 10 results
            ->get();

        return response()->json(['data' => $data]);
    }
    public function GetLeadsDataWordByService(Request $request)
    {
        $data = LeadRecords::where('acc_id', session('acc_id'))
        ->where('lead_type', $request->type)
            ->where('lead_status', '1')
            ->take(10) // Limit to 10 results
            ->get();

        return response()->json(['data' => $data]);
    }

    public function GetLeadsDataWordByServiceFollowUp(Request $request)
    {
        $data = LeadRecords::where('acc_id', session('acc_id'))
        ->where('lead_type', $request->type)
            ->where('lead_status', '>','1')
            ->where('lead_status', '!=', '10')
            ->take(10) // Limit to 10 results
            ->get();

        return response()->json(['data' => $data]);
    }

    public function ManualinputLeadsData(Request $request)
    {
        $validatedData = $request->validate([
            'acc_id' => 'nullable|string|max:255',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:leads_record,lead_email',
            'contact' => 'nullable|string', 
            'company' => 'required|string|max:255',
            'services' => 'required|string|max:255',
        ]);

        $leadRecord = new LeadRecords();
        $leadRecord->acc_id = $validatedData['acc_id'];
        $leadRecord->lead_firstname = $validatedData['firstName'];
        $leadRecord->lead_lastname = $validatedData['lastName'];
        $leadRecord->lead_email = $validatedData['email'];
        $leadRecord->lead_number = $validatedData['contact'];  
        $leadRecord->lead_company = $validatedData['company'];
        $leadRecord->lead_type = $validatedData['services']; 

    
        $leadRecord->save();
    
        return response()->json([
            'status' => 'success',
            'message' => 'Lead record inserted successfully!',
            'data' => $leadRecord,
        ], 201);
    }

}
