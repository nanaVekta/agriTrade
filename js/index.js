$(document).ready(function(){
   $('#serviceLink').on('click',function(){
       $('.link').removeClass('active');
       $('#serviceLink').addClass('active');
   }) ;

    $('#aboutLink').on('click',function(){
        $('.link').removeClass('active');
        $('#aboutLink').addClass('active');
    }) ;

    var farmerSignUpForm = $('#farmerSignUpForm'), farmerDiv = $('#farmerSignUpDiv');

    farmerSignUpForm.validate({
        rules:
        {
            farmerSignUpFullName: {
                required: true,
                minlength: 5,
                maxlength: 100
            },

            farmerSignUpUserName: {
                required: true,
                minlength: 5,
                maxlength: 45
            },

            farmerSignUpPassword:{
                required: true,
                minlength: 8
            },
            farmerConfirmSignUpPassword:{
                required: true,
                equalTo: '#farmerSignUpPassword'
            },
            farmerSignUpGender:{
                required: true
            },
            farmerContact: {
                required: true,
                minlength: 10,
                maxlength: 16
            }
        },
        messages:
        {
            farmerSignUpFullName:{
                required: "please provide your full name",
                minlength: "name should be at least 5  characters",
                maxlength: "name should be at most 100 characters"
            },
            farmerSignUpUserName:{
                required: "please provide your user name",
                minlength: "should be at least 5 characters",
                maxlength: "should be at most 45 characters"
            },
            farmerSignUpPassword:{
                required: "please enter your password",
                minlength: "password should be at least 8 characters"
            },
            farmerConfirmSignUpPassword:{
                required: "please confirm your password",
                equalTo: "password do not match"
            },
            farmerSignUpGender:"select gender",
            farmerContact:{
                required: "please enter your contact number",
                minlength: "should be at least 10 characters",
                maxlength: "should be at most 16 characters"
            }
        },
        submitHandler: submitFarmerSignUpForm
    });
    function submitFarmerSignUpForm(){
        var data = farmerSignUpForm.serialize();
        var errorDiv = $('#farmerSignUpError');
        var button = $('#farmerSubmitSignUp');
        var buttonHtml = '<span class="fa fa-arrow-right"></span> &nbsp;Next';


        $.ajax({
            type: 'get',
            url: 'submit-farmer-peronal.php',
            data: data,
            beforeSend: function()
            {
                //hide error div and change the content inside the Button
                errorDiv.fadeOut();
                button.html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...').attr('disabled','disabled');
            },
            success :  function(data) {
                if(data=="inserted") {
                    //show signUpError div after 1 second
                    errorDiv.fadeIn(1000, function(){
                        //shows the user a success message
                        errorDiv.html('<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Info added successfully. Please Wait....</div>');
                        //changes the content of the signUpButton to the original content
                        button.html(buttonHtml).removeAttr('disabled');
                        window.setTimeout(function(){
                            farmerDiv.load('add-farmer-location.php');
                        },1000)
                    });
                }

                else if(data=='notInserted'){

                    errorDiv.fadeIn(1000, function(){

                        errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> &nbsp; Could not insert data, please try again later!</div>');

                        button.html(buttonHtml).removeAttr('disabled');

                    });

                }

                else if(data=='exist'){

                    errorDiv.fadeIn(1000, function(){

                        errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> &nbsp; Username is linked to an account!</div>');

                        button.html(buttonHtml).removeAttr('disabled');

                    });

                }

                else if(data=='notSame'){

                    errorDiv.fadeIn(1000, function(){

                        errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> &nbsp; Passwords do not match</div>');

                        button.html(buttonHtml).removeAttr('disabled');

                    });

                }

                else if(data=='noData'){

                    errorDiv.fadeIn(1000, function(){

                        errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> &nbsp; Input all fields of the form</div>');

                        button.html(buttonHtml).removeAttr('disabled');

                    });

                }

                else{

                    errorDiv.fadeIn(1000, function(){

                        errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> &nbsp; Oops an error occurred. Please try again later</div>');

                        button.html(buttonHtml).removeAttr('disabled');

                    });

                }
            },
            error : function (data) {
                button.html(buttonHtml).removeAttr('disabled');
                alert(data+" Please check your internet connection")
            }

        });
        return false;
    }

    $('#loadBuyerSignUp').on('click',function () {
        farmerDiv.html('<h1 class="text-center" style="margin-top: 30px"><span class="fa fa-spin fa-spinner"></span> </h1>');
        window.setTimeout(function () {
            farmerDiv.load('add-buyer-info.php');
            $('#signUpFooter').html('');
        },500);
    });

    var farmerLoginForm = $('#farmerLoginForm');

    farmerLoginForm.validate({
        rules:
        {
            farmerUserName: {
                required: true,
                minlength: 5,
                maxlength: 45
            },
            farmerUserPassword:{
                required: true,
                minlength: 8
            }
        },
        messages:
        {
            farmerUserName:{
                required: "please provide your user name",
                minlength: "should be at least 5 characters",
                maxlength: "should be at most 45 characters"
            },
            farmerUserPassword:{
                required: "please enter your password",
                minlength: "password should be at least 8 characters"
            }
        },
        submitHandler: submitFarmerLoginForm
    });
    function submitFarmerLoginForm(){
        var data = farmerLoginForm.serialize();
        var errorDiv = $('#farmerLoginError');
        var button = $('#farmerSubmitLogin');
        var buttonHtml = '<span class="fa fa-send"></span> &nbsp;Log In';

        $.ajax({
            type: 'get',
            url: 'submit-farmer-login.php',
            data: data,
            beforeSend: function()
            {
                //hide error div and change the content inside the Button
                errorDiv.fadeOut();
                button.html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...').attr('disabled','disabled');
            },
            success :  function(data) {
                if(data=="logged") {
                    //show signUpError div after 1 second
                    errorDiv.fadeIn(1000, function(){
                        //changes the content of the signUpButton to the original content
                        button.html('<span class="fa fa-spin fa-spinner"></span> Logging In...');
                        window.setTimeout(function(){
                            window.location.href='farmer-dashboard.php';
                        },1000)
                    });
                }

                else if(data=='error'){

                    errorDiv.fadeIn(1000, function(){

                        errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> &nbsp; Password and username combination do not match!</div>');

                        button.html(buttonHtml).removeAttr('disabled');

                    });

                }

                else if(data=='queryError'){

                    errorDiv.fadeIn(1000, function(){

                        errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> &nbsp; A query error occurred. Please try again later!</div>');

                        button.html(buttonHtml).removeAttr('disabled');

                    });

                }

                else if(data=='noData'){

                    errorDiv.fadeIn(1000, function(){

                        errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> &nbsp; Input all fields of the form</div>');

                        button.html(buttonHtml).removeAttr('disabled');

                    });

                }

                else{

                    errorDiv.fadeIn(1000, function(){

                        errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> &nbsp; Oops sorry an error occurred</div>');

                        button.html(buttonHtml).removeAttr('disabled');

                    });

                }
            },
            error : function (data) {
                button.html(buttonHtml).removeAttr('disabled');
                alert(data+" Please check your internet connection")
            }

        });
        return false;
    }


    var loginDiv = $('#loginDiv');
    $('#loadBuyerLogin').on('click',function () {
        loginDiv.html('<h1 class="text-center" style="margin-top: 30px"><span class="fa fa-spin fa-spinner"></span> </h1>');
        window.setTimeout(function () {
            loginDiv.load('buyer-login.php');
            $('#loginFooter').html('');
        },500);
    });
});
