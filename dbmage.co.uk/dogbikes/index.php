<!doctype html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <meta charset="utf-8">
        <title>Evil-Corp Mind Control</title>
        <!-- <link rel="stylesheet" href="css/styles.css?v=1.0"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <?php
            $temp = $_GET['temp'];
            //shell_exec("echo $temp");
            print("$temp");
        ?>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><b>Heat Control</b></a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active" id="homepage"><a href="#">Control</a></li>
                    <li><a href="#">Dashboard</a></li>
                    <li><a id="WhatsMyIP">WhatsMyIP</a></li>
                </ul>
            </div>
        </nav>
        <script type='text/javascript'>
            $("#WhatsMyIP").on('click', 
                function() {
                    document.getElementById('Main').style.display = "none";
                    document.getElementById('myip').style.display = "block";
                    return true;
                }
            );
            $("#homepage").on('click', 
                function() {
                    document.getElementById('Main').style.display = "block";
                    document.getElementById('myip').style.display = "none";
                    return true;
                }
            );
        </script>
        <div id="Main">
            <div>
                <br>
                <div class="circle" id="ValCircle" style="background: rgb(255, 0, 255); font-size: 110px;">
                    <span id="value"></span>
                </div>
                <div class="circle" id="StatCircle" style="background: rgb(255, 0, 0); font-size: 80px;">
                    <span id="StatusVal"></span>
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br>
            <h1 style="color:red;"><b>Temperature sensor</b></h1>
            <div id="container" class="col-sm-12 col-md-8 col-lg-6 col-xl-3" style="margin-left: -1.5%;">
                <div id="sliderDiv" style="align: center; width: 80%">
                    <input type="range" min="0" max="100" value="50" class="slider" id="myRange">
                </div>
                <div class"row" style="width: 114%; align: left; margin-left: -155px">
                    <div class="col-xs-1">
                        <svg height="40"><circle cx="50%" cy="24" r="13" fill="rgb(0, 0, 255)" /></svg>
                    </div>
                    <div class="col-xs-1">
                        <svg height="40"><circle cx="50%" cy="24" r="13" fill="rgb(64, 0, 255)" /></svg>
                    </div>
                    <div class="col-xs-1">
                        <svg height="40"><circle cx="50%" cy="24" r="13" fill="rgb(127, 0, 255)" /></svg>
                    </div>
                    <div class="col-xs-1">
                        <svg height="40"><circle cx="50%" cy="24" r="13" fill="rgb(191, 0, 255)" /></svg>
                    </div>
                    <div class="col-xs-1">
                        <svg height="40"><circle cx="50%" cy="24" r="13" fill="rgb(255, 0, 255)" /></svg>
                    </div>
                    <div class="col-xs-1">
                        <svg height="40"><circle cx="50%" cy="24" r="13" fill="rgb(255, 0, 191)" /></svg>
                    </div>
                    <div class="col-xs-1">
                        <svg height="40"><circle cx="50%" cy="24" r="13" fill="rgb(255, 0, 127)" /></svg>
                    </div>
                    <div class="col-xs-1">
                        <svg height="40"><circle cx="50%" cy="24" r="13" fill="rgb(255, 0, 64)" /></svg>
                    </div>
                    <div class="col-xs-1">
                        <svg height="40"><circle cx="50%" cy="24" r="13" fill="rgb(255, 0, 0)" /></svg>
                    </div>
                </div>
            </div>
            <br><br>
            <div>
                <br><br>
                <button type="button" class="register-button" id="SubmitBtn" style="margin-top: 10px;">Submit</button>
                <br><br>
                <button type="button" class="register-button" id="OnOffBtn">ON/OFF</button>
                <br>
            </div>
        </div>
        <div id="myip">
            <script type='text/javascript' src="myip.js">
            </script>
            <div id="tools" class="tools">
                    <p>Your IP:</p>
            </div>
            <div id="ip-lookup" class="tools">
                                            <h1>90.207.247.101</h1>
            </div>
            <div id="more" class="tools">
                    <p><a id="more-link" title="More information" href="javascript:toggle();">More info</a></p>
            </div>
            <div id="more-info" class="tools">
                <ul>
                    <li>
                        <strong>Remote Port:</strong>
                        <span>43134</span>
                    </li>
                    <li>
                        <strong>Request Method:</strong>
                        <span>GET</span>
                    </li>
                    <li>
                        <strong>Server Protocol:</strong>
                        <span>HTTP/1.1</span>
                    </li>
                    <li>
                        <strong>Server Host:</strong>
                        <span>office-247-101.bllon.isp.sky.com</span>
                    </li>
                    <li>
                        <strong>User Agent:</strong>
                        <span>Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.75 Safari/537.36</span>
                    </li>
                </ul>
                <p>
                    <small>It took 0.00018215179443359 seconds to share this info.</small>
                </p>
            </div>
        </div>
        <script>
            $( document ).ready(function() {
                $('#OnOffBtn').click(function() {
                        $('.slide-in').toggleClass('show');
                    setTimeout(function () {
                        $('.slide-in').toggleClass('show');
                    }, 1600);
                });
                $('#SubmitBtn').click(function(){
                    var clickBtnValue = document.getElementById("myRange").value;
//                     window.location = "index.php?temp=" + clickBtnValue;
                    console.log(clickBtnValue);
                });
                var output = document.getElementById("value");
                var s = document.getElementById("myRange");
                var OnOff = document.getElementById("OnOffBtn");
                var StatOutput = document.getElementById('StatusVal');
                output.innerHTML = s.value;
                StatOutput.innerHTML = 'OFF';
                var r = 255, b = 255;
                OnOff.addEventListener("click", function(){
                    if(StatOutput.innerHTML == 'ON') {
                        StatOutput.innerHTML = 'OFF'
                        document.getElementById('StatCircle').style.backgroundColor = 'rgb(255,0,0)';
                    } else {
                        StatOutput.innerHTML = 'ON';
                        document.getElementById('StatCircle').style.backgroundColor = 'rgb(0,255,0)';
                    }
                })
                s.addEventListener("input", function(){
                    output.innerHTML = this.value;
                    console.log(this.value);
                    if(s.value > 50) {
                        r = 255;
                        b = Math.round(255*(100-s.value)/50);
                    } else {
                        r = Math.round(255*s.value/50);
                        b = 255;
                    }
                    var color = 'rgb('+r+',0,'+b+')';
                    console.log(color);
                    document.getElementById('ValCircle').style.backgroundColor = color;
                    for (let {cssRules} of document.styleSheets) {
                        for (let {selectorText, style} of cssRules) {
                            console.log(selectorText);
                            console.log(style);
                            if (selectorText === ".slider::-webkit-slider-thumb") {
                                style.backgroundColor = color;
                            }
                        }
                    }
                });
            });
        </script>
    </body>
</html>



<!--

Slide in text {}

  .slide-in {
    z-index: 10; /* to position it in front of the other content */
    position: absolute;
    overflow: hidden; /* to prevent scrollbar appearing */
  }

  .slide-in.from-right {
    right: 0;
    top: 230;
  }

  .slide-in-content {
    padding: 5px 20px;
    background: #eee;
    transition: all .5s ease;
  }

  .slide-in.from-right .slide-in-content {
    transform: translateX(100%);
    -webkit-transform: translateX(100%);
  }

  .slide-in.show .slide-in-content {
    transform: translateX(0);
    -webkit-transform: translateX(0);
  }
  <div class="slide-in from-right">
    <div class="slide-in-content">
      <h2 style="padding-bottom: 10px;"><span id="StatusVal"></span></h2>
    </div>
  </div> }
-->

