<?php

namespace App\Http\Controllers;

use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorksheetController extends Controller
{

    public function admin_index()
    {
        $pageTitle = "Work Sheet";

        // Retrieve today's worksheets
        $todaysworksheets = Worksheet::whereDate('created_at', Carbon::today())->paginate(10);
        $previousworksheets = Worksheet::whereDate('created_at', '<', Carbon::today())->paginate(10);
        return view('admin.worksheet.index', compact('pageTitle', 'todaysworksheets', 'previousworksheets'));
    }

    //set target
    public function set_target($id)
    {
        $pageTitle = "Edit target Data";
        $worksheet = Worksheet::findOrFail($id);
        return view('admin.worksheet.edit', compact('pageTitle', 'worksheet'));
    }

    //update target
    public function update_target(Request $request, $id)
    {
        $userid = Worksheet::findOrFail($id);
        $userid->daily_target = $request->input('daily_target');
        $userid->save();
        $notify[] = ['success', 'Daily target updated successfully.'];
        return redirect()->route('admin.worksheet.index')->withNotify($notify);
    }
    public function image_view($id)
    {
        $pageTitle = "Preview image";
        $employeeid = Worksheet::findOrFail($id);
        return view('admin.worksheet.preview_image', compact('pageTitle', 'employeeid'));
    }
    public function worksheet($employee)
    {

        $pageTitle = "ওয়ার্কশিট";

        $employeetdata = Worksheet::where('employee_id', $employee)->latest()->paginate(10);
        // dd($employeetdata);
        return view('admin.employee.worksheet.index', compact('pageTitle', 'employeetdata',));
    }
}
