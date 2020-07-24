<?php require_once APPROOT . "/" . "views/inc/header.php"; ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-10 mx-auto ">
                    <div class="formContainer mt-5 bg-light rounded p-4">
                        <h1>Room Name To Join</h1>
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control <?php echo (!empty($data['usernameErr'])) ? "is-invalid" : ""; ?>" placeholder="Your Name" name='userName' aria-label="Your_Name" aria-describedby="basic-addon1">
                                <div class="invalid-feedback">
                                    <?= $data['usernameErr'] ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control <?php echo (!empty($data['roomNameErr'])) ? "is-invalid" : ""; ?>" placeholder="Room Name" name='roomName' aria-label="RoomName" aria-describedby="basic-addon1">
                                <div class="invalid-feedback">
                                    <?= $data['roomNameErr'] ?>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input <?php echo (!empty($data['roomTypeErr'])) ? "is-invalid" : ""; ?>" type="radio" name="chatType" id="exampleRadios1" value="due" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    Due Chat
                                </label>
                                <div class="invalid-feedback">
                                    <?= $data['roomTypeErr'] ?>
                                </div>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input <?php echo (!empty($data['roomTypeErr'])) ? "is-invalid" : ""; ?>" type="radio" name="chatType" id="exampleRadios2" value="group">
                                <label class="form-check-label" for="exampleRadios2">
                                    Group Chat
                                </label>
                                <div class="invalid-feedback">
                                    <?= $data['roomTypeErr'] ?>
                                </div>
                            </div>
                            <button class='btn-block btn btn-primary'>Join</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php require_once APPROOT . "/" . "views/inc/footer.php"; ?>
