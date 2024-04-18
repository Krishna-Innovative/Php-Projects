<div class="time-block">
    <span class="red-time">
        <div id="timer_<?php echo $post->ID; ?>">
            <?php echo $post_date_added; ?>
            <span id="days_<?php echo $post->ID; ?>"></span>
            <span id="hours_<?php echo $post->ID; ?>"></span>
            <span id="minutes_<?php echo $post->ID; ?>"></span>
        </div>
        <span>
            <?php
            //current post date
            $post_date_added =  get_the_date('F j, Y G:i:s',  $post->ID);
            // echo $post_date_added; 
            ?>
        </span>
        <script type="text/javascript">
            $(document).ready(function() {
                function makeTimer() {
                    // linux time added seconds
                    // Tue Jun 14 2022 19:35:17 GMT+0300 //
                    var dateCreatedString = new Date("<?php echo $post_date_added; ?>");
                    // var dateCreatedInLinux = new Date(("<?php echo $post_date_added; ?>").getDate() + 28).getTime(); //broken

                    var endTime = new Date("<?php echo $post_date_added; ?>"); // js time
                    // console.log( endTime )
                    endTime.setDate(endTime.getDate() + 28); // linux time 
                    var endTime = (Date.parse(endTime)) / 1000; // secunds
                    // console.log(endTime);
                    var now = new Date();
                    var now = (Date.parse(now) / 1000);

                    var timeLeft = endTime - now;

                    var days = Math.floor(timeLeft / 86400);
                    var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
                    var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
                    var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

                    // if (hours < "10") {
                    //     hours = "0" + hours;
                    // }
                    // if (minutes < "10") {
                    //     minutes = "0" + minutes;
                    // }
                    // if (seconds < "10") {
                    //     seconds = "0" + seconds;
                    // }
                    if (days >= 2) {
                        $("#days_<?php echo $post->ID; ?>").html(days + "<span>D</span>");
                    }
                    else if (days < 2) {
                        $("#days_<?php echo $post->ID; ?>").html(days + "<span>D</span>");
                        $("#hours_<?php echo $post->ID; ?>").html(hours + "<span>H</span>");
                        $("#minutes_<?php echo $post->ID; ?>").html(minutes + "<span>M</span>");
                    } else if (days < 1 && hours < 23) {
                        $("#minutes_<?php echo $post->ID; ?>").html(minutes + "<span>M</span>");
                    } else {
                        $('#timer_<?php echo $post->ID; ?>').html('')
                    }
                }

                setInterval(function() {
                    makeTimer();
                }, 1000);

            });
        </script>
        <?php
        echo "<div id='timer'>
                <span id='days'></span>
                <span id='hours'></span>
                <span id='minutes'></span>
            </div>";
        ?>
    </span>
</div>