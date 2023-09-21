<?php

namespace App\Http\Controllers\Api\Games;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameQuestionResource;
use App\Http\Resources\GamesResource;
use App\Http\Resources\UserGameResource;
use App\Http\Traits\Api_Trait;
use App\Models\Answer;
use App\Models\CheckUserDayGame;
use App\Models\Game;
use App\Models\GameQuestion;
use App\Models\Level;
use App\Models\QuestionBank;
use App\Models\User;
use App\Models\UserGame;
use App\Models\UserGameAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GamesApiController extends Controller
{
    use Api_Trait;
    //
    public function index(Request $request){


        $validator = Validator::make($request->all(),
            [
                'client_id' => 'required|exists:clients,id',
                'question_bank_category_id'=>'nullable|exists:question_bank_categories,id'

            ], []);
        if ($validator->fails()) {
            return  $this->returnErrorValidation(collect($validator->errors())->flatten(1),403);
        }
        $data=Game::query()->where('client_id',$request->client_id)->where('status', 1)
            ->whereDate('start_date', '<=', date("Y-m-d"))
            ->whereDate('end_date', '>=', date("Y-m-d"));
        if ($request->question_bank_category_id ){
            $data->where('question_bank_category_id',$request->question_bank_category_id);
        }
        $rows=$data->get();
        return $this->returnData(GamesResource::collection($rows),['done'],200);

    }
    public function userGames(Request $request){
        $validator = Validator::make($request->all(),
            [
                'app_id' => 'required',
                'client_id' => 'required|exists:clients,id',
                'user_type_id' => 'required|exists:user_types,id',

            ], []);
        if ($validator->fails()) {
            return $this->returnErrorValidation(collect($validator->errors())->flatten(1), 403);
        }
        $user = User::where('client_id', $request->client_id)->where('type_id', $request->user_type_id)->where('app_id', $request->app_id)->first();

        if (!$user)
            return $this->returnErrorNotFound(['user not found']);

        $rows=UserGame::where('user_id',$user->id)->with(['game'])->get();

        return $this->returnData(UserGameResource::collection($rows),['done'],200);

    }



    public function  playGame(Request $request){
        $validator = Validator::make($request->all(),
            [
                'app_id' => 'required',
                'client_id' => 'required|exists:clients,id',
                'type_id' => 'required|exists:user_types,id',
                'name' => 'nullable',
                'email' => 'nullable',
                'phone' => 'nullable',
                'game_id'=>'required|exists:games,id'

            ], []);
        if ($validator->fails()) {
            return $this->returnErrorValidation(collect($validator->errors())->flatten(1), 403);
        }

        $firstLevel = Level::where('client_id', $request->client_id)->where('user_type_id', $request->type_id)->orderBy('points', 'asc')->first();
        if (!$firstLevel)
            return $this->returnError(['Levels Not Found', 400]);


        $user = AvailableUser($request->app_id, $request->client_id, $request->type_id, $firstLevel->id, $request->name, $request->phone, $request->email);


        $game=Game::where('status',1)->find($request->game_id);
        if (!$game)
            return $this->returnError(['Game Is Notable', 400]);

        $gameCheckDate= Game::where('status', 1)
            ->whereDate('start_date', '<=', date("Y-m-d"))
            ->whereDate('end_date', '>=', date("Y-m-d"))
            ->find($request->game_id);

        if (!$gameCheckDate)
            return $this->returnError(['You are not In Season', 400]);

        if ($game->client_id!=$user->client_id)
            return $this->returnError(['This Game Is Not Available For You', 400]);


        $userGame=UserGame::where('user_id',$user->id)->where('game_id',$game->id)->first();
        if (!$userGame) {
            $userGame = UserGame::create([
                'game_id' => $game->id,
                'user_id' => $user->id,
                'column_client_id' => $request->client_id,
                'client_id' => $request->client_id,
            ]);
        }



        $gameCheckDay=CheckUserDayGame::where('game_id',$game->id)->where('user_id',$user->id)->where('day',date('Y-m-d'))->where('type','play')->count();

        if ($gameCheckDay>0)
            return $this->returnError(['Already played', 400]);

        if ($userGame->is_end==1){
            return $this->returnError(['the game is end for you', 400]);

        }



        CheckUserDayGame::create([
            'game_id'=>$game->id,
            'user_id'=>$user->id,
            'day'=>date('Y-m-d'),
            'type'=>'play',
        ]);

        $gameQuestions=GameQuestion::with(['activeQuestion.answers'])->where('game_id',$game->id)->where('client_id',$request->client_id)->where('date',date('Y-m-d'))->inRandomOrder()->get();

        $data=[];
        $data['game']=GamesResource::make($game);
        $data['game_question']=GameQuestionResource::collection($gameQuestions);
        $data['user_game_id']=$userGame->id;




        return $this->returnData($data,['done'],200);


    }


    public function gameDayAnswer(Request $request){
        $validator = Validator::make($request->all(),
            [
                'app_id' => 'required',
                'client_id' => 'required|exists:clients,id',
                'type_id' => 'required|exists:user_types,id',
                'game_id'=>'required|exists:games,id',
                'user_game_id'=>'required|exists:user_games,id',
                'answers' => 'required|array',
                'answers.*.question_id' => 'required|distinct|exists:question_banks,id',
                'answers.*.answer_id' => 'required|distinct|exists:answers,id',

            ], []);
        if ($validator->fails()) {
            return $this->returnErrorValidation(collect($validator->errors())->flatten(1), 403);
        }

        $user=User::where('client_id',$request->client_id)->where('type_id',$request->type_id)->where('app_id',$request->app_id)->first();

        if (!$user)
            return  $this->returnErrorNotFound(['user not Found']);

        $game=Game::where('status',1)->find($request->game_id);
        if (!$game)
            return $this->returnError(['Game Is Notable', 400]);

        $gameCheckDate= Game::where('status', 1)
            ->whereDate('start_date', '<=', date("Y-m-d"))
            ->whereDate('end_date', '>=', date("Y-m-d"))
            ->find($request->game_id);

        if (!$gameCheckDate)
            return $this->returnError(['You are not In Season', 400]);

        if ($game->client_id!=$user->client_id)
            return $this->returnError(['This Game Is Not Available For You', 400]);



        $userGame=UserGame::find($request->user_game_id);

        if ($userGame->is_end==1)
            return $this->returnError(['This Game Is End', 400]);

        if ($userGame->client_id!=$user->client_id)


        if (!$userGame)
            return $this->returnError(['This Game Is Not Available For You', 400]);


        $is_end=0;
        $maxGameDate=GameQuestion::where('client_id',$user->client_id)->where('game_id',$game->id)->max('date');
        if ($maxGameDate==date('Y-m-d'))
            $is_end=1;
        if ($maxGameDate<date('Y-m-d'))
        {
            $userGame->update(['is_end'=>1]);
            return $this->returnError(['This Game Is End', 400]);

        }



        foreach ($request->answers as $key=> $row) {

            if ($key==0){

                $gameQuestion=GameQuestion::where('game_id',$game->id)->where('question_bank_id',$row['question_id'])->first();
                if (!$gameQuestion)
                    return  $this->returnError(['the is Error']);
                if ($gameQuestion->date!=date('Y-m-d')){
                    return  $this->returnError(['the Answers Not in  The Day Of Game']);

                }
                UserGameAnswer::where('game_id',$game->id)->where('user_id',$user->id)->where('user_game_id',$userGame->id)->where('date',date('Y-m-d'))->delete();
            }




            $value=0;
            $answer=Answer::find($row['answer_id']);
            if ($answer->is_right==1)
                $value=$game->point_per_answer;

              UserGameAnswer::create([
                  'game_id'=>$game->id,
                  'user_id'=>$user->id,
                  'is_right'=>$answer->is_right,
                  'value'=>$value,
                  'question_bank_id'=>$row['question_id'],
                  'answer_id'=>$row['answer_id'],
                  'user_game_id'=>$userGame->id,
                  'client_id'=>$request->client_id,
                  'column_client_id'=>$request->client_id,
                  'date'=>date('Y-m-d'),
              ]);

        }


        $userValue=UserGameAnswer::where('game_id',$game->id)->where('user_id',$user->id)->where('user_game_id',$userGame->id)->where('is_right',true)->sum('value');
        $userGame->update([
            'value'=> $userValue,
            'is_end'=>$is_end,
        ]);



        return $this->returnData(null,['done'],200);



        }






}
