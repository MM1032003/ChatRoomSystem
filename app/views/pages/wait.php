<?php require_once APPROOT . "/" . "views/inc/header.php"; ?>
    <div class="container">
        <div class="alert alert-secondary mt-4 col-6 mr-auto ml-auto" id='msgContainer'>Wait Someone To Connect...</div>
    </div>
    <script>
    setInterval(() => {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo URLROOT ?>pages/waitAjax", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send();
            xhr.onload = function() {
                if (this.responseText == "Connected") {
                    // Simulate a mouse click:
                    window.location.href = "<?= URLROOT ?>pages/chat";

                    // Simulate an HTTP redirect:
                    window.location.replace("<?= URLROOT ?>pages/chat");
                }
            }
        }, 1000);
    </script>
<?php require_once APPROOT . "/" . "views/inc/footer.php"; ?>