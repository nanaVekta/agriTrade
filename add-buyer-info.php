<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/validation.min.js"></script>
<script>
    $(document).ready(function () {
        var buyerSignUpForm = $('#buyerSignUpForm'), buyerDiv = $('#buyerSignUpDiv');

        buyerSignUpForm.validate({
            rules:
            {
                buyerSignUpFullName: {
                    required: true,
                    minlength: 5,
                    maxlength: 100
                },

                buyerSignUpUserName: {
                    required: true,
                    minlength: 5,
                    maxlength: 45
                },

                buyerSignUpPassword:{
                    required: true,
                    minlength: 8
                },
                buyerConfirmSignUpPassword:{
                    required: true,
                    equalTo: '#buyerSignUpPassword'
                },
                buyerContact: {
                    required: true,
                    minlength: 10,
                    maxlength: 16
                },
                buyerLocationTown: {
                    required: true,
                    minlength: 2
                },
                buyerLocationDistrict: {
                    required: true,
                    minlength: 2
                },
                buyerLocationRegion:{
                    required: true
                }
            },
            messages:
            {
                buyerSignUpFullName:{
                    required: "please provide your full name",
                    minlength: "name should be at least 5  characters",
                    maxlength: "name should be at most 100 characters"
                },
                buyerSignUpUserName:{
                    required: "please provide your user name",
                    minlength: "should be at least 5 characters",
                    maxlength: "should be at most 45 characters"
                },
                buyerSignUpPassword:{
                    required: "please enter your password",
                    minlength: "password should be at least 8 characters"
                },
                buyerConfirmSignUpPassword:{
                    required: "please confirm your password",
                    equalTo: "password do not match"
                },
                buyerContact:{
                    required: "please enter your contact number",
                    minlength: "should be at least 10 characters",
                    maxlength: "should be at most 16 characters"
                },
                buyerLocationTown:{
                    required: "please provide name of town",
                    minlength: "should be at least 2 characters"
                },
                buyerLocationDistrict:{
                    required: "please provide name of district",
                    minlength: "should be at least have 2 characters"
                },
                buyerLocationRegion:"select region"
            },
            submitHandler: submitBuyerSignUpForm
        });
        function submitBuyerSignUpForm(){
            var data = buyerSignUpForm.serialize();
            var errorDiv = $('#buyerSignUpError');
            var button = $('#buyerSubmitSignUp');
            var buttonHtml = '<span class="fa fa-sign-in"></span> &nbsp;Sign Up';


            $.ajax({
                type: 'get',
                url: 'submit-buyer-personal.php',
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
                            $('#loginDiv').load('buyer-login.php');
                            errorDiv.html('<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Info added successfully. <a data-toggle="modal" style="cursor: pointer" data-target="#loginModal" data-dismiss="modal">Click here</a> to log-in</div></div>');
                            //changes the content of the signUpButton to the original content
                            button.html(buttonHtml).removeAttr('disabled');
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
    });
</script>

<form class="form-signin center-block" id="buyerSignUpForm">
    <h3 class="text-center form-signin-heading">Buyer's Info</h3>

    <div id="buyerSignUpError">

    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><span class="fa fa-user"></span> </span>
            <input type="text" class="form-control" id="buyerSignUpFullName" name="buyerSignUpFullName" placeholder="Please input your full name" required>
        </div>
    </div>


    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><span class="fa fa-user"></span> </span>
            <input type="text" class="form-control" id="buyerSignUpUserName" name="buyerSignUpUserName" placeholder="Please input your username" required>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><span class="fa fa-key"></span> </span>
            <input type="password" class="form-control" id="buyerSignUpPassword" name="buyerSignUpPassword" placeholder="Please input your password" required>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><span class="fa fa-key"></span> </span>
            <input type="password" class="form-control" id="buyerConfirmSignUpPassword" name="buyerConfirmSignUpPassword" placeholder="Confirm your password" required>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><span class="fa fa-phone"></span> </span>
            <input type="text" class="form-control" id="buyerContact" name="buyerContact" placeholder="Enter Contact number" required>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-users"></i> </span>
            <input type="text" class="form-control" id="buyerLocationTown" name="buyerLocationTown" placeholder="Town" required>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map-marker"></i> </span>
            <input type="text" class="form-control" id="buyerLocationDistrict" name="buyerLocationDistrict" placeholder="District" required>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-area-chart"></i> </span>
            <select  class="form-control" id="buyerLocationRegion" name="buyerLocationRegion" required>
                <option value=""  selected disabled>--Select region--</option>
                <option value="Upper East Region">Upper East Region</option>
                <option value="Upper West Region">Upper West Region</option>
                <option value="Northern Region">Northern Region</option>
                <option value="Brong Ahafo Region">Brong Ahafo Region</option>
                <option value="Volta Region">Volta Region</option>
                <option value="Eastern Region">Eastern Region</option>
                <option value="Western Region">Western Region</option>
                <option value="Central Region">Central Region</option>
                <option value="Greater Accra Region">Greater Accra Region</option>
                <option value="Ashanti Region">Ashanti Region</option>
            </select>
        </div>
    </div>

    <hr>

    <div class="clearfix">
        <button type="submit" class="btn btn-primary pull-right" id="buyerSubmitSignUp" name="buyerSubmitSignUp"><span class="fa fa-sign-in"></span> &nbsp;Sign Up</button>
    </div>
</form>
