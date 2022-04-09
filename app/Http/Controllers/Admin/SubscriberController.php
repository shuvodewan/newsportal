<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SubscriberMail;
use App\Models\GeneralSettings;
use App\Models\Subscriber;
use Datatables;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use App\Classes\GeniusMailer;

class SubscriberController extends Controller
{
    public function datatables(){
        $datas = Subscriber::orderBy('id','desc')->get();
        return Datatables::of($datas)
                                ->rawColumns([''])
                                ->toJson();
    }
    public function index(){
        return view('admin.subscriber.index');
    }
    //*** GET Request
    public function download()
    {
        //  Code for generating csv file
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=subscribers.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('Subscribers Emails'));
        $result = Subscriber::all();
        foreach ($result as $row){
            fputcsv($output, $row->toArray());
        }
        fclose($output);
    }
    public function email(){
        return view('admin.subscriber.email.index');
    }
    
    public function sendemail(Request $request){
        $gs = Generalsettings::findOrFail(1);
        $subscribers = Subscriber::all();

        foreach($subscribers as $subscriber){

            if($gs->is_smtp == 1)
	        {
	        $data = [
	            'to' => $subscriber->email,
	            'subject' => $request->subject,
	            'body' => $request->body,
	        ];

	        $mailer = new GeniusMailer();
	        $mailer->sendCustomMail($data);
	        }
	        else
	        {
	        $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
	        mail($subscriber->email,$request->subject,$request->body,$headers);
            }        

        }
        $msg = 'Mail Send to Subscribers';
        return response()->json($msg);
    }
}
