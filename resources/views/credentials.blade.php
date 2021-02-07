<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Výpůjční a rezervační systém</title>
    <link rel="icon" href="{{ URL::asset('img/logo_icon_old3.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .row.heading h2 {
            color: #fff;
            font-size: 52.52px;
            line-height: 95px;
            font-weight: 400;
            text-align: center;
            margin: 0 0 40px;
            padding-bottom: 20px;
            text-transform: uppercase;
        }
        ul{
            margin:0;
            padding:0;
            list-style:none;
        }
        .heading.heading-icon {
            display: block;
        }
        .padding-lg {
            display: block;
            padding-top: 60px;
            padding-bottom: 60px;
        }
        .practice-area.padding-lg {
            padding-bottom: 55px;
            padding-top: 55px;
        }
        .practice-area .inner{
            border:1px solid #999999;
            text-align:center;
            margin-bottom:28px;
            padding:40px 25px;
        }
        .our-webcoderskull .cnt-block:hover {
            box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
            border: 0;
        }
        .practice-area .inner h3{
            color:#3c3c3c;
            font-size:24px;
            font-weight:500;
            font-family: 'Poppins', sans-serif;
            padding: 10px 0;
        }
        .practice-area .inner p{
            font-size:14px;
            line-height:22px;
            font-weight:400;
        }
        .practice-area .inner img{
            display:inline-block;
        }


        .our-webcoderskull{
            background: #002e40;
            border-bottom: 10px solid #fa9702;

        }.our-webcoderskull
        .our-webcoderskull .cnt-block{
            float:left;
            width:100%;
            background:#fff;
            padding:30px 20px;
            text-align:center;
            border:2px solid #d5d5d5;
            margin: 0 0 28px;
        }
        .our-webcoderskull .cnt-block figure{
            width:148px;
            height:148px;
            border-radius:100%;
            display:inline-block;
            margin-bottom: 15px;
        }
        .our-webcoderskull .cnt-block img{
            width:148px;
            height:148px;
            border-radius:100%;
        }
        .our-webcoderskull .cnt-block h3{
            color:#2a2a2a;
            font-size:20px;
            font-weight:500;
            padding:6px 0;
            text-transform:uppercase;
        }
        .our-webcoderskull .cnt-block h3 a{
            text-decoration:none;
            color:#2a2a2a;
        }
        .our-webcoderskull .cnt-block h3 a:hover{
            color:#337ab7;
        }
        .our-webcoderskull .cnt-block p{
            color:#2a2a2a;
            font-size:13px;
            line-height:20px;
            font-weight:400;
        }
        .our-webcoderskull .cnt-block .follow-us{
            margin:20px 0 0;
        }
        .our-webcoderskull .cnt-block .follow-us li{
            display:inline-block;
            width:auto;
            margin:0 5px;
        }
        .our-webcoderskull .cnt-block .follow-us li .fa{
            font-size:24px;
            color:#767676;
        }
        .our-webcoderskull .cnt-block .follow-us li .fa:hover{
            color:#025a8e;
        }

    </style>

</head>
<body class="antialiased">


<section class="our-webcoderskull padding-lg">
    <div class="container">
        <div class="row heading heading-icon">
            <h2 class="font-weight-bold text-center mb-0" style="color: #fa9702">Náš tým,</h2>
            <h3 class="font-weight-bold text-center mb-5" style="color: #fa9702">který vytvořil celý systém</h3>
        </div>
        <ul class="row mt-5">
            <li class="col-12 col-md-6 col-lg-3 mt-4 mt-lg0">
                <div class="cnt-block equal-hight bg-white rounded pt-4" style="height: 349px;">
                    <figure class="w-100 d-flex"><img src="http://dominikfrolik.cz/VRS/dominik.png" class="img-responsive ml-auto mr-auto" alt=""></figure>
                    <h3 class="text-center"><a href="http://dominikfrolik.cz/">Dominik Frolík</a></h3>
                    <h6 class="text-center ">Backend</h6>
                    <ul class="follow-us clearfix text-center d-none">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </li>
            <li class="col-12 col-md-6 col-lg-3 mt-4 mt-lg0">
                <div class="cnt-block equal-hight bg-white rounded pt-4" style="height: 349px;">
                    <figure class="w-100 d-flex"><img src="http://dominikfrolik.cz/VRS/viol.png" class="img-responsive ml-auto mr-auto" alt=""></figure>
                    <h3 class="text-center"><a href="#">Viola Vrbová </a></h3>
                    <h6 class="text-center">Backend</h6>
                    <ul class="follow-us clearfix text-center d-none">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </li>
            <li class="col-12 col-md-6 col-lg-3 mt-4 mt-lg0">
                <div class="cnt-block equal-hight bg-white rounded pt-4" style="height: 349px;">
                    <figure class="w-100 d-flex"><img src="http://dominikfrolik.cz/VRS/katka.png" class="img-responsive ml-auto mr-auto" alt=""></figure>
                    <h3 class="text-center"><a href="#">Kateřina Zábranská</a></h3>
                    <h6 class="text-center">Frontend</h6>
                    <ul class="follow-us clearfix text-center d-none">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </li>
            <li class="col-12 col-md-6 col-lg-3 mt-4 mt-lg0">
                <div class="cnt-block equal-hight bg-white rounded pt-4" style="height: 349px;">
                    <figure class="w-100 d-flex"><img src="http://dominikfrolik.cz/VRS/katerina.png" class="img-responsive ml-auto mr-auto" alt=""></figure>
                    <h3 class="text-center"><a href="#">Kateřina Bartáková</a></h3>
                    <h6 class="text-center">Databases</h6>
                    <ul class="follow-us clearfix text-center d-none">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</section>

</body>
</html>
