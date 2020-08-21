<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/validation.min.js"></script>
<script src="js/edit-post.js"></script>
<?php
require_once  'dbconfig.php';
include_once 'functions.php';
if(isset( $_SERVER['HTTP_X_REQUESTED_WITH']) && isset($_GET['id'])){
    $postID = checkValues($_GET['id']);
    $html = '';
    $post_search = mysqli_query($con, "SELECT * FROM farmer_market WHERE f_m_id = '$postID'");
    if($post_search){
        $postRow = mysqli_fetch_array($post_search);
        $html .= '<form enctype="multipart/form-data" id="farmerProductForm">';
            $html .= '<div id="farmerProductError">';

             $html .= '</div>';
                    $html .= '<div class="col-sm-6">';
                        $html .= '<div class="row">';
                            $html .= '<div class="form-signin">';
                                $html .= '<h4 class="text-center">Quantity</h4>';
                                $html .= '<p class="help-block text-center">Please add the unit of measurement eg. kilos, bags, boxes</p>';
                                $html .= '<input type="text" name="productQuantity" class="form-control" id="productQuantity" value="'.$postRow['quantity'].'" required>';
                                $html .= '<input type="hidden" name="postId" id="postId"  value="'.$postID.'" required>';
                            $html .= '</div>';
                        $html .= '</div>';
                        $html .= '<div class="row">';
                            $html .= '<div class="form-signin">';
                                $html .= '<h4 class="text-center">Add Pictures of product</h4>';
                                $html .= '<hr>';
                                $html .= '<label id="pic-label" for="pic-file" class="btn btn-primary"><i class="glyphicon glyphicon-folder-open"></i> &nbsp; browse</label>';
                                $html .= '<input  type="file" name="file[]" class="btn btn-file hidden" id="pic-file" multiple required><br>';
                               $html .= '<br>';
                                $html .= '<div class="row" id="append-value">';

                                $html .= '</div>';

                            $html .= '</div>';
                        $html .= '</div>';
                    $html .= '</div>';
                    $html .= '<div class="col-sm-6">';
                        $html .= '<div class="form-signin">';
                            $html .= '<h4 class="text-center">Description</h4>';
                            $html .= '<textarea class="form-control" rows="12" name="productDescription" id="productDescription" required>'.$postRow['description'].'</textarea>';
                        $html .= '</div>';
                    $html .= '</div>';

                    $html .= '<button style="margin: 20px" type="submit" class="btn btn-primary pull-right" name="submitFarmerProduce" id="submitFarmerProduce">';
                        $html .= '<span class="fa fa-send-o"></span> &nbsp; post';
                    $html .= '</button>';
                $html .= '</form>';
    }
    else{
        $html .= '<div class="alert alert-danger">';
        $html .= '<p class="text-center">';
        $html .= '<span class="fa fa-exclamation-triangle"></span>';
        $html .= '&nbsp; A query error occurred. Please try again later.';
        $html .= '</p>';
        $html .= '</div>';
    }

    echo $html;
}
else{
   echo 'Parse error. Please try again later';
}
