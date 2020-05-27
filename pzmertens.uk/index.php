<!DOCTYPE html>
<head>
    <title>Paul & Zoes wedding photos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- PHP: Start -->
    <?php
        $pictures = array();
        foreach ( scandir('./thumbs') as $file ) {
            if ( strpos($file, 'jpg') === false) {
                continue;
            };
            array_push($pictures, $file);
        };
        echo "<script type='text/javascript'>";
        echo "pictures=" . json_encode($pictures) . ";";
        echo "</script>";
    ?>
    <!-- PHP: End -->
    <!--Stylesheets: Start -->
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css' integrity='sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS' crossorigin='anonymous'>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel='stylesheet' href='index.css'>
    <!-- Stylesheets: End -->
    <!-- Scripts: Start -->
    <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js' integrity='sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k' crossorigin='anonymous'></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!--Scripts: End -->
</head>
<body>
    <nav id='navbar' class='navbar navbar-expand-lg navbar-light bg-light'>
        <form method='get' id='dlform'>
            <ul class='nav nav-pills mx-auto list-inline justify-content-center' id='options'>
                <li>Quality <input id='resolution' type='checkbox' checked data-toggle='toggle' data-on='High' data-off='Low' data-onstyle='success' data-offstyle='primary' onchange='changeRes()'></li>
                <li><button class='btn-primary' type='submit'><a class="fa fa-download label-primary"></a> Download all</button></li>
            </ul>
        </form>
    </nav>
    <div id='imgviewer' class='imgviewpane' style='display: none;'>
        <img id="expandedImg" style="width:100%; object-fit: contain;" onclick='hideFullImage()'>
    </div>
    <div id='gallery' class='container-fluid' style='margin-top:75px;'>
        <ul id="lightgallery" class="list-unstyled row">
        </ul>
    </div>
    <script type='text/javascript'>
        function drawGallery() {
            resolution = 'high';
            document.getElementById('dlform').action = window.location + 'paulandzoeweddingphotos_' + resolution + 'res.zip';
            done = 0;
            rowno = 1;
            columns = 6
            gallery = document.getElementById('gallery');
            row = document.createElement('div');
            row.className = 'row';
            row.id = 'row';
            gallery.appendChild(row);
            pictures.forEach(function(picture) {
                imgcell = document.createElement('div');
                imgcell.className = 'col-md-2';
                imgcell.onclick = function() { displayFullImage(picture);};
                img = document.createElement('img');
                img.src = window.location +  'thumbs/' + picture;
                img.alt = 'thumbnail ' + picture;
                img.className = 'img-responsive';
                img.id = picture.replace('.jpg', '');
                imgcell.appendChild(img);
                row.appendChild(imgcell);
                done++
                if ( row.childElementCount != columns) {
                    return;
                };
                rowno++
            });
        }
        function fixSizes() {
            rows = document.getElementsByClassName('row');
            for ( row in rows) {
                if ( ! row.includes('row') ) {
                    continue;
                };
                rowchildren = rows[row].children;
                for (child in rowchildren) {
                    if (typeof rowchildren[child] !== 'object') {
                        continue;
                    };
                    if ( document.getElementById(rowchildren[child].children[0].id).clientHeight < 200 ) {
                        continue;
                    };
                    if ( document.getElementById(rowchildren[child].children[0].id).clientHeight < 50 ) {
                        console.log(rowchildren[child].children[0].id + " - " + document.getElementById(rowchildren[child].children[0].id).clientHeight);
                    };
                    console.log(rowchildren[child].children[0]);
                    rowchildren[child].children[0].className = 'tallimg';
                };
            };
        };
        function changeRes() {
            resolution = 'high';
            if ( document.getElementById('resolution').checked == false ) {
                resolution = 'low';
            }
            document.getElementById('dlform').action = window.location + 'paulandzoeweddingphotos_' + resolution + 'res.zip';
        }
        function displayFullImage(picture) {
            document.getElementById('expandedImg').src = window.location + resolution + 'resolution/' + picture;
            document.getElementById('imgviewer').style.display = '';
            document.getElementById('gallery').style.display = 'none';
            document.getElementById('navbar').style.display = 'none';
            location,href = '#' + pictures[0].split('.')[0];
        }
        function hideFullImage() {
            document.getElementById('imgviewer').style.display = 'none';
            document.getElementById('gallery').style.display = '';
            document.getElementById('navbar').style.display = '';
            pictureid = document.getElementById('expandedImg').src.split('/');
            pictureid = pictureid[pictureid.length - 1].split('.')[0];
            setTimeout(function(){ 
                url = location.href;
                location.href = '#' + pictureid;
                window.scrollBy(0, -60);
                history.replaceState(null,null,url);
            }, 1000);
        }
        $('#resolution').bootstrapToggle()
        drawGallery();
        $(window).onload = fixSizes();
        setInterval(fixSizes, 3000);
    </script>
</body>
