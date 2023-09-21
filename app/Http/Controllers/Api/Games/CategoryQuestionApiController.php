<?php

namespace App\Http\Controllers\Api\Games;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionBankCategoryResource;
use App\Http\Traits\Api_Trait;
use App\Models\QuestionBankCategory;
use Illuminate\Http\Request;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Facades\Validator;

class CategoryQuestionApiController extends Controller
{
    use Api_Trait;
    //
    public function index(Request $request){


        $validator = Validator::make($request->all(),
            [
                'client_id' => 'required|exists:clients,id',

            ], []);
        if ($validator->fails()) {
            return  $this->returnErrorValidation(collect($validator->errors())->flatten(1),403);
        }
        $rows=QuestionBankCategory::where('client_id',$request->client_id)->get();

        return $this->returnData(QuestionBankCategoryResource::collection($rows),['done'],200);


    }
}
