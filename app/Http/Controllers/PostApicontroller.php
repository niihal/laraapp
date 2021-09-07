<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostApi;
use Illuminate\Http\Response;
use Illuminate\Support\Faceds\Hash;
use Exception;

class PostApicontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PostApi::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'title' => 'required',
                'author' => 'required',
                'version' => 'required'
            ]);

            $post = PostApi::create($request->all());

        }catch(Exception $e){
            
            $message = [
                "message" => "Duplicte Entry",
                "code" => "400"
            ];
            return response($message,500);
        }

        $response = [
            'user' => $post
        ];

        return response($response,200);
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
        //
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
        $post = PostApi::find($id);
        
        if(!empty($post)){
            $post->update($request->all());
            $response = [
                'post' => $post,
                'code' => '201'
            ];
        }else{
            $response = [
                'meesage' => "No Post Found with Associated Id",
                'code' => '500'
            ];
        }
        return response($response,$response['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = PostApi::find($id);
        
        if(!empty($post)){
            $post = PostApi::destroy($id);
            $response = [
                'message' => isset($post) ? "Deleted Post Successfully" : "Error",
                'code' => '201'
            ];
        }else{
            $response = [
                'meesage' => "No Post Found with Associated Id",
                'code' => '500'
            ];
        }
        return response($response,$response['code']);
    }
}
