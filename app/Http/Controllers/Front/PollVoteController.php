<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PollAnswer;
use App\Models\PollQuestion;
use App\Models\PollResult;
use DB;

class PollVoteController extends Controller
{
    public function vote(Request $request){
       $ip = $request->ip();
       $que = $request->poll_question_id;
        $is_check = PollResult::where('poll_question_id','=',$que)
                                        ->where('ip_address','=',$ip)
                                        ->first();
        if($is_check == ''){
           $answer = $request->poll_answer_id;
           if($answer != ''){
                $data  = new PollResult();
                $input = $request->all();
                $input['ip_address'] = $ip;
                $data->fill($input)->save();
                return 'success';
           }else{
                $msg = '<span class="text-danger">Please select any option</span>';
                return response()->json(['errors'=>$msg]);
           }
           
           
        }else{
            $msg = '<span class="text-danger">You already vote this poll</span>';
            return response()->json(['errors'=>$msg]);
        }
    }

    public function result($id){
        $result = PollResult::where('poll_question_id','=',$id)->get();
       if(count($result)>0){
           $row = count( $result);
           $values = $result->groupBy('poll_answer_id');
           if(count($values)>0){
            foreach($values as $value){
                $answer[] = round((count($value)/$row)*100,2);
            }
             $poll_results = $answer;
           }else{
               $msg = '<span class="text-danger">please give a vote</span>';
               return response()->json($msg);
           }
            $output = '';
            $i=0;
            $count = DB::table('poll_results')
            ->select(DB::raw('COUNT(*) as total'), 'poll_answer_id')
            ->groupBy('poll_question_id', 'poll_answer_id')
            ->having('poll_question_id', '=', $id)
            ->get();
           foreach($poll_results as $poll_result){
                $id = $count[$i]->poll_answer_id;
                $child = PollAnswer::find($id)->poll_option;

            $output .='<div class="progress m-2">
                <div class="progress-bar" role="progressbar" style="width: '.$poll_result.'%" aria-valuenow="'.$poll_result.'" aria-valuemin="0" aria-valuemax="100">'.$poll_result.' %</div>'.$child.'
            </div>';
            $i++;
           }
           return $output;
       }else{
        $msg = '<span class="text-danger">please give a vote</span>';
        return response()->json($msg);
       }
    }

}
