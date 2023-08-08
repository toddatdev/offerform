<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer Form</title>
    <style>
        body {
            background-color: #f7f7fd !important;
            font-family: montserrat;
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
        }

        .custom-container {
            max-width: 1147px;
            margin: 0 auto;
        }

        .line {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(var(--bs-gutter-y) * -1);
            margin-right: calc(var(--bs-gutter-x) * -.5);
            margin-left: calc(var(--bs-gutter-x) * -.5);
        }

        .w-50 {
            width: 50%;
            flex: 0 0 auto;
        }

        .w-100 {
            width: 100%;
        }

        .max-width {
            max-width: 100%;
            height: auto;
        }

        .background-white {
            background-color: #fff;
        }

        .w-25 {
            width: 25%;
        }

        .radius-50 {
            border-radius: 50%;
        }

        .display-flex {
            display: flex;
        }

        .width-100 {
            width: 100%;
        }

        .content-between {
            display: flex;
            justify-content: space-between;
        }

        .admin-pic {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 50%;
        }

        .purple {
            color: #9C4EDD;
        }

        .custom-card {
            background-color: #fff;
            position: relative;
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
        }

        .padding-y {
            padding-bottom: 2.2rem !important;
            padding-top: 1.5rem !important;
        }

        .padding-body {
            flex: 1 1 auto;
            padding: 1rem;
        }

        .font-bold {
            font-weight: bold;
        }


        .font-18 {
            font-size: 18px;
        }

        ul li {
            font-size: 17px;
            list-style: none;
            margin-bottom: 1rem;
            margin-top: 0;
            text-align: end;
        }

        .map-icon {
            background-color: #fff;
            padding: 5px;
            width: 30px;
        }

        .radius-50 {
            border-radius: 50%;
        }

        .content-center {
            align-items: center;
        }

        .margin-12 {
            margin-left: 12px;
        }

        .margin-right {
            margin-right: 12px;
        }

        .line > * {
            flex-shrink: 0;
            /* width: 100%;
    max-width: 100%; */
            padding-right: calc(var(--bs-gutter-x) * .5);
            padding-left: calc(var(--bs-gutter-x) * .5);
            margin-top: var(--bs-gutter-y);
        }

        .dash-icon {
            height: 35px;
            line-height: 34px;
            text-align: center;
            width: 35px;
            padding: 5px;
        }

        .img-filter {
            filter: invert(27%) sepia(51%) saturate(134678%) hue-rotate(275deg) brightness(104%) contrast(97%);
        }

        .shadow {
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
        }

        .margin-top {
            margin-top: 12px;
        }

        .bg-purple {
            background-color: #9c4edd;
        }

        .white-text {
            color: #fff;
        }

        .padding-left {
            padding-left: 14px;
        }

        .padding-left-2 {
            padding-left: 10px;
        }

        .padding-right {
            padding-right: 13px;
        }

        .border-radius {
            border-radius: 5px;
        }

        .margin-t-b {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .body-margin {
            margin-top: 70px;
        }

        .agent {
            height: 35px;
            line-height: 34px;
            text-align: center;
            width: 35px;
        }

        .padding-5 {
            padding: 5px;
        }

        .top-margin {
            margin-top: 17px;
        }

        .margin-bottom {
            margin-bottom: 60px;
        }

        .margin-40 {
            margin-top: 40px;
        }

        .w-22 {
            width: 22px;
        }

        .right-text {
            text-align: end;
        }
    </style>
</head>

<body>
<div class="custom-container body-margin">
    <div class="line">
        <div class="w-50">
            <div class="display-flex content-center">
                <div>
                    <img class="map-icon radius-50" src="./images/map.svg" alt="">
                </div>
                <div>
                    <h3 class="font-bold margin-12 margin-t-b">Not Available</h3>
                </div>
            </div>
            <img src="./images/house.png" class="max-width">
        </div>
        <div class="w-50">
            <div class="display-flex content-center">
                <div>
                    <img class="map-icon radius-50" src="./images/agent-icon.svg" alt="">
                </div>
                <div>
                    <h3 class="font-bold margin-12 margin-t-b">Agent Contact Information</h3>
                </div>
            </div>
            <div class="custom-card padding-y">
                <div class="display-flex width-100 content-between padding-body content-center">
                    <img src="./images/admin.jpg" class="max-width  admin-pic">
                    <div>
                        <h3 class="purple font-bold right-text">Mark Lumpkin</h3>
                        <ul>
                            <li class="font-18 font-bold">(541) 306-3139</li>
                            <li>agent@app.com</li>
                            <li>123 main</li>
                            <li>www.elasemoh145.com</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="line  margin-40">
        <div class="w-100">
            <div class="display-flex content-center">
                <div>
                    <img src="./images/dash.svg" class="dash-icon img-filter shadow radius-50">
                </div>
                <div>
                    <p class="margin-12 font-bold"> Uncategorized </p>
                </div>
            </div>
        </div>
    </div>
    <div class="line margin-top">
        <div class="display-flex w-100  content-center white-text">
            <div class="display-flex content-between w-100 bg-purple border-radius">
                <div class="display-flex padding-left">
                    <img src="./images/dollar.svg" class="w-22">
                    <p class="padding-left">House size</p>
                </div>
                <div>
                    <p class="padding-right">2</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line top-margin">
        <div class="display-flex content-center">
            <img src="./images/agent.svg" class="agent padding-5 img-filter shadow radius-50">
            <p class="padding-left font-bold">Buyer Contact Information</p>

        </div>
    </div>
    <div class="line margin-top">
        <div class="display-flex w-100  content-center white-text">
            <div class="display-flex content-between w-100 bg-purple border-radius">
                <div class="display-flex padding-left">
                    <img src="./images/dollar.svg" class="w-22">
                    <p class="padding-left">Buyer 1 First Name</p>
                </div>
                <div>
                    <p class="padding-right">Mark</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line top-margin">
        <div class="display-flex w-100  content-center white-text">
            <div class="display-flex content-between w-100 bg-purple border-radius">
                <div class="display-flex padding-left">
                    <img src="./images/dollar.svg" class="w-22">
                    <p class="padding-left">Buyer 1 Last Name</p>
                </div>
                <div>
                    <p class="padding-right">Lumpkin</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line top-margin">
        <div class="display-flex w-100  content-center white-text">
            <div class="display-flex content-between w-100 bg-purple border-radius">
                <div class="display-flex padding-left">
                    <img src="./images/dollar.svg" class="w-22">
                    <p class="padding-left">Buyer 1 Email</p>
                </div>
                <div>
                    <p class="padding-right">Agent@offerform.com</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line top-margin">
        <div class="display-flex w-100  content-center white-text">
            <div class="display-flex content-between w-100 bg-purple border-radius">
                <div class="display-flex padding-left">
                    <img src="./images/dollar.svg" class="w-22">
                    <p class="padding-left">Buyer 1 Birthday</p>
                </div>
                <div>
                    <p class="padding-right">4/14/2000</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line top-margin">
        <div class="display-flex w-100  content-center white-text">
            <div class="display-flex content-between w-100 bg-purple border-radius">
                <div class="display-flex padding-left">
                    <img src="./images/dollar.svg" class="w-22">
                    <p class="padding-left">Buyer 1 Phone Number</p>
                </div>
                <div>
                    <p class="padding-right">(541) 606-7200</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line top-margin margin-bottom">
        <div class="display-flex w-100  content-center white-text">
            <div class="display-flex content-between w-100 bg-purple border-radius">
                <div class="display-flex padding-left">
                    <img src="./images/dollar.svg" class="w-22">
                    <p class="padding-left">Buyer 2 Birthday</p>
                </div>
                <div>
                    <p class="padding-right">3/4/1999</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
