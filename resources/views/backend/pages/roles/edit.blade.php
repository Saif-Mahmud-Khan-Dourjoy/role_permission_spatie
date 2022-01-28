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
                           <form action="{{route('roles.update',$role->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" value="{{$role->name}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" placeholder="name">

                            </div>
                            <div class="mt-4">
                                <p>Permissions</p>
                            </div>
                            <hr>
                            <input type="checkbox"  class="form-check-input" {{App\Models\User::roleHasAllPermissions($role,$permissions)?'checked':'';}}  id="all_check">
                            <label class="form-check-label" >ALL</label>
                            <hr>
                            @php
                            $i=1;
                            @endphp
                            @foreach($grp_name as $item)
                            @php
                            $permission=\App\Models\User::getAllPermissionByGroupName($item->group_name);
                            @endphp
                            <div class="row">
                                <div class="col-md-3">

                                    <div class="form-check">
                                        <input type="checkbox"  class="form-check-input" id="{{$i}}-Management" onclick="setPermission('role-{{$i}}-management',this)" value="" id="exampleCheck" {{App\Models\User::roleHasPermissions($role,$permission)?'checked':'';}}>
                                        <label class="form-check-label" for="exampleCheck">{{$item->group_name}}</label>
                                    </div>

                                </div>

                                <div class="col-md-9 role-{{$i}}-management">

                                    @php
                                    $j=1;
                                    @endphp
                                    @foreach($permission as $item)
                                    <div class="form-check">
                                        <input type="checkbox" {{$role->hasPermissionTo($item)?'checked':'';}} name="permissions[]" class="form-check-input" value="{{$item->id}}" id="exampleCheck{{$item->id}}" onclick="checkDeselectPermission('role-{{$i}}-management','{{$i}}-Management',{{count($permission)}})">
                                        <label class="form-check-label" for="exampleCheck{{$item->id}}">{{$item->name}}</label>
                                    </div>
                                    @php
                                    $j++;
                                    @endphp
                                    @endforeach  
                                </div>
                            </div>
                            <hr>
                            @php
                            $i++;
                            @endphp
                            @endforeach 

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Role</button>
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
    $("#all_check").click(function(){
       if($(this).is(':checked')){
        $('input[type="checkbox"]').prop('checked',true);
    }
    else{
        $('input[type="checkbox"]').prop('checked',false);
    }
});

    function setPermission(className,checkThis){

        const grpIdNm=$("#"+checkThis.id);

        const class_name=$('.'+className+' input')

        if($(grpIdNm).is(':checked')){
            $(class_name).prop('checked',true);
        }
        else{
            $(class_name).prop('checked',false);
        }

        implementAllChecked(); 


 }

 function checkDeselectPermission(className,idN,cnt){

       const idName=$('#'+idN);

       if($('.'+className+' input:checked').length==cnt){
         $(idName).prop('checked',true);
       }else{
        $(idName).prop('checked',false);
       }
       implementAllChecked(); 
    }


  function implementAllChecked(){
    alert($('input[type="checkbox"]:checked').length);

    false;
      const allPermission={{count($permissions)}};
      const allGroup={{count($grp_name)}};

      if($('input[type="checkbox"]:checked').length >= (allPermission + allGroup)){
        $("#all_check").prop('checked',true);
      }else{
        $("#all_check").prop('checked',false);
      }
  } 

  
    


</script>


@endsection