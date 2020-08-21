$(document).ready(function () {
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
            type: 'get',
            url: 'submit-buyer-product.php',
            data: data,
            beforeSend: function () {
                errorDiv.fadeOut(800);
                button.html('<span class="fa fa-spin fa-spinner">').attr('disabled','disabled');
            },
            success: function (data) {
                if(data == 'inserted'){
                    button.html(buttonHtml).removeAttr('disabled');
                    errorDiv.html('<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Post added successfully</div>');
                    errorDiv.fadeIn(800);
                    productForm.trigger('reset');
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
                    var item = $(data).hide().fadeIn(1000);
                    $('#append-new-post').prepend(item);
                    productForm.trigger('reset');
                    button.html(buttonHtml).removeAttr('disabled');
                }
            },
            error: function (e) {
                alert(e+' please check your internet connection');
            }
        });

        return false;
    }

    $('.update').on('click',function () {
        var updateId = $(this).attr('id').replace(/update-/,'');
        var button = $('#update-'+updateId);
        $.ajax({
            url: 'edit-buyer-post.php?id='+updateId,
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
            url: 'delete-buyer-post.php?id='+id,
            type: 'get',
            beforeSend: function () {
                button.html('<span class="fa fa-spin fa-spinner"></span> Please wait..').attr('disabled','disabled');
            },
            success: function (data) {
                if(data == 'deleted'){
                    errorDiv.html('<div class="alert alert-success"><h4 class="text-center"><span class="fa fa-check"></span> Post deletion successful. Please wait...</h4></div>');
                    errorDiv.fadeIn(800);
                    window.setTimeout(function () {
                        window.location.href='buyer-dashboard.php';
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
                else if(data = 'noSession'){
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

    $('.unreadBids').on('click',function (e) {
        var buyerId = $(this).attr('id').replace(/unreadBids-/,'');
        e.preventDefault();
        $.ajax({
            url: 'update-read.php?bid='+buyerId,
            type: 'get',
            success: function () {
              $('.badge').addClass('hidden');
                $('.unreadBids').removeClass('unreadBids');
            },
            error: function (e) {
                alert(e+' please check your internet connection');
            }
        })
    });


});