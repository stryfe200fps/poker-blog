<?php

namespace App\Services;

use App\Models\Player;
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
    protected bool $deleteOldData = false;
    protected $modelGroupValue = '';

    public function __construct(protected UploadedFile $file, protected Model $currentModel)

    {
        $this->excelData = (new FastExcel)->import($file);
    }

    public function getSpreadsheetHeader()
    {
        return array_keys($this->excelData->toArray()[0]);
    }

    public function getHeader()
    {
        return $this->currentModel->excelHeaders;
    }

    public function upload(array $chosenHeaders, array $extraAttributes)
    {
        $extra = $this->extraAttributes($extraAttributes);

        if ($this->deleteOldData)
            $this->currentModel->where($this->modelGroupValue)->delete();

        foreach ($this->excelData as $row) {

            $headers = array_values(collect($chosenHeaders)->toArray());
            $collected = collect($headers)->mapWithKeys(function ($item) use ($row) {
                // $check = $item[array_values($item)[0]];
                // $player = @array_values($item);
                $playerId = array_keys($item)[0];

                $item[array_keys($item)[0]] = @$row[array_values($item)[0]];

                if ($playerId === 'player_id') {
                    $playerString = array_values($item)[0];

                    if ($playerString !== null) {
                        $query = Player::where('name', 'like', "%$playerString%");
                        if ($query->count()) {

                            $item[array_keys($item)[0]] = $query->firstOrFail()->id;
                        }
                    }
                }

                return $item;
            })->toArray();

            $collected = array_merge($collected, $extra);
            $collected = array_merge($collected, [
                'published_date' => now()
            ]);

            $this->currentModel->create($collected);
        }

        // dd($extra);

        return $headers;
    }


    public function extraAttributes($attributes)
    {
        $this->deleteOldData = filter_var($attributes['checkbox_overwrite'], FILTER_VALIDATE_BOOLEAN) ?? false;

        $array =  array_flip(array_values(array_diff($this->currentModel->getFillable(), $this->getHeader())));
        $this->modelGroupValue =  array_intersect_key($attributes, array_flip($this->currentModel->group));
        return array_intersect_key($attributes, $array);
    }
}
