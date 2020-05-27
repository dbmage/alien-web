
    function hideStuff(){

        if (document.getElementById){

            var x = document.getElementById('more-info');

            x.style.display="none";

        }

    }

    function toggle(){

        if (document.getElementById){

            var x = document.getElementById('more-info');

            var y = document.getElementById('more-link');

            if (x.style.display == "none"){

                x.style.display = "";

                y.innerHTML = "Less info";

            } else {

                x.style.display = "none";

                y.innerHTML = "More info";

            }

        }

    }

    window.onload = hideStuff;

