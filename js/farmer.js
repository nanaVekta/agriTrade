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
        $.ajax({
            url: 'submit-farmer-product.php',
            type:'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                errorDiv.fadeOut(800);
                button.html('<span class="fa fa-spin fa-spinner"> posting').attr('disabled','disabled');
            },
            success: function (data) {
                if(data == 'large'){
                    button.html(buttonHtml).removeAttr('disabled');
                    errorDiv.html('<div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> File size too large</div>');
                    errorDiv.fadeIn(800);
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
                    var item = $(data).hide().fadeIn(1000);
                    $('#append-new-post').prepend(item);
                    productForm.trigger('reset');
                    $('#append-value').html('');
                    button.html(buttonHtml).removeAttr('disabled');
                }
            },
            error: function (e) {
                alert(e+' please check your internet connection');
            }
        });

        return false;
    }

    $('#dialogClose').on('click',function () {
       $('#dialog').fadeOut(1000);
    });

    $('.make-bid').on('click',function () {
       var bidId = $(this).attr('id').replace(/bid-/,'');
        var button = $('#bid-'+bidId);
        var buttonHtml = '<span class="fa fa-bullhorn"></span> bid';
        $.ajax({
            url: 'add-bid.php?bid='+bidId,
            type: 'get',
            beforeSend: function () {
                button.html('<span class="fa fa-spin fa fa-spinner"></span> making bid').attr('disabled','disabled');
            },
            success: function (data) {
                if(data == 'bid'){
                    button.html('<span class="fa fa-thumbs-up"></span> bid made');
                    $('#dialog').fadeIn(800);
                    setTimeout(function () {
                        $('#dialog').fadeOut(1000);
                    },2000);
                }
                else if(data == 'notBid'){
                    button.html(buttonHtml).removeAttr('disabled');
                    $('#error-dialog').html('<div class="alert alert-danger"><p class="text-center"><span class="fa fa-exclamation-triangle"> Sorry, your bid was not sent. Please try again later</span></p></div>');
                    setTimeout(function () {
                        $('#error-dialog').fadeOut(1000);
                    },2000);
                }
                else{
                    button.html(buttonHtml).removeAttr('disabled');
                    $('#error-dialog').html('<div class="alert alert-danger"><p class="text-center"><span class="fa fa-exclamation-triangle"> '+data+'</span></p></div>');
                    setTimeout(function () {
                        $('#error-dialog').fadeOut(1000);
                    },2000);
                }
            },
            error: function () {
                button.html(buttonHtml).removeAttr('disabled');
                alert('Please check your internet connection');
            }
        })
    });

    $('.update').on('click',function () {
       var updateId = $(this).attr('id').replace(/update-/,'');
        var button = $('#update-'+updateId);
        $.ajax({
            url: 'edit-post.php?id='+updateId,
            type: 'get',
            beforeSend: function () {
                button.html('<span class="fa fa-spin fa-spinner"></span> please wait..').attr('disabled','disabled');
            },
            success: function (data) {
                button.html('<span class="fa fa-edit"></span> edit').removeAttr('disabled');
                var item = $(data).hide().fadeIn(1000);
                $('#formDiv').html(item);
            },
            error:function (event) {
                alert(event+' please check your internet connection');
            }
        });
    });

    $('.delete').on('click',function(){
        var id = $(this).attr('id').replace(/delete-/,'');
        var button = $('#delete-'+id), buttonHtml= '<span class="fa fa-trash"></span> Delete';
        var errorDiv = $('#deleteModalDiv-'+id);
        $.ajax({
            url: 'delete-post.php?id='+id,
            type: 'get',
            beforeSend: function () {
                button.html('<span class="fa fa-spin fa-spinner"></span> Please wait..').attr('disabled','disabled');
            },
            success: function (data) {
                if(data == 'deleted'){
                    errorDiv.html('<div class="alert alert-success"><h4 class="text-center"><span class="fa fa-check"></span> Post deletion successful. Please wait...</h4></div>');
                    errorDiv.fadeIn(800);
                    window.setTimeout(function () {
                        window.location.href='farmer-dashboard.php';
                    },1000)
                }
                else if(data == 'notDeleted'){
                    button.html(buttonHtml);
                    errorDiv.html('<div class="alert alert-danger"><h4 class="text-center"><span class="fa fa-exclamation-triangle"></span> Post deletion unsuccessful.</h4></div>');
                    errorDiv.fadeIn(800);
                }
                else if(data = 'noId'){
                    button.html(buttonHtml);
                    errorDiv.html('<div class="alert alert-danger"><h4 class="text-center"><span class="fa fa-exclamation-triangle"></span> Parse error. Please use the right approach</h4></div>');
                    errorDiv.fadeIn(800);
                }
                else if(data = 'noId'){
                    button.html(buttonHtml);
                    errorDiv.html('<div class="alert alert-danger"><h4 class="text-center"><span class="fa fa-exclamation-triangle"></span> Session expired. Please refresh page</h4></div>');
                    errorDiv.fadeIn(800);
                }
                else{
                    button.html(buttonHtml);
                    errorDiv.html('<div class="alert alert-danger"><h4 class="text-center"><span class="fa fa-exclamation-triangle"></span> '+data+'</h4></div>');
                    errorDiv.fadeIn(800);
                }
            }

        })
    });
});