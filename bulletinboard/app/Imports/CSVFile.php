<?php

namespace App\Imports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\ToModel;

class CSVFile implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Post([
            'title' => @$row[0],
            'description' =>  @$row[1],
            'create_user_id' => auth()->user()->id,
            'updated_user_id' => auth()->user()->id
        ]);
    }
}
