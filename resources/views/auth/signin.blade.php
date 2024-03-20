<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST" id="signin">
        @csrf
        <input type="hidden" name="count" id="count" value=1>
        <input type="email" id="email" class="form-control" name="email" placeholder="email">
        <input type="password" id="password" class="form-control" name="password" placeholder="password">
        <button type="submit">Submit</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $('#signin').submit(function(e) {
            e.preventDefault();
            var formdata = $(this).serialize();
            $.ajax({
                url: "{{ route('signin') }}",
                method: "POST",
                data: formdata,
                headers: {
                    _token: "{{ CSRF_TOKEN() }}"
                },
                success: function(resp) {
                    $('#count').val(resp.count);
                    alert(resp.message);
                }
            })
        });
    </script>
</body>

</html>
