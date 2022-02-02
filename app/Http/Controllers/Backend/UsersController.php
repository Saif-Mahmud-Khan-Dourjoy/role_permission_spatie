<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users= User::all();
        return view('backend.pages.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        $roles=Role::all();

         // $permission= Permission::all();
         return view('backend.pages.users.create',compact( 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
       $request->validate([
       'name'=>'required|unique:roles'
       ]); 
       $role_name=$request->name;

      

       $role=Role::create(['name' => $role_name]);

       $permissions=$request->permissions;


       if(!empty($permissions)){
        $role->syncPermissions($permissions);
       }

       return back()->with('success','Successfully Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $user=User::findOrFail($id);

        
       
        $role=Role::all();

         return view('backend.pages.users.edit',compact( 'user','role'));
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
        
        $role_name=$request->name;

        
        $role=Role::findById($id);

        // dd($role);
        // // die();

       Role::findOrFail($id)->update(['name' => $role_name]);

       $permissions=$request->permissions;


       if(!empty($permissions)){
        $role->syncPermissions($permissions);
       }

       return back()->with('success','Successfully Added');

    }        
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::findOrFail($id);
        if(!is_null($user)){
            $user->delete();
        }

        return back();
    }
}
