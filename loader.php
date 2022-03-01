<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spizy | Loading</title>
    <style>
        body {
            background-color: rgb(0, 0, 0);
        }

        .container .spinners .spinner-block {
            width: 125px;
            text-align: center;
        }

        .spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 125px;
            height: 125px;
        }

        .spinner:before,
        .spinner:after {
            content: "";
            display: block;
            position: absolute;
            border-width: 4px;
            border-style: solid;
            border-radius: 50%;
        }

        @-webkit-keyframes rotate-animation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes rotate-animation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @-webkit-keyframes anti-rotate-animation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(-360deg);
            }
        }

        @keyframes anti-rotate-animation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(-360deg);
            }
        }

        .spinner.spinner-1:before {
            width: 117px;
            height: 117px;
            border-bottom-color: #f7f7f7;
            border-right-color: #f7f7f7;
            border-top-color: rgba(190, 190, 190, 0);
            border-left-color: rgba(190, 190, 190, 0);
            top: 0px;
            left: 0px;
            -webkit-animation: rotate-animation 1s linear 0s infinite;
            animation: rotate-animation 1s linear 0s infinite;
        }

        .spinner.spinner-1:after {
            width: 81.9px;
            height: 81.9px;
            border-bottom-color: #f7f7f7;
            border-right-color: #f7f7f7;
            border-top-color: rgba(190, 190, 190, 0);
            border-left-color: rgba(190, 190, 190, 0);
            top: 17.55px;
            left: 17.55px;
            -webkit-animation: anti-rotate-animation 0.85s linear 0s infinite;
            animation: anti-rotate-animation 0.85s linear 0s infinite;
        }

        .loader-img {
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="spinners">
            <div class="spinner-block">
                <div class="spinner spinner-1"><img class="loader-img" src="images/cheers.png" alt="" width="45px"></div>
            </div>
        </div>
    </div>
</body>

</html>