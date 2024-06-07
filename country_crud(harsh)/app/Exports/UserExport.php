<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;



class UserExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    
    */
    // use Exportable;

    public function __construct(string $from,$to)
    {
        $this->from = $from;
        $this->to = $to;
        return $this;
    }

    public function view(): View
    {
        
        return view('user.export', [
            'users' => User::whereBetween(DB::raw('LEFT(created_at,10)'),[$this->from ,$this->to])->get()
        ]);
    
    }
}
