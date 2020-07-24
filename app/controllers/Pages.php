<?php
class Pages extends Controller{
    public function __construct() {
        $this->roomModel    = $this->model("room");
        $this->chatModel    = $this->model("chat");
    }
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $data   = [
                "Username"      => isset($_POST['userName']) ? filter_var(strip_tags($_POST['userName']), FILTER_SANITIZE_STRING) : "",
                "roomName"      => isset($_POST['roomName']) ? filter_var(strip_tags($_POST['roomName']), FILTER_SANITIZE_STRING) : "",
                "roomType"      => isset($_POST['chatType']) ? $_POST['chatType'] :  "",
                "usernameErr"   => "",
                "roomNameErr"   => "",
                "roomTypeErr"   => "",
            ];

            if (empty($data['Username'])) {
                $data['usernameErr']    = "Username Can't Be Empty";
            }
            if (empty($data['roomName'])) {
                $data['roomNameErr']    = "Room Name Can't Be Empty";

            }
            if ($this->roomModel->fullRoom($data['roomName'], $data['roomType'])) {
                $data['roomNameErr']    = "Use Another Room Name That's Full";

            }
            if (empty($data['roomType'])) {
                $data['roomTypeErr']    = "Select Your Chat Type";
            }

            if ($data['roomType'] == "due") {
                if ($this->roomModel->roomExists($data['roomName'], "group")) {
                    $data['roomNameErr']    = "Please Use Another Name";
                }
            } elseif ($data['roomType'] == "group") {
                if ($this->roomModel->roomExists($data['roomName'], "due")) {
                    $data['roomNameErr']    = "Please Use Another Name";
                }
            }

            if (empty($data['usernameErr']) && empty($data['roomNameErr']) && empty($data['roomTypeErr'])) {
                session_start();
                $_SESSION['username']   =   $data['Username'];
                $_SESSION['roomName']   =   $data['roomName'];
                $enterRoom              = $this->roomModel->join($data['Username'], $data['roomName'], $data['roomType']);
                if ($enterRoom == "Connected") {

                    $room           = $this->roomModel->getRoom($data['roomName']);
                    $data['roomObj']= $room;
                    $messsages      = $this->chatModel->getMsgs($data['roomObj']);

                    $data['chatMsg']= $messsages;
                    $this->view("pages/chat", $data);
                }else if ($enterRoom   == "Wait") {
                    $this->view("pages/wait", $data);
                }
            } else {
                $this->view("pages/index", $data);
            }

        } else {
            
            $data   = [
                
                ];
            $this->view("pages/index", $data);

        }
    }
    public function waitAjax() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            session_start();
            $data =  [
                "username"  => $_SESSION['username'],
                "roomName"  => $_SESSION['roomName']
            ];
            $roomStatus     = $this->roomModel->checkDue($data['roomName'], $data['username']);
            $room           = $this->roomModel->getRoom($data['roomName']);
            if ($roomStatus == "Connected") {
                echo "Connected";
            } else {
                echo "Wait";
            }
        }

    }
    public function chat() {
        session_start();
        if (isset($_SESSION['username']) && $_SESSION['roomName']) {
            $data =  [
                "username"  => $_SESSION['username'],
                "roomName"  => $_SESSION['roomName'],
            ];

            $room           = $this->roomModel->getRoom($data['roomName']);
            $data['roomObj']= $room;
            $messsages      = $this->chatModel->getMsgs($data['roomObj']);
            $data['chatMsg']= $messsages;

            $this->view("pages/chat", $data);
        } else {
            header("location :" . URLROOT);
        }
    }
    public function chatAjax() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            session_start();

            $data   = [
                "roomName" => $_SESSION['roomName']
            ];

            $room           = $this->roomModel->getRoom($data['roomName']);
            $data['roomObj']= $room;

            $messsages      = $this->chatModel->getMsgs($data['roomObj']);
            $data['chatMsg']= $messsages;

            echo $data['chatMsg'];
        }
    }
    public function send() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            session_start();
            $data   = [
                'username'  => $_SESSION['username'],
                'roomId'   => $this->roomModel->getRoom($_SESSION['roomName'])->id,
                'msgBody'   => $_POST['msgBody']
            ];
            return $this->chatModel->sendMsg($data);
        } else {
            header("locaton: " . URLROOT);
        }
    }
    public function leave() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            session_start();
            $data   = [
                'username'  => "",
                'roomId'   => $this->roomModel->getRoom($_SESSION['roomName'])->id,
                'msgBody'   => $_SESSION['username'] . " Left The Group"
            ];
            $this->chatModel->sendMsg($data);
            $this->roomModel->leave($_SESSION['username'], $_SESSION['roomName']);
        }
    }
}