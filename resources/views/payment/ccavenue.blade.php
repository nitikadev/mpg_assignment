
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST" id="payment">
        @csrf
        <input type="text" id="name" class="form-control" name="name" placeholder="name">
        <input type="email" id="email" class="form-control" name="email" placeholder="email">
        <input type="tel" id="phone" class="form-control" name="phone" placeholder="phone">
        <input type="number" id="amount" class="form-control" name="amount" placeholder="amount">
        <button type="submit">Submit</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $('#payment').submit(function(e) {
            e.preventDefault();
            var name = $('#name');
            var email = $('#email');
            var phone = $('#phone');
            var amount = $('#amount');
            $.ajax({ 
                url: "https://test.ccavenue.com/transaction/transaction.do?command=initiatePayloadTransaction&access_code=1234567890&amount="+amount+"&currency=USD",
                method: "GET",
                data: formdata,
                headers: {
                    _token: "{{ CSRF_TOKEN() }}"
                },
                success: function(resp) {
                    console.log(resp);
                }
            })
        });
    </script>
</body>

</html>