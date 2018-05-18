<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Contact;
use Validator, DB, Auth;
use Carbon\Carbon;

class ContactsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('index');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getContacts()
    {
        $contacts = DB::table('contacts')->orderBy('name', 'desc')->where('user_id', Auth::id())->get();
        return response()->json($contacts, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $current_date = Carbon::now();
        $user_id = Auth::id();
        //validation input data
        $validator = Validator::make($data, [
            'name' => 'required|max:32|min:3',
            'surname' => 'required|max:64|min:3',
            'email' => 'required|unique:contacts,email|max:64',
            'phone' => 'required|numeric',
            'date_birth' => 'required|before_or_equal:'.$current_date
         ]);
        if($validator->fails()){
            return $validator->errors()->all();
        }
        
        $contact = new Contact;
        foreach ($data as $key => $value) {
            $contact->$key = strip_tags($value);
        }
        $contact->user_id = $user_id;
        
        if($contact->save()){
            return response()->json(['success' => 'The contact was added!'], 200);
        }
        return response()->json(['error' => 'Something was wrong!'], 201);
        
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::where('id', $id)->first();
        return response()->json($contact, 200);
        
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
        $data = $request->all();
        $current_date = Carbon::now();
        $user_id = Auth::id();
        $contact = Contact::where('id',$id)->first();
        //validation input data
        $validator = Validator::make($data, [
            'name' => 'required|max:32|min:3',
            'surname' => 'required|max:64|min:3',
            'email' => [
                'required',
                'max:64',
                Rule::unique('contacts')->ignore($contact->id)
            ],
            'phone' => 'required|numeric',
            'date_birth' => 'required|before_or_equal:'.$current_date
         ]);
        if($validator->fails()){
            return $validator->errors()->all();
        }
        
        foreach ($data as $key => $value) {
            $contact->$key = strip_tags($value);
        }
        $contact->user_id = $user_id;
        
        if($contact->update()){
            return response()->json(['success' => 'The contact was updated!'], 200);
        }
        return response()->json(['error' => 'Something was wrong!'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $contact=Contact::where(['id' => $id, 'user_id' => Auth::id()])->first();
        $contact->delete();
    }
}
