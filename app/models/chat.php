<?php 
class chat {
    public function __construct() {
        $this->dbcon  = new Database();
    }

    public function getMsgs($roomObj) {
        $roomId = $roomObj->id;
        $this->dbcon->query("SELECT * FROM `messages` WHERE `roomId` = :id;");
        $this->dbcon->bindParams(":id", $roomId);
        $messages   = $this->dbcon->fetchObj();
        $msgHTML    = "";

        foreach($messages as $message) {
            $said       = ($message->username == $_SESSION['username']) ? "You : " : $message->username . " : ";
            
            if ($message->username == "") {
                $color  = "exit";
                $said   = "";
            } elseif ($message->username == $_SESSION['username']) {
                $color  = "user";
            } else {
                $color  = "";
            }

            $msgHTML    .= "<p class='$color'>" . $said . $message->body . "</p>";
        }
        return $msgHTML;
    }

    public function sendMsg($data) {
        $this->dbcon->query("INSERT INTO `messages`(`username`, `roomId`, `body`) VALUES (:username, :roomId, :body);");
        $this->dbcon->bindParams(":username", $data['username']);
        $this->dbcon->bindParams(":roomId", $data['roomId']);
        $this->dbcon->bindParams(":body", $data['msgBody']);

        return $this->dbcon->execute();
    }
    
}

?>