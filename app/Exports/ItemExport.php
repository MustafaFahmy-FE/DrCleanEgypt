<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ItemExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Item::with('category')->orderBy('category_id' , 'asc')->get();
    }
    
    public function headings(): array
    {
        return [
            'الإسم',
            'القسم',
            'سعر الغسيل',
            'سعر الكي'
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->name,
            $transaction->category->name,
            $transaction->laundry_price,
            $transaction->ironing_price
        ];
    }

}
