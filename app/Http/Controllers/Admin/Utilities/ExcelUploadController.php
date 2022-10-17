<?php

namespace App\Http\Controllers\Admin\Utilities;

use Exception;
use App\Models\Player;

use Illuminate\Support\Facades\Schema;
use App\Models\EventPayout;
use App\Http\Controllers\Controller;
use Rap2hpoutre\FastExcel\FastExcel;
/**
 * Class LiveReportCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ExcelUploadController extends Controller
{

public function prepare() {
    try {
        $realName = request()->all()['file']->getClientOriginalName();
        request()->all()['file']->move('uploads', $realName);
        $collection = (new FastExcel)->import('uploads/'.$realName);
        $header = array_values(collect(Schema::getColumnListing('event_payouts'))->filter(fn ($z) => $z == 'player_id' || $z == 'prize' || $z == 'position')->toArray());

        return [
            'excel_header' => array_keys($collection[0]),
            'main_header' => $header,
        ];

        return 1;
    } catch (Exception $e) {
        return 0;
    }
}

public function upload() {
    if (request()->all()['checkbox_overwrite'] === 'true') {
        EventPayout::where('event_id', request()->all()['event_id'])->delete();
    }

    try {
        $realName = request()->all()['file']->getClientOriginalName();
        request()->all()['file']->move('uploads', $realName);
        $currentHeader = json_decode(request()->all()['headers'], true);
        // dd(array_values(collect($currentHeader)->filter(fn ($a) => array_key_first($a) === 'prize')->toArray())[0]['prize']);
        $check = (new FastExcel())->import('uploads/'.$realName, function ($line) use ($currentHeader) {
            $player = $line[array_values(collect($currentHeader)->filter(fn ($a) => array_key_first($a) === 'player_id')->toArray())[0]['player_id']];

            $playerArray = explode(' ', trim($player));

            if (is_countable($playerArray)) {
                $player = Player::where('name', implode(' ', $playerArray))->first();
                if ($player !== null) {
                    $save = EventPayout::create([
                        'prize' => $line[array_values(collect($currentHeader)->filter(fn ($a) => array_key_first($a) === 'prize')->toArray())[0]['prize']],
                        'position' => $line[array_values(collect($currentHeader)->filter(fn ($a) => array_key_first($a) === 'position')->toArray())[0]['position']],
                        'event_id' => request()->all()['event_id'],
                        'player_id' => $player->id,
                    ]);
                }
            }
        });

        return 1;
    } catch (Exception $e) {
        return 0;
    }
}


}