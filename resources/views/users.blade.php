<!DOCTYPE html>
<html lang="en">
<head>
  <title>Users</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>


@include('flash-message')

@if(count($errors))
  <div class="col-12" style="padding: 15px;">
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Whoops!</strong> There were some problems with your input.
          <br/>
          <ul>
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
          </ul>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
      </div>
  </div>
@endif

<div class="container">

  


  <h2>Users</h2>
  <p>Users list table: 
    <p style="text-align: right;">
      <a href="{{ route('users.add-users-view') }}" class="btn btn-primary btn-md" >Add New</a>
    </p> 
  </p> 

             
  <table class="table">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Role</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      @foreach($users  as $value)
        <tr>
          <td>{{ $value->firstname }}</td>
          <td>{{ $value->lastname }}</td>
          <td>{{ $value->email }}</td>
          <td>{{ $value->phone_number }}</td>
          <td>
            <span class="badge badge-pill badge-info">{{ $value->user_role_id_string }}</span> 
          </td>
          <td>
            <span class="badge badge-pill badge-{{ $value->is_active_lable}}">{{ $value->is_active_string }}</span> 
          </td>

          
          <td>  
            
            <a href="{{ url('users') }}/{{ $value->id }}"  ><i class="fa fa-edit"></i></a>

            <form onsubmit="return confirm('Do you really want to delete this record?');"  method="post"  action="{{ route('delete.users') }}">
                <button type="submit" style="border: none;"><i class="fa fa-trash" style="color: red;"></i></button>
                <input type="hidden" value="{{ $value->id }}" name="id" >
                {{ csrf_field() }}
            </form>


          </td>
        </tr>
      @endforeach
    </tbody>
  </table>



  <div class="d-flex justify-content-center">
      {{ $users->links() }}
  </div>


</div>

</body>
</html>
