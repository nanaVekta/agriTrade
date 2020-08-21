$(document).ready(function () {
    $('#pic-file').on('change', function () {
        $('#append-value').html('');
        var fileList = $('#pic-file')[0].files;
        for(var i = 0; i < fileList.length; i++){
            var picName = fileList[i].name;
            $('#append-value').append('<div class="panel" style="color: #333; background-color: #f5f5f5; padding: 5px"><div id="pic-val">'+picName+'</div></div>')
        }
    });

    var productForm = $('#farmerProductForm');
    productForm.validate({
        rules: {
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
            productQuantity: {
                required:'input quantity',
                minlength: 'should be more than 3 characters'
            },
            productDescription: {
                required:'input product description',
                minlength: 'should be more than 5 characters'
            }
        },
        submitHandler: submitFarmerProduce
    });
    function submitFarmerProduce () {
        var errorDiv = $('#farmerProductError');
        var button = $('#submitFarmerProduce'), buttonHtml = '<span class="fa fa-send-o"></span> &nbsp; post';
        var formData = new FormData();
        formData.append('productQuantity',$('#productQuantity').val());
        var fileList = $('#pic-file')[0].files;
        for(var i = 0; i < fileList.length; i++) {
            formData.append('file[]', $('#pic-file')[0].files[i]);
        }
        formData.append('productDescription',$('#productDescription').val());
        formData.append('postId',$('#postId').val());
        $.ajax({
            url: 'update-farmer-product.php',
            type:'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                errorDiv.fadeOut(800);
                button.html('<span class="fa fa-spin fa-spinner"></span> posting').attr('disabled','disabled');
            },
            success: function (data) {
                if(data == 'large'){
                    button.html(buttonHtml).removeAttr('disabled');
                    errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> File size too large</div>');
                    errorDiv.fadeIn(800);
                }
                else if(data == 'inserted'){
                    button.html(buttonHtml).removeAttr('disabled');
                    errorDiv.html('<div class="alert alert-success"><span class="fa fa-check"></span> Post update successful</div>');
                    errorDiv.fadeIn(800);
                    $('#farmerProductForm').trigger('reset');
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
                else if(data == 'error'){
                    button.html(buttonHtml).removeAttr('disabled');
                    errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> Sorry an error occurred while uploading images!</div>');
                    errorDiv.fadeIn(800);
                }
                else{
                    button.html(buttonHtml).removeAttr('disabled');
                    errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> Oops an unknown error occurred</div>');
                    errorDiv.fadeIn(800);
                }
            },
            error: function (e) {
                alert(e+' please check your internet connection');
            }
        });

        return false;
    }
});