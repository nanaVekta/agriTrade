$(document).ready( function( $ ) {

    $( '.initiate-swipe' ).click( function(e) {
        var mId = $(this).attr('id').replace(/swipe-/,'');

        /*for( var i = 0; i < total; i++){
            var image = new Array(total);
            image[i] = $('.swipe-class-'+i+'-'+mId).attr('src');
        }*/

        $.swipebox(imgs(mId));
        e.preventDefault();
    });


        function imgs(id) {
            var total = $('#num-'+id).val();
            var arr = [];

            for( var i = 0; i < total; i++){
                var obj = {};
                obj['href'] = $('.swipe-class-'+i+'-'+id).attr('src');
                arr.push(obj);
        }

        return arr;
    }

} );