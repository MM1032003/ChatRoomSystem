function sendMsg() {
    var msg = document.getElementById("message").value;
    if (msg == "") {
        alert("Message Can't Be Empty");
    } else {
        var xhr     = new XMLHttpRequest();
        var params  = "msgBody=" + msg;
        document.getElementById("message").value = "";
        xhr.open("POST", "http://localhost/roomChatSys/pages/send");
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onload  = function () {
            console.log(this.responseText);
        }
        xhr.send(params);
    }
}
function leave() {
    var xhr     = new XMLHttpRequest();
    document.getElementById("message").value = "";
    xhr.open("POST", "http://localhost/roomChatSys/pages/leave");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload  = function () {
        // Simulate a mouse click:
        window.location.href = "<?= URLROOT ?>pages/index";

        // Simulate an HTTP redirect:
        window.location.replace("<?= URLROOT ?>pages/index");
    }
    xhr.send();
}