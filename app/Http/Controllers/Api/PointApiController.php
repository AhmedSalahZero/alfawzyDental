<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PointResource;
use App\Http\Traits\Api_Trait;
use App\Models\Donation;
use App\Models\HowToGetPoint;
use App\Models\HowToRedeem;
use App\Models\Language;
use App\Models\Level;
use App\Models\LevelPoint;
use App\Models\Offer;
use App\Models\OfferCode;
use App\Models\Point;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PointApiController extends Controller
{
    use Api_Trait;

    //
    public function pointsForUser(Request $request)
    {
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


        $available_points = Point::where('user_id', $user->id)->where('expired_at', '>=', date('Y-m-d'))->sum('point');
        $total_points = Point::where('user_id', $user->id)->where('point', '>', 0)->sum('point');
        $used_points = Point::where('user_id', $user->id)->where('point', '<', 0)->sum('point');
        if ($used_points < 0)
            $used_points = -$used_points;
        $expired_points = $total_points - $available_points - $used_points;


        return $this->returnData(['available_points' => $available_points, 'total_points' => $total_points, 'used_points' => (int)$used_points, 'expired_points' => $expired_points], ['done'], 200);
    }

    public function addPointsForUser(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'app_id' => 'required',
                'name' => 'nullable',
                'email' => 'nullable',
                'phone' => 'nullable',
                'client_id' => 'required|exists:clients,id',
                'type_id' => 'required|exists:user_types,id',
                'slug' => 'required',
                'foreign_table' => 'required|in:how_to_get_points',

            ], []);
        if ($validator->fails()) {
            return $this->returnErrorValidation(collect($validator->errors())->flatten(1), 403);
        }
        $reason = HowToGetPoint::where('client_id', $request->client_id)->where('slug', $request->slug)->first();
        if (!$reason)
            return $this->returnError(['reason Not Found', 400]);

        $firstLevel = Level::where('client_id', $request->client_id)->where('user_type_id', $request->type_id)->orderBy('points', 'asc')->first();
        if (!$firstLevel)
            return $this->returnError(['Levels Not Found', 400]);


        $user = AvailableUser($request->app_id, $request->client_id, $request->type_id, $firstLevel->id, $request->name, $request->phone, $request->email);


//        $daily=dailyPoint($reason,$user);
//        if (!$daily)
//            return $this->returnError(['You are use This Reason', 400]);


        $permission = howToGetPointPermission($request->slug);
        if ($permission == 401) {
            return $this->returnErrorNotFound(['not found', 401]);
        }
        if ($permission == 405) {
            return $this->returnError(['is not available ', 400]);
        }
        $levelPoint = howToGetPointAvailable($user->level_id, $reason->id);
        if (!$levelPoint) {
            return $this->returnError(['your level doesnt have points ', 400]);
        }



        $title = [];
        foreach (Language::where('column_client_id', $user->client_id)->where('is_active', true)->get() as $index => $language) {
            if ($language->abbreviation == 'ar')
                $title[$language->abbreviation] = "تم اضافة نقاط باستخدام " .$reason->getTranslation('subject', 'ar');
            else
                $title[$language->abbreviation] = "add points using ".$reason->getTranslation('subject', 'en');


        }


        $transaction = Transaction::create([
            'reason_id' => $reason->id,
            'point' => $levelPoint->points,
            'title' => $title,
            'client_id' => $user->client_id,
            'user_id' => $user->id,


        ]);


        $dateNow = date('Y-m-d');
        $days = HowToGetPoint::where('slug', $request->slug)->first()->number_of_days ?? 0;
        $expired_at = date('Y-m-d', strtotime($dateNow . " +$days  days"));
        $point = Point::create([

            'reason_id' => $reason->id,
            'point' => $levelPoint->points,
            'expired_at' => $expired_at,
            'user_id' => $user->id,
            'column_client_id' => $user->client_id,
            'transaction_id' => $transaction->id,

        ]);

        return $this->returnData(PointResource::make($point), ['done'], 200);


    }


    public function convert_point_to_money(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'app_id' => 'required',
                'name' => 'nullable',
                'email' => 'nullable',
                'phone' => 'nullable',
                'client_id' => 'required|exists:clients,id',
                'type_id' => 'required|exists:user_types,id',
                'reason_id' => 'required',
                'foreign_table' => 'required|in:how_to_redeems',
                'points' => 'required|integer',

            ], []);
        if ($validator->fails()) {
            return $this->returnErrorValidation(collect($validator->errors())->flatten(1), 403);
        }


        $reason = HowToRedeem::where('client_id', $request->client_id)->find($request->reason_id);
        if (!$reason)
            return $this->returnError(['reason Not Found', 400]);


        $firstLevel = Level::where('client_id', $request->client_id)->where('user_type_id', $request->type_id)->orderBy('points', 'asc')->first();
        if (!$firstLevel)
            return $this->returnError(['Levels Not Found', 400]);


        $user = AvailableUser($request->app_id, $request->client_id, $request->type_id, $firstLevel->id, $request->name, $request->phone, $request->email);


        $order_id = $user->id . time();

        $permission = howToRedeemPoints($request->reason_id, $request->points, $user->id);


        if ($permission == 401) {
            return $this->returnErrorNotFound(['not found', 401]);
        }
        if ($permission == 405) {
            return $this->returnError(['your points is less than required ', 400]);
        }


        $levelPoint = howToRedeemAvailable($user->level_id, $request->points, $request->reason_id);
        if (!$levelPoint) {
            return $this->returnError(['your level points  less than required  ', 400]);
        }


        $pointForPrice = LevelPoint::where('client_id', $request->client_id)->where('user_type_id', $request->type_id)->where('level_id', $user->level_id)->latest()->first();

        if (!$pointForPrice) {
            return $this->returnError(['your level does not have price for point  ', 400]);

        }

        $price = $pointForPrice->currency ?? 0;
        $points = $request->points;
        $negativeArray = [];



        $availablePoints = Point::where('user_id', $user->id)->where('expired_at', '>=', date('Y-m-d'))->sum('point');

        if ($points > $availablePoints)
            return   $this->returnError(['points less than your Points'], 400);



        $title = [];
        foreach (Language::where('column_client_id', $user->client_id)->where('is_active', true)->get() as $index => $language) {
            if ($language->abbreviation == 'ar')
                $title[$language->abbreviation] = "تم تحويل نقاط الي مبلغ مالي باستخدام".$reason->getTranslation('subject', 'ar');
            else
            $title[$language->abbreviation] = "convert point to money using" .$reason->getTranslation('subject', 'en');
        }


        $transaction = Transaction::create([
            'reason_id' => $request->reason_id,
            'point' => -$points,
            'user_id' => $user->id,
            'value' => $price * $points,
            'client_id'=>$user->client_id,
            'title'=>$title,


        ]);









        foreach (Point::where('point', '>', 0)->where('user_id', $user->id)->where('expired_at', '>=', date('Y-m-d'))->where(function ($query) {
            $query->where('remain', null)->orWhere('remain', '>', 0);
        })->orderBy("expired_at", "asc")->get() as $row) {

            if ($points == 0)
                break;

            if ($row->remain == null) {
                if ($row->point > $points) {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'value' => $price * $points,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,

                    ]);
                    $row->update([
                        'remain' => $row->point - $points,
                    ]);


                    $points = 0;
                    array_push($negativeArray, $negative->id);
                    break;


                } elseif ($row->point == $points) {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'value' => $price * $points,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,



                    ]);
                    $row->update([
                        'remain' => 0,
                    ]);
                    array_push($negativeArray, $negative->id);

                    $points = 0;
                    break;


                } else {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'point' => -$row->point,
                        'user_id' => $user->id,
                        'value' => $price * $row->point,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $points = $points - $row->point;

                    $row->update([
                        'remain' => 0,
                    ]);

                    array_push($negativeArray, $negative->id);

                }

            } else {
                if ($row->remain > $points) {

                    $remain = $row->remain;
                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'value' => $price * $points,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,



                    ]);
                    $row->update([
                        'remain' => $remain - $points,
                    ]);


                    $points = 0;
                    array_push($negativeArray, $negative->id);
                    break;


                } elseif ($row->remain == $points) {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'value' => $price * $points,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,



                    ]);
                    $row->update([
                        'remain' => 0,
                    ]);
                    array_push($negativeArray, $negative->id);

                    $points = 0;
                    break;


                } else {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'point' => -$row->remain,
                        'user_id' => $user->id,
                        'value' => $price * $row->remain,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,



                    ]);
                    $points = $points - $row->remain;

                    $row->update([
                        'remain' => 0,
                    ]);

                    array_push($negativeArray, $negative->id);

                }
            }


        }


        $negativePoints = Point::whereIn('id', $negativeArray)->get();

        return $this->returnData(PointResource::collection($negativePoints), ['done'], 200);


    }


    public function convert_point_to_donation(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'app_id' => 'required',
                'name' => 'nullable',
                'email' => 'nullable',
                'phone' => 'nullable',
                'client_id' => 'required|exists:clients,id',
                'type_id' => 'required|exists:user_types,id',
                'reason_id' => 'required',
                'foreign_table' => 'required|in:how_to_redeems',
                'points' => 'required|integer',
                'donation_id' => 'required|exists:donations,id',

            ], []);
        if ($validator->fails()) {
            return $this->returnErrorValidation(collect($validator->errors())->flatten(1), 403);
        }

        $reason = HowToRedeem::where('client_id', $request->client_id)->find($request->reason_id);
        if (!$reason)
            return $this->returnError(['reason Not Found', 400]);

        $donation = Donation::where('client_id', $request->client_id)->where('user_type_id', $request->type_id)->find($request->donation_id);
        if (!$donation)
            return $this->returnError(['donation Not Found', 400]);

        $firstLevel = Level::where('client_id', $request->client_id)->where('user_type_id', $request->type_id)->orderBy('points', 'asc')->first();


        if (!$firstLevel)
            return $this->returnError(['Levels Not Found', 400]);


        $user = AvailableUser($request->app_id, $request->client_id, $request->type_id, $firstLevel->id, $request->name, $request->phone, $request->email);

        $order_id = $user->id . time();


        $permission = howToRedeemPoints($request->reason_id, $request->points, $user->id);


        if ($permission == 401) {
            return $this->returnErrorNotFound(['not found', 401]);
        }
        if ($permission == 405) {
            return $this->returnError(['your points is less than required ', 400]);
        }


        $levelPoint = howToRedeemAvailable($user->level_id, $request->points, $request->reason_id);
        if (!$levelPoint) {
            return $this->returnError(['your level points  less than required  ', 400]);
        }


        $pointForPrice = LevelPoint::where('client_id', $request->client_id)->where('user_type_id', $request->type_id)->where('level_id', $user->level_id)->latest()->first();

        if (!$pointForPrice) {
            return $this->returnError(['your level does not have price for point  ', 400]);

        }

        $price = $pointForPrice->currency ?? 0;
        $points = $request->points;
        $negativeArray = [];


        $availablePoints = Point::where('user_id', $user->id)->where('expired_at', '>=', date('Y-m-d'))->sum('point');

        if ($points > $availablePoints)
            return   $this->returnError(['points less than your Points'], 400);



        $title = [];
        foreach (Language::where('column_client_id', $user->client_id)->where('is_active', true)->get() as $index => $language) {
            if ($language->abbreviation == 'ar')
                $title[$language->abbreviation] = "تم اضافة تبرعات الي".$donation->getTranslation('name', 'ar');
            else
                $title[$language->abbreviation] = "add Donation To ". $donation->getTranslation('name', 'en');
        }


        $transaction = Transaction::create([
            'reason_id' => $request->reason_id,
            'foreign_table' => 'donations',
            'foreign_table_id' => $donation->id,
            'point' => -$points,
            'user_id' => $user->id,
            'value' => $price * $points,
            'client_id'=>$user->client_id,
            'title'=>$title,


        ]);



        foreach (Point::where('point', '>', 0)->where('user_id', $user->id)->where('expired_at', '>=', date('Y-m-d'))->where(function ($query) {
            $query->where('remain', null)->orWhere('remain', '>', 0);
        })->orderBy("expired_at", "asc")->get() as $row) {

            if ($points == 0)
                break;

            if ($row->remain == null) {

                if ($row->point > $points) {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'foreign_table' => 'donations',
                        'foreign_table_id' => $donation->id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'value' => $price * $points,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,



                    ]);
                    $row->update([
                        'remain' => $row->point - $points,
                    ]);


                    $points = 0;
                    array_push($negativeArray, $negative->id);
                    break;


                } elseif ($row->point == $points) {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'foreign_table' => 'donations',
                        'foreign_table_id' => $donation->id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'value' => $price * $points,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $row->update([
                        'remain' => 0,
                    ]);
                    array_push($negativeArray, $negative->id);

                    $points = 0;
                    break;


                } else {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'foreign_table' => 'donations',
                        'foreign_table_id' => $donation->id,
                        'point' => -$row->point,
                        'user_id' => $user->id,
                        'value' => $price * $row->point,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $points = $points - $row->point;

                    $row->update([
                        'remain' => 0,
                    ]);

                    array_push($negativeArray, $negative->id);

                }
            } else {
                if ($row->remain > $points) {


                    $remain = $row->remain;
                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'foreign_table' => 'donations',
                        'foreign_table_id' => $donation->id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'value' => $price * $points,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $row->update([
                        'remain' => $remain - $points,
                    ]);


                    $points = 0;
                    array_push($negativeArray, $negative->id);
                    break;


                } elseif ($row->remain == $points) {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'foreign_table' => 'donations',
                        'foreign_table_id' => $donation->id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'value' => $price * $points,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $row->update([
                        'remain' => 0,
                    ]);
                    array_push($negativeArray, $negative->id);

                    $points = 0;
                    break;


                } else {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'foreign_table' => 'donations',
                        'foreign_table_id' => $donation->id,
                        'point' => -$row->remain,
                        'user_id' => $user->id,
                        'value' => $price * $row->remain,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $points = $points - $row->remain;

                    $row->update([
                        'remain' => 0,
                    ]);

                    array_push($negativeArray, $negative->id);

                }
            }


        }


        $negativePoints = Point::whereIn('id', $negativeArray)->get();

        return $this->returnData(PointResource::collection($negativePoints), ['done'], 200);

    }

    public function add_indoor_offer(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'app_id' => 'required',
                'name' => 'nullable',
                'email' => 'nullable',
                'phone' => 'nullable',
                'client_id' => 'required|exists:clients,id',
                'type_id' => 'required|exists:user_types,id',
                'reason_id' => 'required',
                'foreign_table' => 'required|in:how_to_redeems',
                'promo_code' => 'required',
                'offer_id' => 'required|exists:offers,id',

            ], []);
        if ($validator->fails()) {
            return $this->returnErrorValidation(collect($validator->errors())->flatten(1), 403);
        }


        $reason = HowToRedeem::where('client_id', $request->client_id)->find($request->reason_id);
        if (!$reason)
            return $this->returnError(['reason Not Found', 400]);

        $offer = Offer::where('client_id', $request->client_id)->where('store_id', null)->find($request->offer_id);
        if (!$offer)
            return $this->returnError(['offer Not Found', 400]);

        $firstLevel = Level::where('client_id', $request->client_id)->orderBy('points', 'asc')->first();


        if (!$firstLevel)
            return $this->returnError(['Levels Not Found', 400]);


        $user = AvailableUser($request->app_id, $request->client_id, $request->type_id, $firstLevel->id, $request->name, $request->phone, $request->email);

        $order_id = $user->id . time();


        $offer = availableOffer($request->reason_id);

        if (!$offer)
            return $this->returnError(['Offer Not Found', 400]);

        $availablePoints = Point::where('user_id', $user->id)->where('expired_at', '>=', date('Y-m-d'))->sum('point');
        $levelPoint = offerPoint($user->level_id, $request->offer_id, $availablePoints);

        if (!$levelPoint)
            return $this->returnError(['your level  doesnt have this offer', 400]);

        if ($availablePoints < $levelPoint->points ?? 0)
            return $this->returnError(['your points less than required', 400]);


        $points = $levelPoint->points ?? 0;
        $negativeArray = [];



        $title = [];
        foreach (Language::where('column_client_id', $user->client_id)->where('is_active', true)->get() as $index => $language) {
            if ($language->abbreviation == 'ar')
                $title[$language->abbreviation] = "تم اضافة عرض " .$offer->getTranslation('subject', 'ar');
            else
                $title[$language->abbreviation] = "add  offer".$offer->getTranslation('subject', 'en');


        }


        $transaction = Transaction::create([
            'reason_id' => $request->reason_id,
            'foreign_table' => 'offers',
            'foreign_table_id' => $offer->id,
            'point' => -$points,
            'user_id' => $user->id,
            'client_id' => $user->client_id,
            'title'=>$title,

        ]);


        OfferCode::create([
            'offer_id' => $offer->id,
            'order_id' => $order_id,
            'promo_code' => $request->promo_code,
            'points' => $points,
            'column_client_id' => $user->client_id,
            'store_id' => $offer->store_id,
            'transaction_id' => $transaction->id,


        ]);


        foreach (Point::where('point', '>', 0)->where('user_id', $user->id)->where('expired_at', '>=', date('Y-m-d'))->where(function ($query) {
            $query->where('remain', null)->orWhere('remain', '>', 0);
        })->orderBy("expired_at", "asc")->get() as $row) {


            if ($points == 0)
                break;

            if ($row->remain == null) {


                if ($row->point > $points) {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'foreign_table' => 'offers',
                        'foreign_table_id' => $offer->id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'promo_code' => $request->promo_code,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,



                    ]);
                    $row->update([
                        'remain' => $row->point - $points,
                    ]);


                    $points = 0;
                    array_push($negativeArray, $negative->id);
                    break;


                } elseif ($row->point == $points) {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'foreign_table' => 'offers',
                        'foreign_table_id' => $offer->id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'promo_code' => $request->promo_code,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,



                    ]);
                    $row->update([
                        'remain' => 0,
                    ]);
                    array_push($negativeArray, $negative->id);

                    $points = 0;
                    break;


                } else {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'foreign_table' => 'offers',
                        'foreign_table_id' => $offer->id,
                        'point' => -$row->point,
                        'user_id' => $user->id,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'promo_code' => $request->promo_code,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,



                    ]);
                    $points = $points - $row->point;

                    $row->update([
                        'remain' => 0,
                    ]);

                    array_push($negativeArray, $negative->id);

                }

            } else {
                if ($row->remain > $points) {

                    $remain = $row->remain;

                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'foreign_table' => 'offers',
                        'foreign_table_id' => $offer->id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'promo_code' => $request->promo_code,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,



                    ]);
                    $row->update([
                        'remain' => $remain - $points,
                    ]);


                    $points = 0;
                    array_push($negativeArray, $negative->id);
                    break;


                } elseif ($row->remain == $points) {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'foreign_table' => 'offers',
                        'foreign_table_id' => $offer->id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'promo_code' => $request->promo_code,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,



                    ]);
                    $row->update([
                        'remain' => 0,
                    ]);
                    array_push($negativeArray, $negative->id);

                    $points = 0;
                    break;


                } else {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'foreign_table' => 'offers',
                        'foreign_table_id' => $offer->id,
                        'point' => -$row->remain,
                        'user_id' => $user->id,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'promo_code' => $request->promo_code,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,



                    ]);
                    $points = $points - $row->remain;

                    $row->update([
                        'remain' => 0,
                    ]);

                    array_push($negativeArray, $negative->id);

                }
            }

        }


        $negativePoints = Point::whereIn('id', $negativeArray)->get();

        return $this->returnData(PointResource::collection($negativePoints), ['done'], 200);


    }


    public function add_outdoor_offer(Request $request)
    {


        $validator = Validator::make($request->all(),
            [
                'app_id' => 'required',
                'name' => 'nullable',
                'email' => 'nullable',
                'phone' => 'nullable',
                'client_id' => 'required|exists:clients,id',
                'type_id' => 'required|exists:user_types,id',
                'reason_id' => 'required',
                'foreign_table' => 'required|in:how_to_redeems',
                'offer_id' => 'required|exists:offers,id',

            ], []);
        if ($validator->fails()) {
            return $this->returnErrorValidation(collect($validator->errors())->flatten(1), 403);
        }


        $reason = HowToRedeem::where('client_id', $request->client_id)->find($request->reason_id);
        if (!$reason)
            return $this->returnError(['reason Not Found', 400]);

        $offer = Offer::where('client_id', $request->client_id)->where('store_id', '!=', null)->find($request->offer_id);
        if (!$offer)
            return $this->returnError(['offer Not Found', 400]);

        $firstLevel = Level::where('client_id', $request->client_id)->orderBy('points', 'asc')->first();


        if (!$firstLevel)
            return $this->returnError(['Levels Not Found', 400]);


        $user = AvailableUser($request->app_id, $request->client_id, $request->type_id, $firstLevel->id, $request->name, $request->phone, $request->email);

        $order_id = $user->id . time();

        $offer = availableOffer($request->reason_id);

        if (!$offer)
            return $this->returnError(['Offer Not Found', 400]);

        $availablePoints = Point::where('user_id', $user->id)->where('expired_at', '>=', date('Y-m-d'))->sum('point');
        $levelPoint = offerPoint($user->level_id, $request->offer_id, $availablePoints);

        if (!$levelPoint)
            return $this->returnError(['your level  doesnt have this offer', 400]);

        if ($availablePoints < $levelPoint->points ?? 0)
            return $this->returnError(['your points less than required', 400]);


        $points = $levelPoint->points ?? 0;
        $negativeArray = [];
        $promo_code = $user->id . time() . rand(99, 999999);


        $qrcode = saveQrCode($promo_code);



        $title = [];
        foreach (Language::where('column_client_id', $user->client_id)->where('is_active', true)->get() as $index => $language) {
            if ($language->abbreviation == 'ar')
                $title[$language->abbreviation] = "تم اضافة عرض ".$offer->getTranslation('subject', 'ar');
            else
                $title[$language->abbreviation] = "add offer".$offer->getTranslation('subject', 'en');


        }


        $transaction = Transaction::create([
            'reason_id' => $request->reason_id,
            'foreign_table' => 'offers',
            'foreign_table_id' => $offer->id,
            'point' => -$points,
            'user_id' => $user->id,
            'client_id' => $user->client_id,
            'title'=>$title,


        ]);





        OfferCode::create([
            'offer_id' => $offer->id,
            'order_id' => $order_id,
            'promo_code' => $promo_code,
            'points' => $points,
            'image' => $qrcode,
            'column_client_id' => $user->client_id,
            'user_id' => $user->id,
            'store_id' => $offer->store_id,
            'transaction_id' => $transaction->id,

        ]);


        foreach (Point::where('point', '>', 0)->where('user_id', $user->id)->where('expired_at', '>=', date('Y-m-d'))->where(function ($query) {
            $query->where('remain', null)->orWhere('remain', '>', 0);
        })->orderBy("expired_at", "asc")->get() as $row) {


            if ($points == 0)
                break;

            if ($row->remain == null) {


                if ($row->point > $points) {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'foreign_table' => 'offers',
                        'foreign_table_id' => $offer->id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'promo_code' => $promo_code,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $row->update([
                        'remain' => $row->point - $points,
                    ]);


                    $points = 0;
                    array_push($negativeArray, $negative->id);
                    break;


                } elseif ($row->point == $points) {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'foreign_table' => 'offers',
                        'foreign_table_id' => $offer->id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'promo_code' => $promo_code,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $row->update([
                        'remain' => 0,
                    ]);
                    array_push($negativeArray, $negative->id);

                    $points = 0;
                    break;


                } else {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'foreign_table' => 'offers',
                        'foreign_table_id' => $offer->id,
                        'point' => -$row->point,
                        'user_id' => $user->id,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'promo_code' => $promo_code,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $points = $points - $row->point;

                    $row->update([
                        'remain' => 0,
                    ]);

                    array_push($negativeArray, $negative->id);

                }

            } else {
                if ($row->remain > $points) {

                    $remain = $row->remain;

                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'foreign_table' => 'offers',
                        'foreign_table_id' => $offer->id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'promo_code' => $promo_code,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $row->update([
                        'remain' => $remain - $points,
                    ]);


                    $points = 0;
                    array_push($negativeArray, $negative->id);
                    break;


                } elseif ($row->remain == $points) {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'foreign_table' => 'offers',
                        'foreign_table_id' => $offer->id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'promo_code' => $promo_code,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $row->update([
                        'remain' => 0,
                    ]);
                    array_push($negativeArray, $negative->id);

                    $points = 0;
                    break;


                } else {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'foreign_table' => 'offers',
                        'foreign_table_id' => $offer->id,
                        'point' => -$row->remain,
                        'user_id' => $user->id,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'promo_code' => $promo_code,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $points = $points - $row->remain;

                    $row->update([
                        'remain' => 0,
                    ]);

                    array_push($negativeArray, $negative->id);

                }
            }

        }


        $negativePoints = Point::whereIn('id', $negativeArray)->get();

        return $this->returnData(PointResource::collection($negativePoints), ['done'], 200);


    }


    public function point_to_money(Request $request)
    {


        $validator = Validator::make($request->all(),
            [
                'app_id' => 'required',
                'name' => 'nullable',
                'email' => 'nullable',
                'phone' => 'nullable',
                'client_id' => 'required|exists:clients,id',
                'type_id' => 'required|exists:user_types,id',
                'points' => 'required|integer',

            ], []);

        if ($validator->fails()) {
            return $this->returnErrorValidation(collect($validator->errors())->flatten(1), 403);
        }


        $firstLevel = Level::where('client_id', $request->client_id)->where('user_type_id', $request->type_id)->orderBy('points', 'asc')->first();
        if (!$firstLevel)
            return $this->returnError(['Levels Not Found', 400]);


        $user = AvailableUser($request->app_id, $request->client_id, $request->type_id, $firstLevel->id, $request->name, $request->phone, $request->email);


        $order_id = $user->id . time();


        $pointForPrice = LevelPoint::where('client_id', $request->client_id)->where('user_type_id', $request->type_id)->where('level_id', $user->level_id)->latest()->first();

        if (!$pointForPrice) {
            return $this->returnError(['your level does not have price for point  ', 400]);

        }

        if ($pointForPrice->limit>$request->points) {
            return $this->returnError(['The Points is Less Than The Limit Of Levels ', 400]);
        }

        $price = $pointForPrice->currency ?? 0;
        $points = $request->points;
        $total_price = $points * $price;
        $negativeArray = [];

        $availablePoints = Point::where('user_id', $user->id)->where('expired_at', '>=', date('Y-m-d'))->sum('point');

        if ($points > $availablePoints)
         return   $this->returnError(['points less than your Points'], 400);



        $title = [];
        foreach (Language::where('column_client_id', $user->client_id)->where('is_active', true)->get() as $index => $language) {
            if ($language->abbreviation == 'ar')
                $title[$language->abbreviation] = "تحويل نقاط الي مبلغ مالي";
            else
                $title[$language->abbreviation] = "convert Point To Money";


        }


        $transaction = Transaction::create([
            'reason_id' => $request->reason_id,
            'point' => -$points,
            'user_id' => $user->id,
            'value' => $price * $points,
            'title' => $title,
            'client_id' => $user->client_id,

        ]);


        foreach (Point::where('point', '>', 0)->where('user_id', $user->id)->where('expired_at', '>=', date('Y-m-d'))->where(function ($query) {
            $query->where('remain', null)->orWhere('remain', '>', 0);
        })->orderBy("expired_at", "asc")->get() as $row) {

            if ($points == 0)
                break;

            if ($row->remain == null) {
                if ($row->point > $points) {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'value' => $price * $points,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,

                    ]);
                    $row->update([
                        'remain' => $row->point - $points,
                    ]);


                    $points = 0;
                    array_push($negativeArray, $negative->id);
                    break;


                } elseif ($row->point == $points) {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'value' => $price * $points,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $row->update([
                        'remain' => 0,
                    ]);
                    array_push($negativeArray, $negative->id);

                    $points = 0;
                    break;


                } else {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'point' => -$row->point,
                        'user_id' => $user->id,
                        'value' => $price * $row->point,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $points = $points - $row->point;

                    $row->update([
                        'remain' => 0,
                    ]);

                    array_push($negativeArray, $negative->id);

                }

            } else {
                if ($row->remain > $points) {

                    $remain = $row->remain;
                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'value' => $price * $points,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $row->update([
                        'remain' => $remain - $points,
                    ]);


                    $points = 0;
                    array_push($negativeArray, $negative->id);
                    break;


                } elseif ($row->remain == $points) {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'value' => $price * $points,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $row->update([
                        'remain' => 0,
                    ]);
                    array_push($negativeArray, $negative->id);

                    $points = 0;
                    break;


                } else {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'point' => -$row->remain,
                        'user_id' => $user->id,
                        'value' => $price * $row->remain,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $points = $points - $row->remain;

                    $row->update([
                        'remain' => 0,
                    ]);

                    array_push($negativeArray, $negative->id);

                }
            }

        }

        $negativePoints = Point::whereIn('id', $negativeArray)->get();

        return $this->returnData(['value' => $price * (int)$request->points], ['done'], 200);


    }





    public function point_to_coupon(Request $request){
        $validator = Validator::make($request->all(),
            [
                'app_id' => 'required',
                'name' => 'nullable',
                'email' => 'nullable',
                'phone' => 'nullable',
                'client_id' => 'required|exists:clients,id',
                'type_id' => 'required|exists:user_types,id',
                'points' => 'required|integer',
                'foreign_table'=>'required|in:converts',
                'foreign_table_id' => 'required|exists:converts,id',

            ], []);

        if ($validator->fails()) {
            return $this->returnErrorValidation(collect($validator->errors())->flatten(1), 403);
        }

        $firstLevel = Level::where('client_id', $request->client_id)->where('user_type_id', $request->type_id)->orderBy('points', 'asc')->first();
        if (!$firstLevel)
            return $this->returnError(['Levels Not Found', 400]);


        $user = AvailableUser($request->app_id, $request->client_id, $request->type_id, $firstLevel->id, $request->name, $request->phone, $request->email);


        $order_id = $user->id . time();


        $pointForPrice = LevelPoint::where('client_id', $request->client_id)->where('user_type_id', $request->type_id)->where('level_id', $user->level_id)->latest()->first();

        if (!$pointForPrice) {
            return $this->returnError(['your level does not have price for point  ', 400]);

        }

        if ($pointForPrice->limit>$request->points) {
            return $this->returnError(['The Points is Less Than The Limit Of Levels ', 400]);
        }

        $price = $pointForPrice->currency ?? 0;
        $points = $request->points;
        $total_price = $points * $price;
        $negativeArray = [];

        $availablePoints = Point::where('user_id', $user->id)->where('expired_at', '>=', date('Y-m-d'))->sum('point');

        if ($points > $availablePoints)
            return   $this->returnError(['points less than your Points'], 400);



        $title = [];
        foreach (Language::where('column_client_id', $user->client_id)->where('is_active', true)->get() as $index => $language) {
            if ($language->abbreviation == 'ar')
                $title[$language->abbreviation] = "تحويل نقاط الي مبلغ مالي";
            else
                $title[$language->abbreviation] = "convert Point To Money";


        }


        $transaction = Transaction::create([
            'reason_id' => $request->reason_id,
            'point' => -$points,
            'user_id' => $user->id,
            'value' => $price * $points,
            'title' => $title,
            'client_id' => $user->client_id,

        ]);


        foreach (Point::where('point', '>', 0)->where('user_id', $user->id)->where('expired_at', '>=', date('Y-m-d'))->where(function ($query) {
            $query->where('remain', null)->orWhere('remain', '>', 0);
        })->orderBy("expired_at", "asc")->get() as $row) {

            if ($points == 0)
                break;

            if ($row->remain == null) {
                if ($row->point > $points) {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'value' => $price * $points,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,

                    ]);
                    $row->update([
                        'remain' => $row->point - $points,
                    ]);


                    $points = 0;
                    array_push($negativeArray, $negative->id);
                    break;


                } elseif ($row->point == $points) {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'value' => $price * $points,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $row->update([
                        'remain' => 0,
                    ]);
                    array_push($negativeArray, $negative->id);

                    $points = 0;
                    break;


                } else {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'point' => -$row->point,
                        'user_id' => $user->id,
                        'value' => $price * $row->point,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $points = $points - $row->point;

                    $row->update([
                        'remain' => 0,
                    ]);

                    array_push($negativeArray, $negative->id);

                }

            } else {
                if ($row->remain > $points) {

                    $remain = $row->remain;
                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'value' => $price * $points,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $row->update([
                        'remain' => $remain - $points,
                    ]);


                    $points = 0;
                    array_push($negativeArray, $negative->id);
                    break;


                } elseif ($row->remain == $points) {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'point' => -$points,
                        'user_id' => $user->id,
                        'value' => $price * $points,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $row->update([
                        'remain' => 0,
                    ]);
                    array_push($negativeArray, $negative->id);

                    $points = 0;
                    break;


                } else {


                    $negative = Point::create([
                        'reason_id' => $request->reason_id,
                        'point' => -$row->remain,
                        'user_id' => $user->id,
                        'value' => $price * $row->remain,
                        'expired_at' => $row->expired_at,
                        'sub_id' => $row->id,
                        'order_id' => $order_id,
                        'column_client_id' => $user->client_id,
                        'transaction_id' => $transaction->id,


                    ]);
                    $points = $points - $row->remain;

                    $row->update([
                        'remain' => 0,
                    ]);

                    array_push($negativeArray, $negative->id);

                }
            }

        }

        $negativePoints = Point::whereIn('id', $negativeArray)->get();

        return $this->returnData(['value' => $price * (int)$request->points], ['done'], 200);






    }











}
