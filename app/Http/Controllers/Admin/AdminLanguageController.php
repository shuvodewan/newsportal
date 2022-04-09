<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminLanguage;
use Datatables;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;

class AdminLanguageController extends Controller
{
    public function datatables(){
        $datas = AdminLanguage::orderBy('id','desc')->get();
        return Datatables::of($datas)
                            ->addColumn('action',function(AdminLanguage $data){
                                $delete = $data->id == 1 ? '':'<a href="javascript:;" data-href="' . route('admin.admin_language.delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a>';
                                $default = $data->is_default == 1 ? '<a><i class="fa fa-check"></i> Default</a>' : '<a href="'.route('admin.admin_language.status',$data->id).'">Set Default</a>';
                                return '<div class="action-list"><a href="' . route('admin.admin_language.edit',$data->id) . '"> <i class="fas fa-edit"></i>'.__('Edit').'</a>'.$delete.$default.'</div>';
                            })
                            ->rawColumns(['action'])
                            ->toJson();
    }

    public function index(){
        return view('admin.adminLanguage.index');
    }
    public function create(){
        return view('admin.adminLanguage.create');
    }

    public function store(Request $request){
        //--- Logic Section
        $new = null;
        $input = $request->all();
        $data = new AdminLanguage();
        $data->language = $input['language'];
        $name = time().Str::random(8);
        $data->name = $name;
        $data->file = $name.'.json';
        $data->rtl = $input['rtl'];
        $data->save();
        unset($input['_token']);
        unset($input['language']);
        $keys = $request->keys;
        $values = $request->values;
        foreach(array_combine($keys,$values) as $key => $value)
        {
            $n = str_replace("_"," ",$key);
            $new[$n] = $value;
        }  
        $mydata = json_encode($new);
        file_put_contents(base_path().'/../project/resources/lang/'.$data->file, $mydata); 
        //--- Logic Section Ends
 
        //--- Redirect Section        
        $msg = __('New Data Added Successfully.');
        return response()->json($msg);      
        //--- Redirect Section Ends    
     }

     public function edit($id){
        $data = AdminLanguage::findOrFail($id);
        $data_results = file_get_contents(base_path().'/../project/resources/lang/'.$data->file);
        $lang = json_decode($data_results, true);
   
        return view('admin.adminLanguage.edit',compact('data','lang'));
    }

    public function update(Request $request,$id){

       //--- Logic Section
       $new = null;
       $input = $request->all();
       $data = AdminLanguage::findOrFail($id);
       if (file_exists(base_path().'/../project/resources/lang/'.$data->file)) {
           unlink(base_path().'/../project/resources/lang/'.$data->file);
       }
       $data->language = $input['language'];
       $name = time().Str::random(8);
       $data->name = $name;
       $data->file = $name.'.json';
       $data->rtl = $input['rtl'];
       $data->update();
       unset($input['_token']);
       unset($input['language']);
       $keys = $request->keys;
       $values = $request->values;
       foreach(array_combine($keys,$values) as $key => $value)
       {
           $n = str_replace("_"," ",$key);
           $new[$n] = $value;
       }        
       $mydata = json_encode($new);
       file_put_contents(base_path().'/../project/resources/lang/'.$data->file, $mydata); 
       //--- Logic Section Ends

       $msg = __('New Data Added Successfully.');
       return response()->json($msg);  
    }

    public function status($id){
        $language_update =  AdminLanguage::find($id);
        $language_update->is_default = 1;
        $language_update->update();

        $previous_languages = AdminLanguage::where('id','!=',$id)->get();

        foreach($previous_languages as $previous_language){
            $previous_language->is_default = 0;
            $previous_language->update();
        }
        Toastr::success('Data Updated Successfully');
        return redirect()->back();
   }

   public function delete($id){
        if($id == 1)
        {
        return "You don't have access to remove this language.";
        }
        $data = AdminLanguage::findOrFail($id);
        if($data->is_default == 1)
        {
        return "You can not remove default language.";            
        }
        if (file_exists(base_path().'/../project/resources/lang/'.$data->file)) {
            unlink(base_path().'/../project/resources/lang/'.$data->file);
        }
        $data->delete();
        //--- Redirect Section     
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends    
   }
}
