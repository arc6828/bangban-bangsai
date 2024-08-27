<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ExportFile extends Model
{
    use HasFactory;


    public static function toCSV(Request $request, $filename, $body, $head)
    {
        // $fileName = 'tasks.csv';
        // $tasks = Task::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        // $columns = array('Title', 'Assign', 'Description', 'Start Date', 'Due Date');

        $callback = function () use ($body, $head) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $head);

            foreach ($body as $row) {
                fputcsv($file, $row);
            }

            fclose($file);
        };
        // return $callback;
        return response()->stream($callback, 200, $headers);
    }
    // https://dev.to/techsolutionstuff/how-to-export-csv-file-in-laravel-example-12ip
}
