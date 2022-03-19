<?php

namespace App\Http\Controllers;

use App\Http\Libraries\BaseApi;
use Illuminate\Http\Request;
Use Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
				//disini hanya perlu menggunakan BaseApi yg sebelumnya dibuat
				//hanya tinggal menambahkan endpoint yg akan digunakan yaitu '/user'
        $users = (new BaseApi)->index('/user',['limit'=>100]);
        return view('user.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
				// buat variable baru untuk menset parameter agar sesuai dengan documentasi
				$payload = [
            'firstName' => $request->input('nama_depan'),
            'lastName' => $request->input('nama_belakang'),
            'email' => $request->input('email'),
        ];


        $baseApi = new BaseApi;
        $response = $baseApi->create('/user/create', $payload);

				// handle jika request API nya gagal
        // diblade nanti bisa ditambahkan toast alert
        if ($response->failed()) {
            $errors = $response->json('data');
            Alert::error('Error', 'Something went wrong');
            return back();
        }else{
            Alert::success('Success', 'data have been added');
            return redirect('users');
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
        $response = (new BaseApi)->detail('/user', $id);
        return response()->json($response->json());
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
    public function update(Request $request)
    {
        $payload = [
            'firstName' => $request->input('nama_depan'),
            'lastName' => $request->input('nama_belakang'),
        ];
        
        $response = (new BaseApi)->update('/user', $request->id, $payload);
        if ($response->failed()) {
            Alert::error('Error', 'Something went wrong');
            return back();
        }else{
            Alert::warning('Success', 'data have been updated');
            return redirect('users');
        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request,$id)
    {
        $response = (new BaseApi)->delete('/user',$id);
        if ($response->failed()) {
            Alert::error('Error', 'Something went wrong');
            return back();
        }else{
            Alert::success('Success', 'data have been deleted');
            return redirect('users');
        }
    }
}
