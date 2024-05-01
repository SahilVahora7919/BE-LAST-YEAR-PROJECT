<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GROCIFY</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="web/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="web/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="web/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="web/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="web/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="web/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="web/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="web/css/style.css" type="text/css">

    <style>
        .pagination .page-item .page-link {
            color: #000000;
            /* Set color for pagination links */
        }

        .pagination .page-item.active .page-link {
            background-color: #7fad39;
            /* Set background color for active pagination link */
            border-color: #7fad39;
            /* Set border color for active pagination link */
        }

        .pagination .page-item:hover .page-link {
            background-color: #7fad39;
            /* Set background color for hover state of pagination link */
            border-color: #7fad39;
            /* Set border color for hover state of pagination link */
            color: #fff;
            /* Set text color for hover state of pagination link */
        }

        .fa-button {
            background-color: white;
            border: none;
            color: black;
            padding: 8px 13px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 50%;
            /* Make the button round */
            transition: background-color 0.3s, color 0.3s;
            /* Add transition effect */
        }

        .fa-button:hover {
            background-color: #7FAD39;
            /* Change button color on hover */
            color: white;
            /* Change button text color on hover */
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .fa-button:hover i {
            color: white;
            animation: spin 0.3s linear;

            /* Change icon color on hover */
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
