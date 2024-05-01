<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="admin/assets/images/favicon.png">
    <title>Xtreme Admin Template - The Ultimate Multipurpose admin template</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <!-- Custom CSS -->
    <link href="admin/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="admin/dist/css/style.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Lato:400,500,600,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Lato', sans-serif;
        }

        .box {
            border: none;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            transition: all 0.3s ease;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        /* Ensure that the background color is applied */
        .bg-success {
            background-color: var(--bg-color);
            /* Use CSS variable to set dynamic color */
        }

        .box:hover {
            transform: scale(1.05);
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }

        .box h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .box p {
            font-size: 1.2rem;
        }

        .wrapper {
            display: inline-flex;
            background: #fff;
            height: 100px;
            width: 400px;
            align-items: center;
            justify-content: space-evenly;
            border-radius: 5px;
            padding: 20px 15px;
        }



        .wrapper .option {
            background: #fff;
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            margin: 0 10px;
            border-radius: 5px;
            cursor: pointer;
            padding: 0 10px;
            border: 2px solid lightgrey;
            transition: all 0.3s ease;
        }

        .wrapper .option .dot {
            height: 20px;
            width: 20px;
            background: #d9d9d9;
            border-radius: 50%;
            position: relative;
        }

        .wrapper .option .dot::before {
            position: absolute;
            content: "";
            top: 4px;
            left: 4px;
            width: 12px;
            height: 12px;
            background: #0069d9;
            border-radius: 50%;
            opacity: 0;
            transform: scale(1.5);
            transition: all 0.3s ease;
        }

        input[type="radio"] {
            display: none;
        }

        #option-1:checked:checked~.option-1,
        #option-2:checked:checked~.option-2 {
            border-color: #0069d9;
            background: #0069d9;
        }

        #option-1:checked:checked~.option-1 .dot,
        #option-2:checked:checked~.option-2 .dot {
            background: #fff;
        }

        #option-1:checked:checked~.option-1 .dot::before,
        #option-2:checked:checked~.option-2 .dot::before {
            opacity: 1;
            transform: scale(1);
        }

        .wrapper .option span {
            font-size: 20px;
            color: #808080;
        }

        #option-1:checked:checked~.option-1 span,
        #option-2:checked:checked~.option-2 span {
            color: #fff;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
