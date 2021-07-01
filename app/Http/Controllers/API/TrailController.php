<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Trail;
use App\TrailItem;

class TrailController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
	public function storetrail(Request $request)
    {
		$validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'trail_to' => 'required',
            'flying_from' => 'required',
			'total_cost' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
		$customerId=$request->customer_id;
		$trialTo=$request->trail_to;
		$flyingFrom=$request->flying_from;
		$totalCost=$request->total_cost;
		
		
		$createTrail = Trail::create([
        'customer_id' => $customerId,
        'trail_to' => $trialTo,
		'flying_from' => $flyingFrom,
        'total_cost' => $totalCost,
        ]);
		
  
		
        if($createTrail != ""){
		$response = [
                'status' => true,
                "message" => "Trial Created Successfully."];
            return response($response, 200);	
         }
        else {
            $response = [
                'status' => false,
                "message" => "Oops! Trial not created."];
            return response($response, 200);
        }
		 
    }   
	 
	public function gettrail(Request $request)
    {
		$trialId=$request->id;
        $trailDetails = Trail::where('id', $trialId)->first();
		
        if($trailDetails != ""){
		$success  =array('status'=>true,
                 'customer_id' =>$trailDetails->customer_id,
                 'trail_to'=>$trailDetails->trail_to,
				 'flying_from'=>$trailDetails->flying_from,
				 'total_cost'=>$trailDetails->total_cost);
        return response()->json($success, 200);  	
         }
        else {
            $response = [
                'status' => false,
                "message" => $trialId." is not found."];
            return response($response, 200);
        }
		 
    } 
    public function updatetrailitem(Request $request)
    {
		$trialItemId=$request->id;
		$trialItemCost=$request->cost;
        
        if($trialItemId != ""){			
		$updateTrialItem = TrailItem::where('id', $trialItemId)
            ->update(['cost' => $trialItemCost]);	
		
		$trailItemDetails = TrailItem::where('id', $trialItemId)->first();
		$getTrialId=$trailItemDetails->trail_id;					

        $sumTrial = TrailItem::where('trail_id','=', $getTrialId)->sum('cost');
         
		$updateTrial = Trail::where('id', $getTrialId)
            ->update(['total_cost' => $sumTrial]); 
			
	    $response = [
                'status' => true,
                "message" => "Updated Successfully!"];
        return response()->json($response, 200);  	
         }
        else {
            $response = [
                'status' => false,
                "message" => "Id not found"];
            return response($response, 200);
        }
		 
    }  	
	
	
	
}