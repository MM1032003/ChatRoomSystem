<?php require_once APPROOT . "/" . "views/inc/header.php"; ?>
    <div class='container'>
        <div class="card mt-3 mb-3">
            <div class="card-header">
                        <h2>Room #<?= isset($data['roomObj']->id) ? $data['roomObj']->id: "";?></h2>
            </div>
            <div class="card-body">
                <?= isset($data['chatMsg']) ? $data['chatMsg']: ""; ?>
            </div>
            <div class='card-footer'>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="message">Your Message : </label>
                            <textarea class="form-control" id="message" rows="3"></textarea>
                        </div>
                    </div>
                    <div class='row'>
                        <?php
                            echo btnProvider('Leave', 'btn btn-danger btn-block', "leave()"); 
                            echo btnProvider('Send', 'btn btn-success btn-block', "sendMsg()"); 
                        ?>
                    </div>
            </div>
        </div>
    </div>
    <script>
        var userScrolled = false,
            card_Body    = document.querySelector(".card-body");
        window.onscroll = function() {
            window.userScrolled    = true;
        }
        setInterval(() => {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo URLROOT ?>pages/chatAjax", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send();
            xhr.onload = function() {
                $(".card-body").html(this.responseText);
                if (!userScrolled) {
                    card_Body.scrollTop = card_Body.scrollHeight;
                }
            }
        }, 1000);

    </script>
<?php require_once APPROOT . "/" . "views/inc/footer.php"; ?>