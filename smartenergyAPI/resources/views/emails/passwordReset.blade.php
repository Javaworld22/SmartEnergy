<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
<h1>Hi {{$user->first_name}}!</h1>
                       

    <td align="center">
        <h1 class="f-fallback discount_heading">Password Reset</h1>
        <p class="f-fallback discount_body">You requested for password reset, click the link below to reset your password </p>
        <p>
        <a href="{{$url}}" class="f-fallback button button--green" target="_blank">Reset Password</a>
        </p>

        <p>
            or copy and paste the link in the address link of your browser
            <br>
            {{$url}}
        </p>
    
    </td>
</body>
</html>