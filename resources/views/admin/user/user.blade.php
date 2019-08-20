<table style="width:100%" class="table table-hover table-striped" >
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Status</th>
    <th>Role</th>
    <th>Login Status</th>
  </tr>
  @foreach($data as $user)
  <tr>

    <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>@if($user->status==0)
        <b style="color:green"> enable</b>
        @else
      <b style="color:red">  Disabled</b>
        @endif
        <br>
        <button id="showSelectDiv{{$user->id}}"
          class="btn btn-primary btn-fill">
          Change status
        </button>
        <div id="selectDiv{{$user->id}}" class="selectDiv">
        <input type="hidden" id="userID{{$user->id}}" value="{{$user->id}}">
        <select id="loginStatus{{$user->id}}">
          <option value="">select a option</option>
          <option value="0">enable</option>
          <option value="1">Disabled</option>
        </select>
        </div>
      </td>
      <td>{{$user->role}}</td>
     <td><a href="" class="btn btn-fill btn-success">Actions</a></td>

  </tr>
    @endforeach
</table>

<script>


$(document).ready(function(){

  @foreach($data as $user)
  $("#selectDiv{{$user->id}}").hide();
  $("#showSelectDiv{{$user->id}}").click(function(){
      $("#selectDiv{{$user->id}}").show();
  });
$("#loginStatus{{$user->id}}").change(function(){
  var status = $("#loginStatus{{$user->id}}").val();
  var userID = $("#userID{{$user->id}}").val();
  console.log(status);
  if(status==""){
    alert("please select an option");
  }else{
   $.ajax({
     url: '{{url("/admin/banUser")}}',
     data: 'status=' + status + '&userID=' + userID,
     type: 'get',
     success:function(response){
          loadUser();
       $("#showSelectDiv{{$user->id}}").toggle(    
        function(){$(".selectDiv").hide();
      });
     }
   });
  }
});
  @endforeach
});


</script>