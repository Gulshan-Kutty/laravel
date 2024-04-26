<?php

namespace App\Http\Controllers;
use App\Models\Color;
use League\Csv\Reader;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    //
    public function home()
    {
        return view('welcome');
    }

    public function showForm()
    {
        return view('import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $csv = Reader::createFromPath($file->getPathname(), 'r');
        
        // Skip the first row (header)
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            // Now $record will contain associative array with keys 'Name', 'HEX', 'RGB'
            // You can access values as $record['Name'], $record['HEX'], $record['RGB']
            Color::create([
                'name' => $record['Name'],
                'hex' => $record['HEX'],
                'rgb' => $record['RGB']
            ]);
        }
        return redirect()->back()->with('success', 'CSV data has been imported successfully.');

    }
}
