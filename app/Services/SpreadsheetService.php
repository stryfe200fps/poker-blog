<?php

namespace App\Services;

use Illuminate\Http\Request;
use Intervention\Image\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Backpack\Settings\app\Models\Setting;

final class SpreadsheetService
{
    protected Collection $excelData;

    public function __construct(protected UploadedFile $file, protected Model $currentModel)
    {
         $this->excelData = (new FastExcel)->import($file);
    }

    // public function moveFile()
    // {
    //     dd($this->getHeader(), $this->getSpreadsheetHeader());
    // }

    public function getSpreadsheetHeader()
    {
        return array_keys($this->excelData->toArray()[0]);

    }

    public function getHeader()
    {
        return $this->currentModel->excelHeaders;
    }

    public function upload(array $chosenHeaders)
    {
        $headerPlayerId = array_values(collect($chosenHeaders)->toArray());

        foreach ($this->excelData as $row) {

            // dd($row, $chosenHeaders);



        }
    }

}
