<?php

namespace App\Http\Controllers\Admin\Utilities;

use App\Http\Controllers\Controller;
use App\Models\EventPayout;
use App\Models\Player;
use App\Services\SpreadsheetService;
use Exception;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Schema;
use Rap2hpoutre\FastExcel\FastExcel;

/**
 * Class LiveReportCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ExcelUploadController extends Controller
{
    public function prepare()
    {
        // dd(request()->all());
        $spreadsheet = new SpreadsheetService(request()->all()['file'], app()->make(request()->all()['model']));

        return [
            'excel_header' => $spreadsheet->getSpreadsheetHeader(),
            'main_header' => $spreadsheet->getHeader(),
        ];
    }

    public function upload()
    {

        $spreadsheet = new SpreadsheetService(request()->all()['file'], app()->make(request()->all()['model']));
        $currentHeader = json_decode(request()->all()['headers'], true);
        $spreadsheet->upload($currentHeader, request()->all());

        return 1;
    }
}
