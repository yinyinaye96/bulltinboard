<?php
namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Download implements FromCollection{
    public function collection(){
        return Post::all();
    }
}