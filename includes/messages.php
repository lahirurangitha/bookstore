<?php

if(Session::exists('messages')){
    if(Session::get('m_type')=='error'){
        ?>
        <div id="myModal" class="modal">
            <div class="modal-content notif_error">
                <span class="close">&times;</span>
                <p><?php echo ucfirst(Session::get('messages'));?></p>
            </div>

        </div>

        <?php
    }elseif(Session::get('m_type')=='success'){
        ?>
        <div id="myModal" class="modal">
            <div class="modal-content notif_success">
                <span class="close">&times;</span>
                <p><?php echo ucfirst(Session::get('messages'));?></p>
            </div>

        </div>
        <?php
    }else{
        ?>
        <div id="myModal" class="modal">
            <div class="modal-content notif_info">
                <span class="close">&times;</span>
                <p><?php echo ucfirst(Session::get('messages'));?></p>
            </div>

        </div>
        <?php
    }
    ?>

    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];


        modal.style.display = "block";

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <?php
    Session::delete('messages');
}