@extends('backend.layouts.master')
@section('admin_content')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Dashboard</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li><span>ALL Users</span></li>
                </ul>
            </div>
        </div>

    </div>
</div>
<!-- page title area end -->
<div class="main-content-inner">

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ $message }}</strong>
    </div>
    @endif

    <div class="row mt-5 mb-5">
        <div class="col-4 mx-auto">
            <div class="card">
                <div class="card-body">

                    <div class="market-status-table mt-4">
                        <div class="table-responsive">
                         <form action="{{route('users.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" placeholder="name">

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="email">

                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="password" placeholder="password">

                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Confirm Password</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="con_pass" placeholder="con_pass">

                            </div>
                            
                            
                         
                            

                                
                                    <div class="form-check">
                                        <label>Assign Role</label>
                                        <select name="roles[]" class="select2 form-control" multiple>
                                            @foreach($roles as $item)
                                            <option value="{{$item->name}}">{{$item->name}} </option>
                                             @endforeach 
                                        </select>
                                        
                                    </div>
                              
                                    
                                </div>
                            </div>
                          

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>



@endsection

@section('script')

<script type="text/javascript">
    $('.select2').select2();
</script>


@endsection