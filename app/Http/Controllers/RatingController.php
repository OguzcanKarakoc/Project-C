<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProsCon;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if (Auth::guard('user')->check()) {
            if (!is_null($rating = Rating::where('user_id', Auth::guard('user')->user()->id)->where('product_id', $request->product_id)->first())) {
            } else {
                $rating = new Rating();
            }
            /** @var Product $product */
            if ($product = Product::find($request->product_id)) {
                $rating->user_id = Auth::guard('user')->user()->id;
                $rating->product_id = $request->product_id;
                $rating->rating = $request->rating;
                if (isset($request->comment)) {
                    $rating->comment = $request->comment;
                }

                $rating->save();

                if (isset($request->updateCons)) {
                    foreach ($request->updateCons as $updateCon => $value) {
                        $cons = ProsCon::find($updateCon);
                        if ($value == '') {
                            $cons->delete();
                        } else {
                            $cons->text = $value;
                            $cons->save();
                        }
                    }
                }

                if (isset($request->updatePros)) {
                    foreach ($request->updatePros as $updatePro => $value) {
                        $pros = ProsCon::find($updatePro);
                        if ($value == '') {
                            $pros->delete();
                        } else {
                            $pros->text = $value;
                            $pros->save();
                        }
                    }
                }

                if (isset($request->pros)) {
                    foreach ($request->pros as $pro) {
                        $proObj = new ProsCon();
                        $proObj->vote = true;
                        $proObj->text = $pro;
                        $proObj->rating_id = $rating->id;
                        $proObj->save();
                    }
                }

                if (isset($request->cons)) {
                    foreach ($request->cons as $con) {
                        $conObj = new ProsCon();
                        $conObj->vote = false;
                        $conObj->text = $con;
                        $conObj->rating_id = $rating->id;
                        $conObj->save();
                    }
                }

                $avgRating = $product->ratings()->avg('rating');

                return response()->json([
                    'name' => 'Rating saved',
                    'avgRating' => $avgRating,
                    'state' => 'success',
                ]);
            }

            return response()->json([
                'name' => 'Product not found',
                'state' => 'error'
            ]);
        }

        return response()->json([
            'name' => 'This shouldn\'t happen',
            'state' => 'error'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteProsCons(Request $request)
    {
        /** @var Product $product */
        if ($prosCons = ProsCon::find($request->id)) {
            $prosCons->delete();

            return response()->json([
                'id' => $request->id,
                'name' => 'deleted',
                'state' => 'success',
            ]);
        }

        return response()->json([
            'id' => $request->id,
            'name' => 'Not found',
            'state' => 'error'
        ]);
    }

}
