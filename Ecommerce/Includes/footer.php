
             <div style="height:200px;"></div>

        <div class="modal fade" id="changePassword">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    
                    <div class="modal-body">
                        <form onsubmit="return false" id="passwordChangeModal">
                            <div class="form-group">
                                <label for="oldPassword">Old Password</label>
                                <input type="password" name="oldPassword" id="oldPassword" class="form-control old-password">
                                <span class="text-danger" id="MessageForOldPassword"></span>
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" class="new-password form-control" id="newPassword" name="confirmPassword">
                                <span class="text-danger" id="newPasswordMessage"></span>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" class="confirm-password form-control" id="confirmPassword" name="confirmPassword">
                                <span class="text-danger" id="confirmPasswordMessage"></span>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Change password" class="btn btn-primary" id="btnChangePassword">
                            </div>
                            <input type="hidden" id="changePasswordFinalMessage" value="<?php
                                 if(isset($_SESSION["updatedSuccessfully"])){echo $_SESSION["updatedSuccessfully"]; $_SESSION["updatedSuccessfully"]='';}
                                                                                        ?>">
                        </form>
                    </div>
                    <div class="modal-footer">
                         <label for="mesage" id="change_password_message"></label>
                    </div>
                </div>
            </div>
        </div>

       
       
       <div style="height:200px;"></div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS and Main <Js></Js> -->
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>

   

</body>

</html>