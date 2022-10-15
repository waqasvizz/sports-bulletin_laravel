<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailMessage;
use App\Models\ShortCode;


class EmailMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posted_data = array();
        $posted_data['paginate'] = 10;
        $data = $this->EmailMessageObj->getEmailMessages($posted_data);
        return view('email_message.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $posted_data = array();
        $data['short_codes'] = ShortCode::getEmailShortCode($posted_data);
        // echo '<pre>';print_r($data);echo '</pre>';exit;
        return view('email_message.add',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request_data = $request->all();

        echo "Line no @111"."<br>";
        echo "<pre>";
        print_r($request_data);
        echo "</pre>";
        exit("@@@@");

        $rules = array(
            'subject' => 'required',
            'message' => 'required'
        );

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $posted_data = $request->all();
            // echo '<pre>';print_r($posted_data);echo '</pre>';exit;
            $this->EmailMessageObj->saveUpdateEmailMessages($posted_data);

            \Session::flash('message', 'Email Message created successfully!');
            return redirect('/emailMessage');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posted_data = array();
        $posted_data['id'] = $id;
        $posted_data['detail'] = true;
       
        // $data['short_codes'] = ShortCode::getEmailShortCode($posted_data);
        $data = $this->EmailMessageObj->getEmailMessages($posted_data);
        $data['short_codes'] = ShortCode::all();
        // echo '<pre>';print_r($data);echo '</pre>';exit;
        return view('email_message.add', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request_data = $request->all();
        $request_data['update_id'] = $id;

        $rules = array(
            'subject' => 'required',
            'message' => 'required'
        );

        $validator = \Validator::make($request_data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->EmailMessageObj->saveUpdateEmailMessages($request_data);

        \Session::flash('message', 'Email Message updated successfully!');
        // return redirect('/enquiry_forms');
        return redirect('/emailMessage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailMessage $emailMessage)
    {
        $emailMessage->delete(); 
        \Session::flash('message', 'Email Message deleted successfully!');
        return redirect('/emailMessage');
    }
}
