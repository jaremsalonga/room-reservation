<?php

namespace App\Traits;

use Illuminate\Support\Facades\Response;

trait Exporter { 

    public function exportAsCsv($data, $fileName) {

        $columns = current($data);

        $handle = fopen($fileName, 'w');

        //adding the first row
        fputcsv($handle, array_keys($columns));

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $callback = function() use($data, $columns) {

            $file = fopen('php://output', 'w');

            fputcsv($file, $columns);

            foreach ($data as $item) {
                fputcsv($file, array_values($item));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}