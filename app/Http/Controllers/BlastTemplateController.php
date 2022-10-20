<?php

namespace App\Http\Controllers;
use App\Models\blast_template;
use App\Models\blast_target;
use Illuminate\Http\Request;

class BlastTemplateController extends Controller
{
    public function submit_blasting(Request $request)
    {
        $path = $request->file('csv')->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $csvHeader = array_slice($data, 0, 1);
        $csvData = array_slice($data, 1);
        $row = [];
        foreach ($csvData as $item => $value) {
            $row[] = [
                'data' => json_encode(array_combine($csvHeader[0], $value)),
                'template' => "1"
            ];
        }
        dd($row);
        blast_target::insert($row);
        
        $template = new blast_template;
        $timezone = "Asia/Jakarta";
        date_default_timezone_set($timezone);
        $template->template = $request->template;
        $template->timer = $request->timeset;
        $template->schedule = date("Y-m-d H:i:s ", strtotime($request->schedule));
        $template->status = "pending";
        $template->save();

        

        return redirect('wa/blast')->with('status', 'blasting submitted.');
    }
}
