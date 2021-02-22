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
  <style>
    fieldset 
  {
    /*border: 1px solid #ddd !important;*/
    border: 1px solid #337ab7 !important;
    margin: 0;
    xmin-width: 0;
    padding: 10px;       
    position: relative;
    border-radius:4px;
    background-color:#f5f5f5;
    padding-left:10px!important;
  } 
  
    legend
    {
    font-size: 15px !important;
    font-weight: bold !important;
    /* font-family: sans-serif; */
    margin-bottom: 0px !important;
    width: 19% !important;
    border: 1px solid #ddd;
    border-radius: 4px !important;
    padding: 5px 5px 5px 10px !important;
    background-color: #ffffff !important;
    }
  </style>
</head>
<body>



@include('flash-message')


<div class="container">

        
  
        @if(count($errors))
        <div class="col-12">
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

  
    <p style="text-align: right; margin-top: 15px; ">
      <a href="{{ route('home') }}" class="btn btn-primary btn-md" >All Users</a>
    </p> 


    <fieldset>

    <legend>Login</legend>

    <div class="row mt-1">
      <div class="col-md-3"></div>
      <div class="col-md-6"> 

          <form  method="POST" action="{{ route('login') }}"  enctype='multipart/form-data'>
            {{ csrf_field() }}
            <div class="form-group ">
              <label for="email"> email</label>
              <input type="text" name="email" placeholder="Enter Email"  class="form-control" id="email"  required>
              @error('email')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group ">
              <label for="password"> Password</label>
              <input type="password" name="password" placeholder="Enter Password" class="form-control" id="password"  required>
              @error('password')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <button type="submit" class="btn btn-md  btn-success" type="button">Submit</button>

            <button type="reset" class="btn btn-md btn-warning" type="button">Reset</button>


          </form>
        </div>
      </div>
    

</fieldset>


     
             
  
</div>

</body>
</html>










