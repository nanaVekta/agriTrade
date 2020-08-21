<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/validation.min.js"></script>
<script>
    $(document).ready(function () {
        var buyerLoginForm = $('#buyerLoginForm');

        buyerLoginForm.validate({
            rules:
            {
                buyerUserName: {
                    required: true,
                    minlength: 5,
                    maxlength: 45
                },
                buyerUserPassword:{
                    required: true,
                    minlength: 8
                }
            },
            messages:
            {
                buyerUserName:{
                    required: "please provide your user name",
                    minlength: "should be at least 5 characters",
                    maxlength: "should be at most 45 characters"
                },
                buyerUserPassword:{
                    required: "please enter your password",
                    minlength: "password should be at least 8 characters"
                }
            },
            submitHandler: submitBuyerLoginForm
        });
        function submitBuyerLoginForm(){
            var data = buyerLoginForm.serialize();
            var errorDiv = $('#buyerLoginError');
            var button = $('#buyerSubmitLogin');
            var buttonHtml = '<span class="fa fa-send"></span> &nbsp;Log In';

            $.ajax({
                type: 'get',
                url: 'submit-buyer-login.php',
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
                                window.location.href='buyer-dashboard.php';
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

                            errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> &nbsp; '+data+'</div>');

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
<form class="form-signin center-block" id="buyerLoginForm">
    <h3 class="text-center form-signin-heading">Buyer's Login</h3>
    <div id="buyerLoginError">

    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><span class="fa fa-user"></span> </span>
            <input type="text" class="form-control" id="buyerUserName" name="buyerUserName" placeholder="Please input your username" required>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><span class="fa fa-key"></span> </span>
            <input type="password" class="form-control" id="buyerUserPassword" name="buyerUserPassword" placeholder="Please input your password" required>
        </div>
    </div>

    <hr>

    <div class="clearfix">
        <button type="submit" class="btn btn-primary pull-right" id="buyerSubmitLogin" name="buyerSubmitLogin"><span class="fa fa-send"></span> &nbsp;Log In</button>
    </div>

</form>
