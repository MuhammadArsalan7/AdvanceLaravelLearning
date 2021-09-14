<!DOCTYPE html>
<html lang="en">
<head>
  <title>Create USer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
</head>
<body>
@if (Session()->has('done'))
        <script>
            swal("Doone!", "User Successfully Created!", "success");
        </script>
@endif
<div class="container">
  <h2>User Create</h2>
  <form action="{{ URL::to('updateuser/'.$editUser->id) }}" method="POST">
    @csrf
    <div class="User Name">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name"  name="name" value="{{ $editUser->name }}">
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email"  name="email" value="{{ $editUser->email }}">
      </div>

      <div class="form-group">
        <label for="userRole">User Role:</label>
        <select name="userRole" class="form-control">
            <option disabled selected>select Role</option>
            <option value="admin" @if($editUser->userRole->user_role =="admin") selected @endif >Admin</option>
            <option value="client" @if($editUser->userRole->user_role =="client") selected @endif>Client</option>
            <option value="DEO" @if($editUser->userRole->user_role =="DEO") selected @endif >DEO</option>
        </select>
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>
