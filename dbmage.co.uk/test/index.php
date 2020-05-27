<html>
    <head>
        <!-- Script imports -->
        <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js'></script>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js' integrity='sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k' crossorigin='anonymous'></script>
        <script src="https://uicdn.toast.com/tui.code-snippet/latest/tui-code-snippet.js"></script>
        <script src="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.js"></script>
        <!-- CSS imports -->
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css' integrity='sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS' crossorigin='anonymous'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css' />
        <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.css" />
        <!-- PHP -->
        <?php
            $output = shell_exec('./getBookings.py');
            if ( strlen($output) > 0 ) {
                print("<script type='text/javascript'>dataIn=" . $output . ";</script>");
            };
        ?>
    </head>
    <body>
        <div class='container jumbotron'>
            <div class='row' id='barberselect'>
            </div>
            <div id='calendardiv'>
                <div id="menu">
                    <span id="menu-navi">
                        <button type="button" class="btn btn-default btn-sm move-today" data-action="move-today">Today</button>
                        <button type="button" class="btn btn-default btn-sm move-day" data-action="move-prev">
                            <i class="calendar-icon ic-arrow-line-left" data-action="move-prev"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-sm move-day" data-action="move-next">
                            <i class="calendar-icon ic-arrow-line-right" data-action="move-next"></i>
                        </button>
                    </span>
                    <span id="renderRange" class="render-range">
                    </span>
                </div>
                <div id='calendar' style="height: 800px;">
                </div>
            </div>
        </div>
        <!-- JS functions -->
        <script type='text/javascript'>
            $('#calendardiv').hide();
            Calendar = tui.Calendar;
            calendar = new Calendar('#calendar', {
                defaultView: 'month',
                taskView: true,
                useCreationPopup: true,
                useDetailPopup: true,
                template: {
                    monthGridHeader: function(model) {
                        var date = new Date(model.date);
                        var template = '<span class="tui-full-calendar-weekday-grid-date">' + date.getDate() + '</span>';
                        return template;
                    }
                }
            });
            function buildCalendarSchedule() {
                menu = document.getElementById('barbermenu');
                scheduleData = dataIn[menu.options[menu.selectedIndex].text];
//                console.log(scheduleData);
//                while ( scheduleData == 
                $('#calendardiv').show();
                for (x in scheduleData) {
                    calendar.deleteSchedule('' + menu.options[menu.selectedIndex].value + x, '1');
                    scheduleData[x]['id'] = '' + menu.options[menu.selectedIndex].value + x;
                    scheduleData[x]['calendarId'] = '1';
                    scheduleData[x]['title'] = menu.options[menu.selectedIndex].text + ' booking';
                    scheduleData[x]['category'] = 'time';
                    scheduleData[x]['dueDateClass'] = '';
                    scheduleData[x]['isReadOnly'] = true;
                };
                calendar.createSchedules(scheduleData);
            };
            if (typeof dataIn != 'undefined'){
                dataSorted = [];
                for (x in dataIn){
                    dataSorted.push(x);
                };
                ddmenudiv = document.getElementById('barberselect');
                ddmenu = document.createElement('select');
                dddefopt = document.createElement('option');
                dddefopt.innerHTML = 'Select barber';
                dddefopt.disabled = true;
                dddefopt.selected = true;
                ddmenu.appendChild(dddefopt);
                for (x in dataSorted.sort()) {
                    ddoption = document.createElement('option');
                    ddoption.value = x;
                    ddoption.innerHTML = dataSorted[x];
                    ddmenu.appendChild(ddoption);
                };
                ddmenudiv.appendChild(ddmenu);
                ddmenu.addEventListener('change', buildCalendarSchedule);
                ddmenu.id = 'barbermenu';
            };
        </script>
    </body>
</html>
