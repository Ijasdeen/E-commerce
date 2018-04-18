<?php
//We have broken up as parts, and called here.
require_once('Includes/header.php');
?>
    <!--<Brand>-->

    <div class="container">
        <div class="row">
   <!-- <Hidden FIeld for checking the message that is coming with session from SignUp.php-->      
         <input type="hidden" id="hiddenInput_message" value="<?php if(isset($_SESSION["singUpMessage"])) echo $_SESSION["singUpMessage"]; $_SESSION["singUpMessage"]='';?>">
<!-- //<Hidden FIeld for checking the message that is coming with session from SignUp.php-->
            
            
             <div class="col-md-3 col-sm-12 col-lg-4 col-xs-12">
                     <div id="get_brand">
                    <!--                    Brand is loaded from database using jquery-->
                </div>
                <div id="get_category">
                    <!--   category is loaded from datbase using jquery-->
                </div>
            </div>
            <div class="col-md-8 col-xs-12 col-lg-8 col-sm-12">
                <div class="row" id="get_product">
                    <!--   This is where products will be displayed depening on the clicks      -->
                </div>
            </div>
        </div>
    </div>
    <!--  <//Brand>-->

    <div class="modal fade" id="warningModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="text-danger" id="warningModalInformation">
                        <!--   The message is shown from jquery-->
                    </h3>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-info" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="signUp">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login and SignUp</h5>
                   
                </div>
                <div class="modal-body">
                   <button class="btn btn-danger" id="loginTrigger"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;Login</button>
                    <button class="btn btn-info" id="signUpTrigger"><i class="fa fa-user-plus" aria-hidden="true"></i>
&nbsp;Sign Up</button><br/><br/>
                   <div id="signUpForm">
                        <form method="POST" action="signUp.php" id="signUpForm">
                        <div class="form-group">
                            <label for="First_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required placeholder="E.g:David">
                            <span class="first_name_helper" id="first_name_helper"></span>
                        </div>
                        <div class="form-group">
                            <label for="Last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" required placeholder="E.g:Warner">
                            <span class="last_name_helper" id="last_name_helper"></span>
                        </div>
                        <div class="form-group">
                            <label for="First_name">Email </label>
                            <input type="email" name="email" id="email" class="form-control" required placeholder="E.g:yourEmail@gmail.com">
                            <span class="email_helper" id="email_helper"></span>
                        </div>
                        <div class="form-group">
                            <label for="password">password</label>
                            <input type="password" name="password" id="password" class="form-control" required placeholder="E.g:*************">
                            <span class="password_helper" id="password_helper"></span>
                        </div>

                        <div class="form-group">
                            <label for="Mobile">Mobile</label>
                            <input type="text" name="mobile" id="mobile" class="form-control" required placeholder="E.g:0758953.....">
                            <span class="mobile_number_helper" id="mobile_number_helper"></span>
                        </div>
                           <div class="form-group">
                            <label for="Address_1">Address 1</label>
                            <input type="text" name="address_1" id="address_1" class="form-control" required placeholder="Your street address">
                            <span class="address1-helper" id="address1_helper"></span>
                        </div>
                        <div class="form-group">
                            <label for="address_2">Address 2</label>
                            <input type="text" name="address_2" id="address_2" class="form-control" required placeholder="Your apartment or suite number">
                            <span class="address2_helper" id="address2_helper"></span>
                        </div>
                    
                        <input type="submit" value="Sign Up" id="btnSignUp" class="form-control btn btn-outline-primary">
                    </form>
                   </div>
                   
                   <div id="loginForm">
                       <form onsubmit="return false" id="loginModal">
                           <div class="form-group">
                               <label for="Email">Email</label>
                               <input type="email" name="loginEmail" id="loginEmail" class="form-control">
                               <span class="loginEmailHelper" id="loginEmailHelper"></span>
                           </div>
                           <div class="form-group">
                               <label for="password">Password</label>
                               <input type="password" name="loginPasword" id="loginPassword" class="form-control">
                           </div>
                           <div class="form-group">
                               <input type="submit" value="Log in" id="btnLogin" class="form-control btn btn-outline-info">
                           </div>
                       </form>
                       <input type="hidden" id="loginCheck_message" value="<?php if(isset($_SESSION["login_message"])){echo $_SESSION["login_message"];}$_SESSION["login_message"]=''?>">
                   </div>
                   
                   
                </div>
                <div class="modal-footer">
                    <span id="loginMessage"></span>
                </div>
            </div>
        </div>

     </div> 



<?php
//we have broken up as footer.
require_once('Includes/footer.php');
?>