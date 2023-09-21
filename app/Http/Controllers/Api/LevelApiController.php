<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LevelResource;
use App\Http\Resources\TypeResource;
use App\Http\Traits\Api_Trait;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LevelApiController extends Controller
{
    use Api_Trait;
    //
    public function index(Request $request){


        $validator = Validator::make($request->all(),
            [
                'client_id' => 'required|exists:clients,id',
                'user_type_id' => 'required|exists:user_types,id',

            ], []);
        if ($validator->fails()) {
            return  $this->returnErrorValidation(collect($validator->errors())->flatten(1),403);
        }
        $rows=Level::where('client_id',$request->client_id)->where('user_type_id',$request->user_type_id)->orderBy('sorted_by','asc')->get();


             $score=0;

             if (request()->has('app_id') &&  request()->has('client_id')  &&  request()->has('user_type_id')   ) {
                 $user = \App\Models\User::where('app_id', request()->app_id)->where('client_id', request()->client_id)->where('type_id', request()->user_type_id)->first();

                 if ($user) {
                     $total_points = \App\Models\Point::where('user_id', $user->id)->where('point', '>', 0)->sum('point');

                     for ($i=0;$i<count($rows);$i++) {

                         if ($total_points>0){
                             $levelPoint=Level::findOrFail($rows[$i]['id']);
                             if ($total_points>=$levelPoint->points)

                             {

                                 $rows[$i]['score']=$levelPoint->points;

                                  $total_points=$total_points-$levelPoint->points;
                             }

                             else{
                                 $rows[$i]['score']=$total_points;
                                  $total_points=0;
                             }




                         }
                         else
                         {
                             $rows[$i]['score']=0;
                         }

                     }




                     }


             }
             else
             {
              for ($i=0;$i<count($rows);$i++){
                  $rows[$i]['score']=0;
              }
             }













        return $this->returnData(LevelResource::collection($rows),['done'],200);
    }
}
