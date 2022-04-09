<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use App\Models\Language;
use App\Models\PollAnswer;
use App\Models\PollQuestion;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Datatables;
use Carbon\Carbon;

class PollController extends Controller
{
    public function datatables(){
        $datas = PollQuestion::orderBy('id','desc')->get();
        return Datatables::of($datas)
                            ->addColumn('action', function(PollQuestion $data) {
                                return '<div class="action-list"><a data-href="'.route('addPolls.edit',$data->id) .'" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="'.route('addPolls.delete',$data->id).'" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            })
                            ->addColumn('view', function(PollQuestion $data) {
                                return '<div class="action-list"><a data-href="'.route('pollOption.pollview',$data->id) .'"  class="edit" data-toggle="modal" data-target="#modal1"> <i class="fa fa-eye"></i>Poll View</a>';
                            })
                            ->addColumn('question', function(PollQuestion $data) {
                                return $question = (strlen($data->question) >50 ? mb_substr($data->question,0,50).'....' : $data->question);
                            })
                            ->editColumn('language_id',function(PollQuestion $data){
                                return $language_id = $data->language_id ? $data->language->language : '';
                            })
                            ->editColumn('status',function(PollQuestion $data){
                                $status = $data->status == 1 ? '<span class="btn btn-success btn-sm" style="border-radius: 15px;"> <i class="fas fa-eye"></i> visible</span>' : '<span class="btn btn-danger btn-sm" style="border-radius: 15px;"> <i class="fas fa-eye-slash"></i> Invisisble</span>';
                                return $status;
                            })
                            ->rawColumns(['action','view','language_id','status'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }
    public function index(){
        return view('admin.polls.index');
    }

    public function create(){
        $datas = Language::orderBy('id','desc')->get();
        return view('admin.polls.create',compact('datas'));
    }

    public function store(Request $request){
        $rules = [
            'language_id' => 'required',
            'question' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        $data = new PollQuestion();
        $input = $request->all();
        $data->fill($input)->save();

        $last_id = $data->id;
        $poll_options = $request->poll_option;
        foreach($poll_options as $value){
            if(!empty($value)){
                $data  = new PollAnswer();
                $data->poll_question_id = $last_id;
                $data->poll_option = $value;
                $data->save();
            }
        }

        Toastr::success('Data Updated Successfully');
        $msg = 'Data Added Successfully';
        return response()->json($msg);
    }
    public function edit($id){
        $poll_option  = PollQuestion::find($id);
        $datas = Language::orderBy('id','desc')->get();
        return view('admin.polls.edit',compact('datas','poll_option'));
    }

    public function update(Request $request,$id){
        
        $rules = [
            'language_id' => 'required',
            'question' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(array('errors'=>$validator->getMessageBag()->toArray()));
        }
        $data = PollQuestion::find($id);
        $input = $request->all();
        $data->update($input);

        $last_id = $data->id;
        $poll_options = PollAnswer::where('poll_question_id',$last_id)->get();
        foreach($poll_options as $option){
            $option->delete();
        }

        $poll_options = $request->poll_option;
        foreach($poll_options as $value){
            if(!empty($value)){
                $data  = new PollAnswer();
                $data->poll_question_id = $last_id;
                $data->poll_option = $value;
                $data->save();
            }
        }

        Toastr::success('Data Updated Successfully');
        $msg = 'Data Updated Successfully';
        return response()->json($msg);
    }


    public function pollview($id){
        $data = PollQuestion::find($id);
        return view('admin.polls.view',compact('data'));
    }

    public function showOnHomePage(){
        $polls = PollQuestion::where('status','=',1)->get();
        $gs = GeneralSettings::find(1);
        if(count($polls)>0){
        foreach($polls as $poll){
        $current_time = Carbon::now($gs->time_zone)->format('Y-m-d H:i:s');
        $today = Carbon::parse($current_time);
        $end_date = $poll->end_date;
            if($today->gt($end_date)){
                $poll->status = 0;
                $poll->update();
            }
        }
            Toastr::success('Data Updated Successfully');
            return redirect()->route('addPolls.index');
        }else{
            Toastr::success('Data Updated Successfully');
            return redirect()->route('addPolls.index');
        }
    }

    public function delete($id){

        $data = PollQuestion::find($id);
        $poll_options = $data->child;

        foreach($poll_options as  $poll_option){
            $answer = $poll_option::find($poll_option->id);
            $answer->delete();
        }
        $data->delete();
        $msg = 'Data Deleted Successfully';
        return response()->json($msg);
    }
}
