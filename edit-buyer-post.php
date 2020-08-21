<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/validation.min.js"></script>
<script src="js/edit-buyer-post.js"></script>
<?php
require_once  'dbconfig.php';
include_once 'functions.php';
if(isset( $_SERVER['HTTP_X_REQUESTED_WITH']) && isset($_GET['id'])){
    $postID = checkValues($_GET['id']);
    $html = '';
    $post_search = mysqli_query($con, "SELECT * FROM buyer_market WHERE b_m_id = '$postID'");
    if($post_search){
        $postRow = mysqli_fetch_array($post_search);
       ?>
        <form id="productForm">
            <div id="buyerProductError">

            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="form-signin">
                        <h4 class="text-center">Set Deadline</h4>
                        <div class="col-sm-4">
                            <select name="durationDay" id="durationDay" class="form-control" required>
                                <option value="<?php echo  $postRow['deadline_day'] ?>" selected><?php echo $postRow['deadline_day'] ?></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <select  class="form-control" id="durationMonth" name="durationMonth" required>
                                <option value="<?php echo $postRow['deadline_month']?>"  selected><?php echo $postRow['deadline_month']?></option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <select  class="form-control" id="durationYear" name="durationYear" required>
                                <option value="<?php echo $postRow['deadline_year'] ?>"  selected><?php echo $postRow['deadline_year'] ?></option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                            </select>
                        </div>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="form-signin">
                        <h4 class="text-center">Quantity</h4>
                        <p class="help-block text-center">Please add the unit of measurement eg. kilos, bags, boxes</p>
                        <input type="text" name="productQuantity" class="form-control" id="productQuantity" value="<?php echo $postRow['quantity'] ?>" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-signin">
                    <h4 class="text-center">Description</h4>
                    <textarea class="form-control" rows="10" name="productDescription" id="productDescription" required><?php echo $postRow['description'] ?></textarea>
                </div>
            </div>

            <input type="hidden" value="<?php echo $postID ?>" name="postId" required>

            <button style="margin: 20px" type="submit" class="btn btn-primary pull-right" name="submitBuyerProduce" id="submitBuyerProduce">
                <span class="fa fa-send-o"></span> &nbsp; post
            </button>
        </form>

<?php
    }
    else{
        $html .= '<div class="alert alert-danger">';
        $html .= '<p class="text-center">';
        $html .= '<span class="fa fa-exclamation-triangle"></span>';
        $html .= '&nbsp; A query error occurred. Please try again later.';
        $html .= '</p>';
        $html .= '</div>';
        echo $html;
    }
}
else{
    echo 'Parse error. Please try again later';
}
