<?php
namespace App\Imports;
use App\Models\Event;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Hash;
class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Event([
            'title'     => $row['title'],
            'start_date'    => $row['start_date'],
            'end_date' =>$row['end_date'],
            'image'   => $row['image'],
        ]);
    }
}
