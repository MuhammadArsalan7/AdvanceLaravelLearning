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
  <form action="{{ URL::route('order.created') }}" method="POST" >
    @csrf
    <div class="User Name">
        <label for="name">Order Status:</label>
        <select id="order_status" name="order_status" class="form-control">
            <option value="PENDING">Pending</option>
            <option value="APPROVED">Approved</option>
            <option value="REJECTED">Rejected</option>
        </select>
      </div>
      <div class="form-group">
        <label for="number">Total:</label>
        <input type="number" class="form-control" id="total"  name="total">
      </div>
      <div class="form-group">
        <label for="">City:</label>
        <input type="text" class="form-control" id="city"  name="city">
      </div>
      <div class="form-group">
          <label>User Name:</label>
        <select name="user_name" class="form-control">
            <option selected disabled>select User</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    {{-- <a href="{{ URL::route('show.order') }}" class="btn btn-secondary">Back</a> --}}
  </form>
</div>

</body>
</html>
