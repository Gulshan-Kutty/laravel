<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;



class DummyExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    
    */
    public function view(): View
    {
        return view('user.dummy', [
            'users' => User::where('id',19)->get()
        ]);
    }
}
