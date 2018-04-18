$(document).ready(function(){
    //<GetBrand>
    
 
    brand(); //We are calling the brand to show in default
    category(); //We are calling the category to show in default
    displayProduct(); //this function is called here to show some products in default.
     function displayProduct(){
         $.ajax({
            url:"action.php",
             method:"POST",
             data:{show:1},
             success:function(data){
                   $("#get_product").html(data);
             }
         });
     }
         
    
   
   //This function takes all the names of the brands from database.
    function brand()
    {
      $.ajax({
         url:"action.php",
         method:"POST",
         data:{brand:1},//We are sending brand with 1 to enable the code in PHP
          success: function(data)
          {
              $("#get_brand").html(data);
          }
      });
    }
    
    //This is the fuction which gets category from databse.
    function category()
    {
        $.ajax({
           url:'action.php',
            method:'POST',
            data:{category:1},
            success:function(data){
                $("#get_category").html(data);
            }
        });
    }
    
    //When the user clicks on "Select-brand" it fetches the data from databse and displies by using ajax.
   $("body").delegate('.select-brand',"click",function(event){
       event.preventDefault();
       $('#get_product').html("<h3>Loading......</h3>");
       let bid=$(this).attr('bid');
       
       $.ajax({
          url:"action.php",
           method:"POST",
           data :{selectBrand:1, brandId:bid},
           success: function(data)
           {
               $("#get_product").html(data);
           }
           
       });
       
       
   })
    
   //When the user searches products.
 $("#searchButton").click(function(event){
      
      let productName=$("#searchBox").val().trim();
      

     if(productName!="")
         {
         $('#get_product').html("<h3>Loading......</h3>");

              $.ajax({
         url:"action.php",
          method:"POST",
          data:{searchBox:1,productName:productName},
          success:function(data){
              $("#get_product").html(data);
          }
      });
             
         }
     else {
         $("#searchBox").focus(); //When the user clicks with empty input field 
     }
      
     
     
 })
   //When the user clicks on the "category" it fetches the data from database by using ajax.
   $("body").delegate('.category',"click",function(event){
       event.preventDefault();
       $('#get_product').html("<h3>Loading......</h3>");
       let cid=$(this).attr('cid');
       
       $.ajax({
          url:"action.php",
           method:"POST",
           data :{get_seleted_Category:1, cat_id:cid},
           success: function(data)
           {
               $("#get_product").html(data);
           }
           
       });
       
       
   })
    
    //When a user tries to add products without logging in. it raises the warning message to log in.
    $("body").delegate(".addProduct","click",function(event){
               var productId=$(this).attr('pid');
               let itemPrice=$(this).attr('itemPrice');
                
       $.ajax({
          url:"action.php",
           method:"POST",
           data:{addToCart:1,proId:productId,itemPrice:itemPrice},
           success:function(data){
               if(data=="NotLogin")
                   {
                       $("#warningModalInformation").html("<span class='text-warning'>Please login first.</span>");
                         $("#warningModal").modal('show');
                   }
               if(data=="No")
                   {
                       $("#warningModalInformation").removeClass("text-success");
                       $("#warningModalInformation").addClass("text-danger");
                       $("#warningModalInformation").html("This product has already been added to your cart");
                        $("#warningModal").modal('show');
                        
                        
                   }
               if(data=="Yes")
                   {
                       $("#warningModalInformation").removeClass("text-danger");
                       $("#warningModalInformation").addClass("text-success");
                       $("#warningModalInformation").html("Product added successfully");
                       $("#warningModal").modal('show');
                   }
               countItem();
               $("#getMessage").html(data);
           }
       });
        

    })
    
    //When the user clicks select brand, it will remove the "Active" class from "category"
    $("body").delegate('.select-brand',"click",function(event){
        
         
        $(".category").removeClass('active');
        //When a user clicks on brand, class Active is removed from category
    })
    
    //When the user licks on category side, it removes the "Acitve" class from "Select-brand";
    $("body").delegate('.category','click',function(event){
         
        $(".select-brand").removeClass('active');
        //When category is clicked, class Active is removed from brand;   
    })
    
    
    //This function is used to communicate with database by using ajax. It will take the items of a particular user and show them on badge.
    countItem();
    function countItem(){
        $.ajax({
           url:"action.php",
            method:"POST",
            data:{count_item:1},
            success:function(data){
                $(".badge").html(data);
            }
        });
    }
    
    $("#btnLogin").click(login);
    $("#loginForm").hide(); //Hiding login form as default;
    $("#signUpTrigger").hide();//Hiding the Sign up trigger button as default;
    
    $("#loginTrigger").click(function(){
        //When the login trigger button is pressed, it hides itself and shows login form after hiding Sign Up form
        
      $(this).fadeOut(400);
        $("#signUpTrigger").fadeIn(700);
     $("#signUpForm").slideUp(500);
     $("#loginForm").slideDown(900);
    })
    
    $("#signUpTrigger").click(function(){
//When the sign up buttton is preessed, it hides itself and sow sign up from after hiding login form.        
        $(this).fadeOut(400);
        $("#loginTrigger").fadeIn(700);
          $("#loginForm").slideUp(500);
           $("#signUpForm").slideDown(900);
    })
    
    
    
    
    loginCheckMessage();
    function loginCheckMessage()
    {
        // loginCheckMessage =1 (Login success);
        //LoginCheckMessage =0 (Login fail); (This is not important since login fields are validated in the same modal by jquery);
        let loginCheckMessage=$("#loginCheck_message").val();
       
        if(loginCheckMessage=="1")
            { 
                $("#warningModalInformation").html("<span class='text-primary'>Login successfully....</span>");
                $("#warningModal").modal('show');
            }
       
    }
    
     //This function validates the entered login form input fields. 
    function login(){
      let loginEmail=$("#loginEmail");
      let loginpassword=$("#loginPassword");
      let loginMesasge=$("#loginMessage");
        if(loginEmail.val()=="" && loginpassword.val()=="")
            { 
                loginEmail.css("border-color","red").focus(); // change the boder color and focus.
                loginpassword.css("border-color","red");
                loginMesasge.html("<b class='text-danger'>All fields are mandatory</b>");
                return false; //Preventing the form from submitting.
            }
         
    }
    
    signUpCheckMessage();
    //This function checks the hidden field with the "id=hiddenInput_message";
    function signUpCheckMessage()
    {
        let message=$("#hiddenInput_message").val();
        if(message!="")
            {
                $("#warningModalInformation").removeClass("text-danger");
                $("#warningModalInformation").addClass("text-success");
                $("#warningModalInformation").html(message);
                 $("#warningModal").modal('show');
                 
             
            }
    }
    
       $("#btnSignUp").click(signUp);

    
    //This function validates the input fields in signup modal.
function signUp(){
    //<InputFields>
     
    let first_name= $("#first_name").val(); 
    let last_name = $("#last_name").val();
    let email = $("#email").val();
    let password = $("#password").val();
    let mobile = $("#mobile").val();
    let address_1 = $("#address_1").val();
    let address_2 = $("#address_2").val();
      //<//InputFields>
    
    //<InputFieldHelper>
    let first_name_helper= $("#first_name_helper");
    let last_name_helper= $("#last_name_helper");
    let email_helper = $("#email_helper");
    let password_helper=$("#password_helper");
    let mobNum_helper=$("#mobile_number_helper");
    let address1_helper=$("#address1_helper");
    let address2_helper =$("#address2_helper");
    /*<//InputFieldHelper>*/
    
    
    
    //isNan = Is Not A Number 
    
    
    if(first_name!="")
   {
       if(!isNaN(first_name))
        { 
            first_name_helper.html("<b class='text-danger'>Name can not be a number</b>");
            //$("#first_name").focus();
           $("#first_name").css("border-color","red").focus(); 

            return false; 
            
        }
    else { 
        first_name_helper.html("<b class='text-success'>Ok</b>");
    }
       
   }
    else { 
        first_name_helper.html("<b class='text-danger'>Please enter your first Name</b>");
       $("#first_name").css("border-color","red").focus(); 
             
        return false; 
    }
    
    
    if(last_name!="")
   {
       if(!isNaN(last_name))
        { 
            last_name_helper.html("<b class='text-danger'>Name can not be a number</b>");
                   $("#last_name").css("border-color","red").focus(); 

            return false; 
            
        }
    else { 
        last_name_helper.html("<b class='text-success'>Ok</b>");
    }
       
   }
    else { 
        last_name_helper.html("<b class='text-danger'>Please enter your last Name</b>");
                  $("#last_name").css("border-color","red").focus(); 

        return false; 
    }
    
     if(email=="")
   { 
        email_helper.html("<b class='text-success'>Please enter your email</b>");
       $("#email").css("border-color","red").focus(); 

        return false;   
       
   }
   
    
    
   if(password!="")
   {
       if(password.length <5)
           { 
               password_helper.html("<b class='text-danger'>Too low</b>");
                $("#password").css("border-color","red").focus(); 
               
               return false; 
           }
           if(password.length >10)
           { 
               password_helper.html("<b class='text-success'>Ok</b>");
           }
       
   }
    else { 
        password_helper.html("<b class='text-danger'>Please enter the password</b>");
        $("#password").css("border-color","red").focus(); 

        return false;
    }
    
    
    if(mobile!="")
        {
         if(isNaN(mobile))
             { 
              mobNum_helper.html("<b class='text-danger'>Mobile number can not contain letters</b>");
                 $("#mobile").css("border-color","red").focus(); 
       
                 return false; 
             }
            else {
               if(mobile.length==10)
                { 
                mobNum_helper.html("<b class='text-success'>Ok</b>");
                    
                }
                else { 
                    mobNum_helper.html("<b class='text-danger'>Mobile number should be 10 digits</b>")
                        $("#mobile").css("border-color","red").focus(); 
                     return false; 
                }
                
            }
        }
    else { 
        mobNum_helper.html("<b class='text-danger'>Please Enter the mobile number</b>");
       $("#mobile").css("border-color","red").focus(); 
        
        return false; 
    }
    
    
    if(address_1=="")
        { 
        address1_helper.html("<b class='text-danger'>Please enter the address</b>");
       $("#address_1").css("border-color","red").focus(); 
            
            return false; 
        }
    
    if(address_2=="")
        { 
            address2_helper.html("<b class='text-danger'>Please enter the address</b>");
           $("#address_1").css("border-color","red").focus(); 
              return false; 
        }
    
    
    
    
}
    //This funtion is used to prevent the form from submitting and check the entered value if they are validated.
    $("#loginForm").on('submit',function(event){
        event.preventDefault(); //Prevent the form from submitting
        let email=$("#loginEmail").val();
        let password=$("#loginPassword").val();
 
          if(email!="" || password!="")
              {
                  $.ajax({
                     url:"login.php",
                     method:"POST",
                     data:{email:email, password:password},
                     success:function(data)
                      {
                          //When the login ends up successfully..
                         if(data=="success")
                             {
                                   
                                 window.location.href="index.php";
                               
                               
                             }
                           else {
                               //when login goes wrong......
                               $("#loginMessage").html("<b class='text-danger'>Email or password is incorrect</b>");
                                $("#loginEmail").focus();
                                $("#loginEmail,#loginPassword").css("border-color","red");
                           }
                      }
                      
                  });
              }
        
        else {
            //When user enters nothing......
            $("#loginMessage").html("All fields are mandatory");
              $("#loginEmail").focus();
              $("#loginEmail,#loginPassword").css("border-color","red");


        }
        
    })
    
    
        //Whenever the data is entered into the ("#email) field. It will send it to the server for checking If it exist.
    $("#email").keyup(checkEmail);

    function checkEmail()
    {
        let email=$(this).val();
         $.ajax({
           url:"action.php",
          method:"POST",
          data:{checkEmail:1,myemail:email},
          success:function(data)
            {
                $("#email_helper").html(data);
                 
            }
        });
        
    }
  
    
    
     //We are taking the text in {#email_helper} and convert into lowercase for comparing;
     
     /*
     Logic: When the text in the span tag with the id("#email_helper") is not equal to "Ok", it won't let the signUp modal be submitted. If the text in the span tag is Ok. It means The email does not exist.
     */
 $("#signUpForm").on('submit',function(event){
      
    
    let emailHelper=$("#email_helper").text().toLowerCase();
     if(emailHelper!="ok")
        {
            $("#email").css("border-color",'red');
            $("#email").focus();
            return false; 
        }
     else {
           $("#email").css("border-color",'none');
     }
     
      
     
     
 })   
    
    //This function is used to pevent the form submitting and check if entered value is valid. 
    $("#passwordChangeModal").on('submit',function(event){
        event.preventDefault();
       
        let oldPassword=$("#oldPassword"); 
        let newPassword=$("#newPassword");
        let confirmPassword=$("#confirmPassword");
        
        if(oldPassword.val()=="")
            {
                oldPassword.css("border-color","red").focus();
                $("#change_password_message").html("<b class='text-danger'>All fields are mandatory</b>");
                return false; 
            }
        else if(newPassword.val()=="")
            {
                newPassword.css("border-color","red").focus();
                $("#change_password_message").html("<b class='text-danger'>All fields are mandatory</b>");
                  return false; 
            }
        else if(newPassword.val()==oldPassword.val())
            {
                newPassword.css("border-color","red").focus();
                $("#newPasswordMessage").html("New password should not match with old password");
                return false; 
            }
        else if(newPassword.val().length < 10)
            {
                $("#newPasswordMessage").html("Weak password.");
                newPassword.css("border-color","red").focus();
                return false; 
            }
        else if(confirmPassword.val()=="")
            {
                confirmPassword.css("border-color","red").focus();
               $("#change_password_message").html("<b class='text-danger'>All fields are mandatory</b>");
                  return false; 
            }
        
        else if(newPassword.val()!=confirmPassword.val())
                {
                  $("#confirmPasswordMessage").html("Confirm Password doesn't match with new password");
                  confirmPassword.css("border-color",'red').focus();
                    
                    return false; 
                }
        else {
              $.ajax({
                 url:"changePassword.php",
                 method:"POST",
                 data:{oldPassword:oldPassword.val(),newPassword:newPassword.val(),confirmPassword:confirmPassword.val()},
                 success:function(data)
                  {
                      if(data=="mismatch_old_passowrd")
                          {
                              $("#MessageForOldPassword").html("Incorrect Old password....");
                              oldPassword.css("border-color","red").focus();
                              return false; 
                          }
                      else {
                        window.location.href="index.php";
                      }
                  }
              });
        }
        
        
          
        
    })
    //This function is executed when the password changes successfully, 
    changePasswordMesage();
    function changePasswordMesage()
    {
        let changePasswordMessage=$("#changePasswordFinalMessage").val();
        if(changePasswordMessage=="1")
            {
                 $("#warningModalInformation").html("<span class='text-primary'>Password successfully changed.</span>");
                $("#warningModal").modal('show');
            }
    }
    
    //These function is used to prevent the user from typing unwanted characters in quantity field.
    $(".qty").keydown(function(e){
       
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
      
       
        
    });
    
    subTotal();
    //This function is used to show the subtotal from database. 
    function subTotal()
    {
     
        
        $.ajax({
           url:"action.php",
            method:"POST",
            data:{accessSubTotal:1},
            success:function(data)
            {
             $(".subTotal").html(data);
             $('#subTotal').attr('total',data);
            }
        });
    }
    
    
    
    $(".qty").keyup(function(){
        
        let myquantity=$(this).val();
        let productPrice=$(this).attr('pr');
         
        
       
        $(".updatePrice").attr('qty',myquantity);
    })
    
     
   
      function loadTable(){
          
      }
    
    
    //When the update button clicks
    $(".updatePrice").click(function(){
 
        let price=$(this).attr('price'); //We are retrieving price from attriubute of update button
        let qty=$(this).attr('qty');
        let productId=$(this).attr('pid');
        
        
       //If the quantity is nothing or equal to 0 or lesser than 0, it will automatically convert it into 1;
        if(qty=="" || qty <=0 || qty.charAt(0)==0)
            {
                qty=1; 
            }
            
         
          $.ajax({
                   url:"action.php",
                   method:"POST",
                   data:{activeCart:1, qty:qty,productId:productId,selectedItemPrice:price},
                   success:function(data)
                    {
                        $("#cartMessage").html(data);
                         hideAlertMessage();
                          subTotal();
                       loadTable();
                        
                        
                    }
                });
                
        
    })
    
      //This function hides the message from cart.php after passing 1000 milliseconds.
    //This function is called right after the alert message appears in card.php
    function hideAlertMessage()
    {
        $(".alert").fadeIn(1).delay(1000).fadeOut(500);
    }
    
    
    //When the remove button clicks, it will take the product id from button by using attribute and will be sent to action.php for communicating with database 
    // "deleteItemEnable:1" is also sent to only enable the function in action.php 
    $('.removeItem').click(function(){
        let deleteItemId=$(this).attr('deleteId');
       
        
        $.ajax({
            url:"action.php",
            method:"POST",
            data:{deleteItemEnable:1,deleteItemId:deleteItemId},
            success:function(data)
            {
                location.reload();
                 subTotal();
                  $("#cartMessage").html(data);

                hideAlertMessage();
            }
        })
        
        
        
    })
    
    //This is in card.php by which user can delete all the selected items from cart in one click.
    
    $('.emptycart').click(function(){
       
        $.ajax({
            url:"action.php",
            method:"POST",
            data:{activeEmptyCart:1},
            success:function(data)
            {
                if(data=="yes")
                    {
                        location.reload();
                    }
                else {
                    $("#cartMessage").html(data);
                }
            }
        })
        
        
    })
    
     
    //This indicates checkout button with paypal
    $("#finalCheckout").click(function(event){
      
        $.ajax({
            url:"action.php",
            method:"POST",
            data:{enableFinalCheckOut:1},
            success:function(data)
            {
               if(data="no")
                   {
                       $("#cartMessage").html('<b class="text-danger">Could not check out</b>');
                       return false; 
                   }
            }
        })
        
    })
    
    
    
    //Main document finishes here
})
 
 

