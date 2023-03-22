<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Region;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    public function add(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'region' => 'required'
        ]);
        if($validator->fails()){
            return $validator->messages();
        }

        $region = new Region();
        $region->region = $request->region;
        $result = $region->save();

        if($result){
            $flasher->addSuccess('Regione aggiunta', 'Operazione conclusa con successo');
            return $result;
        }
        else{
            $flasher->error('Qualcosa è andato storto', 'Ops, si è verificato un errore');
            return $result;
        }
    }

    public function delete(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(), [
            'region_id' => 'required'
        ]);
        if($validator->fails()){
            return $validator->messages();
        }
        $region_id = $request->region_id;
        $region = Region::where('id','=',$region_id);
        $positions = Position::where('region_id', $region_id)->update(['region_id' => NULL]);
        $result = $region->delete();

        if($result != 0){
            $flasher->addSuccess('Regione rimossa', 'Operazione conclusa con successo');
            return $result;
        }
        else{
            $flasher->error('Qualcosa è andato storto', 'Ops, si è verificato un errore');
            return $result;
        }
    }
}
