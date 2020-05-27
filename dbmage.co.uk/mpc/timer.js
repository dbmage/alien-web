
    // $Id: countdowntimer.module,v 1.8.2.29 2008/04/21 18:47:34 jvandervort Exp $
    var formats = ['<em>(%dow% %moy%%day%)</em><br/>%days% days + %hours%:%mins%:%secs%','Only %days% days, %hours% hours, %mins% minutes and %secs% seconds left', '%days% shopping days left', '<em>(%dow% %moy%%day%)</em><br/>%days% days + %hours%:%mins%:%secs%'];

    function jstimer(timer_element) {
      /* defaults */
      var d = {year:"2068",month:"1",day:"1",hour:"00",min:"00",sec:"00",tz_hours:-8,dir:"down",format_num:0, format_txt:"", timer_complete:new String('<em>Timer Completed</em>'), highlight:new String('style="color:red"').split(/=/), threshold:new Number('5')};
      /* jstimer.properties */
      this.element = timer_element;
      this.d = d;
      /* jstimer.methods */
      this.parse_datetime = parse_datetime;
      this.update_timer = update_timer;

      /* get tagged datetime */
      this.parse_datetime();

      this.to_date = new Date();
      this.to_date.setFullYear(d.year,d.month-1,d.day);
      this.to_date.setHours(d.hour);
      this.to_date.setMinutes(d.min);
      this.to_date.setSeconds(d.sec);

      var tz_offset_client = -(this.to_date.getTimezoneOffset()*60*1000);  //getTimezoneOffset: minutes between the time on the current machine and UTC
      var tz_offset = (d.tz_hours*60*60*1000);
      var msecs =  this.to_date.getTime();
      this.to_date.setTime(msecs - tz_offset + tz_offset_client);

      var myDays=["Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sun"];
      var myMonths=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
      dow = myDays[this.to_date.getDay()];
      moy = myMonths[this.to_date.getMonth()];
      // replace the static stuff in the format string
      if ( d.format_txt != "" ) {
          this.outformat = d.format_txt;
      } else {
        this.outformat = formats[d.format_num];
      }
      this.outformat = this.outformat.replace(/%day%/,d.day);
      this.outformat = this.outformat.replace(/%month%/,d.month);
      this.outformat = this.outformat.replace(/%year%/,d.year);
      this.outformat = this.outformat.replace(/%moy%/,moy);
      this.outformat = this.outformat.replace(/%dow%/,dow);
    }

    function parse_datetime() {
      var strdate = $(this.element).children("span[@name=datetime]").html();
      if ( String(strdate) != "null" ) {
        /* 1995-02-04T15:00:00   International Standard ISO 8601 */
        this.d.original_date = strdate;
        var date_and_time = String(strdate).split('T');
        if ( date_and_time.length == 2 ) {
          var date_only = date_and_time[0].split('-');
          if ( date_only.length == 3 ) {
            this.d.year  = date_only[0];
            this.d.month = date_only[1];
            this.d.day   = date_only[2];
          }
          var time_only = String(date_and_time[1]).split(':');
          this.d.hour = time_only[0] || this.d.hour;
          this.d.min  = time_only[1] || this.d.min;
          this.d.sec  = time_only[2] || this.d.sec;
        }
        this.d.dir = $(this.element).children("span[@name=dir]").html() || this.d.dir;
        this.d.tz_hours = $(this.element).children("span[@name=tz_hours]").html() || this.d.tz_hours;
        this.d.format_num = $(this.element).children("span[@name=format_num]").html() || this.d.format_num;
        this.d.format_txt = $(this.element).children("span[@name=format_txt]").html() || "";
        if ( String(this.d.format_txt).match("'") ) {
          this.d.format_txt = "<span style=\"color:red;\">Format may not contain single quotes(').</span>";
        }
        this.d.threshold = $(this.element).children("span[@name=threshold]").html() || this.d.threshold;
        this.d.timer_complete = $(this.element).children("span[@name=complete]").html() || this.d.timer_complete;

      } else {
        /* legacy format */
        strdate = $(this.element).html();
        this.d.dir = "down";
        var date_and_time = strdate.split(' ');
        if (typeof(date_and_time[0]) != 'undefined' && date_and_time[0] != '') {
          var date_only = date_and_time[0].split('-');
          this.d.year  = date_only[0] || this.d.year;
          this.d.month = date_only[1] || this.d.month ;
          this.d.day   = new String(date_only[2] || this.d.day) ;
        }
        if (typeof(date_and_time[1]) != 'undefined' && date_and_time[1] != '') {
          var time_only = date_and_time[1].split(':');
          this.d.hour = time_only[0] || this.d.hour;
          this.d.min  = time_only[1] || this.d.min;
          this.d.sec  = time_only[2] || this.d.sec;
        }
        if (typeof(date_and_time[2]) != 'undefined' && date_and_time[2] != '') {
          this.d.tz_hours = date_and_time[2];
        }
        if (typeof(date_and_time[3]) != 'undefined' && date_and_time[3] != '') {
          if ( date_and_time[3] > 0 && date_and_time[3] < 4 ) {
            this.d.format_num = date_and_time[3];
          }
        }
      }
    }

    // update_timer: returns false if the timer is done.
    function update_timer() {
      var now_date = new Date();
      var diff_secs;
      if ( this.d.dir == "down" ) {
        diff_secs = Math.floor((this.to_date.getTime() - now_date.getTime()) / 1000);
      } else {
        diff_secs = Math.floor((now_date.getTime() - this.to_date.getTime()) / 1000);
      }

      if ( this.d.dir == "down" && diff_secs < 0 ) {
        /* timer counting down */
        $(this.element).html(this.d.timer_complete);
        return false;
      } else {
        var years = Math.floor(diff_secs / 60 / 60 / 24 / 365.25);
        var days = Math.floor(diff_secs / 60 / 60 / 24);
        var ydays = Math.ceil(days - (years * 365.25));
        var hours = Math.floor(diff_secs / 60 / 60) - (days * 24);
        var minutes = Math.floor(diff_secs / 60) - (hours * 60) - (days * 24 * 60);
        var seconds = diff_secs - (minutes * 60) - (hours * 60 * 60) - (days * 24 * 60 * 60);

        var outhtml = new String(this.outformat);
        outhtml = outhtml.replace(/%years%/,years);
        outhtml = outhtml.replace(/%ydays%/,ydays);
        outhtml = outhtml.replace(/%days%/,days);
        outhtml = outhtml.replace(/%hours%/,LZ(hours));
        outhtml = outhtml.replace(/%mins%/,LZ(minutes));
        outhtml = outhtml.replace(/%secs%/,LZ(seconds));

        if ( days == 1 ) {
          outhtml = outhtml.replace(/days/,'day'); //kludge, find a better way
        }
        if ( years == 1 ) {
          outhtml = outhtml.replace(/years/,'year'); //kludge, find a better way
        }

        if ( this.d.dir == "up" && diff_secs <= 0 ) {
          $(this.element).html('<span style="color:red;">Count Up Date is in the future<br/>orig_target=' + this.d.original_date + ' ' + this.d.tz_hours + '<br/>local=' + this.to_date + '</span>');
        } else if ( this.d.dir == "down" && (diff_secs <= (this.d.threshold * 60)) ) {
          $(this.element).html('<span ' + this.d.highlight[0] + '=' + this.d.highlight[1] + '>' +  outhtml + '</span>');
        } else {
          $(this.element).html(outhtml);
        }

        return true;
      }
    }


    var running = 0;
    var timer_stack = new Array();
    function countdown_auto_attach() {
      $(".countdowntimer").each(
        function(i) {  // arg i is the position in the each fieldset
          var t = new jstimer(this,1);
          timer_stack[timer_stack.length] = t;
          if ( running == 0 ) {
            running = 1;
            timer_loop();
          }
        }
      );
    }
    function timer_loop() {
      for (var i = timer_stack.length - 1; i >= 0; i--) {
        if ( timer_stack[i].update_timer() == false ) {
          timer_stack.splice(i, 1);
        }
      }
      setTimeout('timer_loop()',999);
    }
    function LZ(x) {
      return (x >= 10 || x < 0 ? "" : "0") + x;
    }