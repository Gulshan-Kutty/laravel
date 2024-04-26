<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



class ProductsExport implements FromView,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    
    */
    // use Exportable;

    public function __construct(string $from,$to)
    {
        $this->from = $from;
        // dd($this->from);
        $this->to = $to;
        return $this;
    }

    public function view(): View
    {
        return view('products.export', [
            'products' => Product::whereBetween(DB::raw('LEFT(created_at,10)'),[$this->from ,$this->to])->get()
        ]);
    }
}
