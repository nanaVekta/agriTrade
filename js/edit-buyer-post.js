var productForm = $('#productForm');
productForm.validate({
    rules: {
        durationDay: {
            required: true
        },
        durationMonth: {
            required: true
        },
        durationYear: {
            required: true
        },
        productQuantity: {
            required: true,
            minlength: 3
        },
        productDescription: {
            required: true,
            minlength: 5
        }
    },
    messages: {
        durationDay: 'select day',
        durationMonth: 'select month',
        durationYear: 'select year',
        productQuantity: {
            required:'input quantity needed',
            minlength: 'should be more than 3 characters'
        },
        productDescription: {
            required:'input product description',
            minlength: 'should be more than 5 characters'
        }
    },
    submitHandler: submitBuyerProduce
});
function submitBuyerProduce () {
    var data = productForm.serialize(), errorDiv = $('#buyerProductError');
    var button = $('#submitBuyerProduce'), buttonHtml = '<span class="fa fa-send-o"></span> &nbsp; post';
    $.ajax({
        url: 'update-buyer-product.php',
        type: 'POST',
        data: data,
        beforeSend: function () {
            errorDiv.fadeOut(800);
            button.html('<span class="fa fa-spin fa-spinner">').attr('disabled','disabled');
        },
        success: function (data) {
            if(data == 'inserted'){
                button.html(buttonHtml).removeAttr('disabled');
                errorDiv.html('<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Post edited successfully. Please wait...</div>');
                errorDiv.fadeIn(800);
                window.setTimeout(function () {
                    window.location.href = 'buyer-dashboard.php'
                },1500);
            }
            else if(data == 'notInserted'){
                button.html(buttonHtml).removeAttr('disabled');
                errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> Sorry, posting unsuccessful. Please try again later</div>');
                errorDiv.fadeIn(800);
            }
            else if(data == 'expired'){
                button.html(buttonHtml).removeAttr('disabled');
                errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> Session expired. Please log out and log in again</div>');
                errorDiv.fadeIn(800);
            }
            else if(data == 'exist'){
                button.html(buttonHtml).removeAttr('disabled');
                errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> Post already exist!</div>');
                errorDiv.fadeIn(800);
            }
            else if(data == 'noData'){
                button.html(buttonHtml).removeAttr('disabled');
                errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> Please input all form fields!</div>');
                errorDiv.fadeIn(800);
            }
            else{
                button.html(buttonHtml).removeAttr('disabled');
                errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> Sorry an unknown error occurred</div>');
                errorDiv.fadeIn(800);
            }
        },
        error: function (e) {
            alert(e+' please check your internet connection');
        }
    });

    return false;
}