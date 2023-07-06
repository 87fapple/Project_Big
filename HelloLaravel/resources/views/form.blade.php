<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <title>Document</title>
</head>
<body>
    <form method="post">
        @csrf 
        <p><label>Number A: </label><input name="a"></p>
        <p><label>Number B: </label><input name="b"></p>
        <p><label>mth: </label><input name="mth"></p>
        <input type="submit">
    </form>
</body>

</html>