<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Add
    </button>
    <table class="table">
        <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </thead>
        <tbody>
            @forelse ($getAllEmployee as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td><a class="btn btn-warning" id="edit-employee" data-id={{ $employee->id }}>Edit</a>
                        <form id="deleteEmployee" data-id={{ $employee->id }}>
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                No employee found
            @endforelse
        </tbody>
    </table>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-emp">
                        @csrf
                        <input type="hidden" id="empid" name="id">
                        <input type="text" id="name" class="form-control" name="name" placeholder="name">
                        <input type="email" id="email" class="form-control" name="email" placeholder="email">
                        <input type="password" id="password" class="form-control" name="password"
                            placeholder="password">
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script>
        $('#add-emp').submit(function(e) {
            e.preventDefault();
            var formdata = $(this).serialize();
            $.ajax({
                url: "{{ route('storeemployee') }}",
                method: "POST",
                data: formdata,
                headers: {
                    _token: "{{ CSRF_TOKEN() }}"
                },
                success: function(resp) {
                    console.log(resp);
                }
            })
        });

        $('#edit-employee').click(function(e) {
            var getempid = $(this).data('id');
            $.ajax({
                url: "getemployeebyid/" + getempid,
                method: "GET",
                headers: {
                    _token: "{{ CSRF_TOKEN() }}"
                },
                success: function(resp) {
                    $('#name').val(resp.name);
                    $('#email').val(resp.email);
                    $('#password').val(resp.password);
                    $('#empid').val(getempid);
                }
            })
            $('#exampleModal').modal('show');
        });

        $('body').on('click', '#deleteEmployee', function(e) {
            console.log('ee');
            e.preventDefault();
            var getempid = $(this).data('id');
            $.ajax({
                url: "deleteemployee/" + getempid,
                method: "GET",
                headers: {
                    _token: "{{ CSRF_TOKEN() }}"
                },
                success: function(resp) {}
            })
        })
    </script>
</body>

</html>
