<?php 
class room {
    private $dbcon;

    public function __construct() {
        $this->dbcon  = new Database();
    }

    public function fullRoom($roomName, $type)  {
        $this->dbcon->query("SELECT * FROM `rooms` WHERE `name` = :name AND `type` = :ty;");
        $this->dbcon->bindParams(":name", $roomName);
        $this->dbcon->bindParams(":ty", $type);
        $room       =  $this->dbcon->single();
        if (isset($room->members)) {
            $membersNum = count(explode(",", $room->members));
            if ($type == "due" && $membersNum == 2) {
                return true;
            }
        } else {
            return 0;
        }

    }

    public function roomExists($roomName, $type) {
        $this->dbcon->query("SELECT * FROM `rooms` WHERE `name` = :name AND `type` = :ty;");
        $this->dbcon->bindParams(":name", $roomName);
        $this->dbcon->bindParams(":ty", $type);

        return $this->dbcon->rowCount() > 0;
    }

    public function join($username, $roomName, $roomType) {
        $roomExists     = $this->roomExists($roomName, $roomType);

        if (!$roomExists)  {
            $this->createRoom($roomName, $roomType, $username);
        }
        if ($roomType == "due") {
            $due    = $this->checkDue($roomName, $username);
            return $due;
        } else if ($roomType == "group") {
            $group  = $this->checkGroup($roomName, $username);
            return $group;
        }
    }

    public function createRoom($roomName, $roomType, $username) {
        $this->dbcon->query("INSERT INTO `rooms`(`name`, `members`, `type`) VALUES (:name, :members, :type);");
        $this->dbcon->bindParams(":name", $roomName);
        $this->dbcon->bindParams(":members", $username);
        $this->dbcon->bindParams(":type", $roomType);

        return $this->dbcon->execute();
    }
    
    public function checkDue($roomName, $username) {
        $this->dbcon->query("SELECT * FROM `rooms` WHERE `name` = :name AND `type` = 'due';");
        $this->dbcon->bindParams(":name", $roomName);
        $room       = $this->dbcon->single();
        $membersArr = explode(",", $room->members);
        if(in_array($username, $membersArr) && count($membersArr) == 1) {
            return "Wait";
        } else if (count($membersArr) == 2 && in_array($username, $membersArr)){
            return "Connected";
        } else {
            array_push($membersArr, $username);
            $members    = implode(",", $membersArr);
            return ($this->updateRoomMembers($roomName, $members)) ? "Connected" : "";
        }
    }

    public function checkGroup($roomName, $username) {
        $this->dbcon->query("SELECT * FROM `rooms` WHERE `name` = :name AND `type` = 'group';");
        $this->dbcon->bindParams(":name", $roomName);
        $room       = $this->dbcon->single();
        $membersArr = explode(",", $room->members);
        if(in_array($username, $membersArr)) {
            return "Connected";
        } else {
            array_push($membersArr, $username);
            $members    = implode(",", $membersArr);
            return ($this->updateRoomMembers($roomName, $members)) ? "Connected" : "";
        }
    }
    
    public function updateRoomMembers($roomName, $members) {
        $this->dbcon->query("UPDATE `rooms` SET `members` = :members WHERE `name` = :name");
        $this->dbcon->bindParams(":members", $members);
        $this->dbcon->bindParams(":name", $roomName);

        return $this->dbcon->execute();
    }
    
    public function getRoom($roomName) {
        $this->dbcon->query("SELECT * FROM `rooms` WHERE `name` = :name;");
        $this->dbcon->bindParams(":name", $roomName);
        return $this->dbcon->single();
    }
    public function leave($username, $roomName) {
        $this->dbcon->query("SELECT * FROM `rooms` WHERE `name` = :name;");
        $this->dbcon->bindParams(":name", $roomName);
        $room       = $this->dbcon->single();
        $membersArr = explode(",", $room->members);
        if (in_array($username, $membersArr)) {
            unset($membersArr[array_search($username, $membersArr)]);
        }
        $members    = implode(",", $membersArr);
        return ($this->updateRoomMembers($roomName, $members));
    }
}
?>