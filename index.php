<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Weather App</title>
    <style>
    body {
      background: rgb(131,98,115);
background: linear-gradient(180deg, rgba(131,98,115,1) 58%, rgba(55,50,82,1) 100%);
        background-size: cover;
        width: 100vw;
        height: 100vh;
        color: #fff;
    }

    .container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .body {
        display: block;
        width: 350px;
        min-width: 350px;
        min-height: 600px;
        border: 0px solid #ccc;
        border-radius: 12px;
        box-shadow: 0px 0px 20px 0px #00000070;
        background: rgb(58,26,112);
background: linear-gradient(180deg, rgba(58,26,112,1) 26%, rgba(50,36,59,1) 100%);
    }

    .search input,
    button {
        display: inline !important;
    }

    .btn-bg{
      background-color:#ff7c00 !important;
      border-color:  #ff7c00 !important;
      color:#fff !important;
      font-weight:600;

    }
    .btn-bg:hover{
      background-color:#e27003 !important;
    }

    /* input {
      width: 200px !important;
    }
    input[type=text] {
      border-radius:20px 0 0 20px;
    }
    input[type=submit]{
      border-radius:0 20px 20px 0;
    }  */

    button {
        margin-bottom: 4px !important;
    }

    .wdata {
        height: 75vh;
        display: flex;
        flex-direction: column;
        justify-content: space-between;

    }

    .lr {
        display: flex;
        justify-content: space-between;
    }
    </style>
</head>


<body>


    <div class="container ">
        <div class="row justify-content-center">
            <div class="body p-3">

                <?php 
        $city = "";
        $status = "";
        $msg = "";
        $text="";
        $sorry=""; ?>

                <?php
        if (isset($_POST['submit'])) {
          $city = $_POST['city'];
          $url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=13e2ec0e9a3ff868276bd29df5eb2628";
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $result = curl_exec($ch);
          curl_close($ch);
          $result = json_decode($result, true);
          date_default_timezone_set("Asia/Calcutta");
          
          if ($result['cod'] == 200) {
            $status = "yes";
          } else {
            $msg = $result['message'];
            $text="Please enter the city name correctly";
            $sorry="sorry.png";
          }
        }
        ?> <div class="wdata">
                    <div class="head ">
                        <form class="m-auto" method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control w-50" name="city" required
                                    value="<?php echo $city ?>" placeholder="Enter City name">
                                <input type="submit" name="submit" value="Check"
                                    class="input-group-text btn btn-info btn-bg  w-25 "></input>
                            </div>
                        </form>
                        <h4 class="text-center "><?php echo $msg;?></h4>
                        <p class="text-center"><?php echo $text;?></p>
                        <div class="text-center">
                            <img src="<?php echo $sorry;?>" alt="" class="img-fluid">
                        </div>
                        <?php if ($status == "yes") { ?>
                        <div class="left d-inline-block">
                            <h3><?php echo $city; ?></h3>
                            <h1><?php echo $result['main']['temp'] - 273.15; ?> <sup>°C</sup></h1>
                            <h4><?php echo $result['weather']['0']['main']; ?></h4>

                        </div>
                        <div class="right text-end d-inline-block float-end ">
                            <img src="http://openweathermap.org/img/wn/<?php echo $result['weather']['0']['icon']; ?>@2x.png"
                                alt="">
                        </div>

                        <div class="icon  my-1">
                            <h6><?php echo date("D jS \of M <br> h:i A"); ?> </h6>

                        </div>
                    </div>
                    <!-- 
          <div class="img">
            <img src="https://source.unsplash.com/500x400/?<?php echo $result['weather']['0']['main']; ?>,weather" alt="" class="img-fluid">
          </div> -->
                    <div class="mid">
                        <div class="lr">
                            <h5>Min temp.</h5>
                            <h5><?php  echo $result['main']['temp_min'] -273.15?><sup>°C</sup></h5>
                        </div>

                        <div class="lr">
                            <h5>Max temp.</h5>
                            <h5><?php echo $result['main']['temp_max']-273.15?><sup>°C</sup></h5>
                        </div>
                        <hr>
                        <div class="lr">
                            <h5>Sunrise</h5>
                            <h5><?php echo date('m-d h:i a', $result['sys']['sunrise']);?></h5>
                        </div>

                        <div class="lr">
                            <h5>Sunset</h5>
                            <h5><?php echo date('m-d h:i a', $result['sys']['sunset']);?></h5>
                        </div>




                    </div>



                    <div class="foot ">
                        <h1>Lorem, ipsum dolor.</h1>
                    </div>
                    <?php }

        ?>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"> </script>
</body>

</html>