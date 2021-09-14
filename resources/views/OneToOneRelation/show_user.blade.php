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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.bootstrap.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.colVis.min.js"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

</head>
<body>
@if (Session()->has('done'))
        <script>
            swal("Doone!", "User Successfully Created!", "success");
        </script>
@endif
<div class="container">
  <h2> Show User</h2>
  <a href="{{ URL::route('create.user') }}" class="btn btn-primary float-right mb-3">createUser</a>
<table class="table table-bordered table-hover search-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>UserRole</th>
            <th>status</th>
            <th>Action</th>
        </tr>
    </thead>
</table>
</div>

</body>
</html>
<script>
    $(document).ready(function(){
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        DATATABLE = $('.search-table').DataTable({
            ajax: {
                type: 'POST',
                url: "{{ route('searchUserRole.post') }}",
                data: () => {
                    return formData;
                }
            },
            serverSide: false,
            processing: false,
            searching: true,
            columns: [{
                    data: 'name',
                    name: 'name'

                },
                {
                    data: 'email',
                    name: 'email'

                },
                {
                    data: 'user_role',
                    name: 'user_role'

                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
    });
</script>
