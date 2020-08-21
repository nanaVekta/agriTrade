<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/validation.min.js"></script>
<script>
    $(document).ready(function () {

        var farmLocationForm = $('#farmLocationForm');

        farmLocationForm.validate({
            rules:
            {
                farmLocationTown: {
                    required: true,
                    minlength: 2
                },
                farmLocationDistrict: {
                    required: true,
                    minlength: 2
                },
                farmLocationRegion:{
                    required: true
                }
            },
            messages:
            {
                farmLocationTown:{
                    required: "please provide name of town",
                    minlength: "should be at least 2 characters"
                },
                farmLocationDistrict:{
                    required: "please provide name of district",
                    minlength: "should be at least have 2 characters"
                },
                farmLocationRegion:"select region"
            },
            submitHandler: submitFarmLocationForm
        });
        function submitFarmLocationForm(){
            var data = farmLocationForm.serialize();
            var errorDiv = $('#farmLocationError');
            var button = $('#farmerLocationSubmit');
            var buttonHtml = '<span class="fa fa-arrow-right"></span> &nbsp;Next';


            $.ajax({
                type : 'get',
                url  : 'submit-farm-location.php',
                data : data,
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
                            errorDiv.html('<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Info added successfully. <a data-toggle="modal" style="cursor: pointer" data-target="#loginModal" data-dismiss="modal">Click here</a> to log-in</div>');
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

                    else if(data=='noData'){

                        errorDiv.fadeIn(1000, function(){

                            errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> &nbsp; Input all fields of the form</div>');

                            button.html(buttonHtml).removeAttr('disabled');

                        });

                    }

                    else if(data=='noSession'){

                        errorDiv.fadeIn(1000, function(){

                            errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> &nbsp; Error: No session found</div>');

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
                error : function (e) {
                    button.html(buttonHtml);
                    alert(e+" Please check your internet connection")
                }

            });
            return false;
        }
    });
</script>
<form class="form-signin center-block" id="farmLocationForm">
    <h3 class="text-center form-signin-heading">Farm's Location</h3>

    <hr>

    <div id="farmLocationError">

    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-users"></i> </span>
            <input type="text" class="form-control" id="farmLocationTown" name="farmLocationTown" placeholder="Town" required>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map-marker"></i> </span>
            <input type="text" class="form-control" id="farmLocationDistrict" name="farmLocationDistrict" placeholder="District" required>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-area-chart"></i> </span>
            <select  class="form-control" id="farmLocationRegion" name="farmLocationRegion" required>
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
        <button type="submit" class="btn btn-primary pull-right" id="farmerLocationSubmit" name="farmerLocationSubmit"><span class="fa fa-sign-in"></span> &nbsp;Sign Up</button>
    </div>
</form>
