<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Http\Requests\ClientRequest;
use App\Client;

class ClientController extends Controller{
  public function index(){
    $clients = Client::latest()->get();
    return response()->json($clients);
  }//end function

  public function store(ClientRequest $request){
    $request = Request::merge(array_map("trim", $request->all()));
    $client = Client::create($request->all());
    return response()->json($client, 201);
  }//end function

  public function show($id){
    $client = Client::findOrFail($id);
    return response()->json($client);
  }//end function

  public function update(ClientRequest $request, $id){
    $client = Client::findOrFail($id);
    $client->update($request->all());
    return response()->json($client, 200);
  }//end function

  public function destroy($id){
    Client::destroy($id);
    return response()->json(null, 204);
  }//end function
}//end class
