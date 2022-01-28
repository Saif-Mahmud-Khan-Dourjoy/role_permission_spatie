@extends('backend.layouts.master')
@section('admin_content')
<div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li><span>ALL Roles</span></li>
                            </ul>
                        </div>
                    </div>
                
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                           
                                <div class="market-status-table mt-4">
                                    <div class="table-responsive">
                                        <table class="dbkit-table">
                                            <tr class="heading-td">
                                                <td class="mv-icon">SL</td>
                                                <td class="coin-name">Name</td>
                                                <td class="buy">Action</td>
                                                
                                            </tr>

                                            @foreach($roles as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>
                                                    <a class="btn btn-success" href="{{route('roles.edit',$item->id)}}">Edit</a>
                                                    <form action="{{route('roles.destroy',$item->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE') 
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                    
                                                </td>
                                                
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           
            </div>

           @endsection