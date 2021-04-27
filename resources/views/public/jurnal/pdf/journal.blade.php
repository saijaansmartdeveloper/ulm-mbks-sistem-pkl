<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Print</title>
    <style>
        /** Define the margins of your page **/
        @page {
            margin: 100px 25px;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 35px;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 35px;
        }
    </style>
</head>
<body>
<!-- Define header and footer blocks before your content -->
<header>
    <div>
        <img src="{{asset('img/ULM-KampusMerdeka.png')}}" alt="logo" width="100%" height="100%">
    </div>
</header>

<footer>
    Copyright &copy; <?php echo date("Y");?>
</footer>

<!-- Wrap the content of your PDF inside a main tag -->
<main>
    <p style="page-break-after: always;">
        Content Page 1
    </p>
    <p style="page-break-after: never;">
        Content Page 2
    </p>
</main>
</body>
</html>
