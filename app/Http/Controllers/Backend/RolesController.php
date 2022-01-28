<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles= Role::all();
        return view('backend.pages.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        $grp_name=User::getAllGroupName();

         // $permission= Permission::all();
         return view('backend.pages.roles.create',compact( 'grp_name'));
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
        $role=Role::findOrFail($id);

        
        $grp_name=User::getAllGroupName();

         $permissions= Permission::all();

         return view('backend.pages.roles.edit',compact( 'grp_name','role','permissions'));
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
        $role=Role::findOrFail($id);
        if(!is_null($role)){
            $role->delete();
        }

        return back();
    }
}
