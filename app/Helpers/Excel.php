<?php

namespace App\Helpers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Schema;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class Excel
{
    public function prepare(): array
    {
        $realName = request()->all()['file']->getClientOriginalName();
        request()->all()['file']->move('uploads', $realName);

        $collection = (new FastExcel)->import('file.xlsx');

        return [
            'excel_header' => array_keys($collection[0]),
            'main_header' => Schema::getColumnListing('users'),
        ];
    }

    public function upload()
    {
        $realName = request()->all()['file']->getClientOriginalName();
        request()->all()['file']->move('uploads', $realName);
        $currentHeader = json_decode(request()->all()['headers'], true);
        (new FastExcel())->import('uploads/'.$realName, function ($line) use ($currentHeader) {
            return User::create([
                'name' => $line[array_values(collect($currentHeader)->filter(fn ($a) => array_key_first($a) === 'name')->toArray())[0]['name']],
                'email' => $line[array_values(collect($currentHeader)->filter(fn ($a) => array_key_first($a) === 'email')->toArray())[0]['email']],
                'password' => 'noval',
            ]);
        });
    }
}
