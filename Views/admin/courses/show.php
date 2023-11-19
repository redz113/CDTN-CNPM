
<style>
    /* 
    Product detail
*/

/*****************globals*************/
body {
    font-family: 'open sans';
    overflow-x: hidden; }
  
  img {
    max-width: 100%; }
  
  .preview {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
        -ms-flex-direction: column;
            flex-direction: column; }
    @media screen and (max-width: 996px) {
      .preview {
        margin-bottom: 20px; } }
  
  .preview-pic {
    -webkit-box-flex: 1;
    -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
            flex-grow: 1; }
  
  .preview-thumbnail.nav-tabs {
    border: none;
    margin-top: 15px; }
    .preview-thumbnail.nav-tabs li {
      width: 18%;
      margin-right: 2.5%; }
      .preview-thumbnail.nav-tabs li img {
        max-width: 100%;
        display: block; }
      .preview-thumbnail.nav-tabs li a {
        padding: 0;
        margin: 0; }
      .preview-thumbnail.nav-tabs li:last-of-type {
        margin-right: 0; }
  
  .tab-content {
    overflow: hidden; }
    .tab-content img {
      width: 100%;
      -webkit-animation-name: opacity;
              animation-name: opacity;
      -webkit-animation-duration: .3s;
              animation-duration: .3s; }
  
  .card {
    margin-top: 50px;
    background: #eee;
    padding: 3em;
    line-height: 1.5em; }
  
  @media screen and (min-width: 997px) {
    .wrapper {
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex; } }
  
  .details {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
        -ms-flex-direction: column;
            flex-direction: column; }
  
  .colors {
    -webkit-box-flex: 1;
    -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
            flex-grow: 1; }
  
  .product-title, .price, .sizes, .colors {
    text-transform: UPPERCASE;
    font-weight: bold; }
  
  .checked, .price span {
    color: #ff9f1a; }
  
  .product-title, .rating, .product-description, .price, .vote, .sizes {
    margin-bottom: 15px; }
  
  .product-title {
    margin-top: 0; }
  
  .size {
    margin-right: 10px; }
    .size:first-of-type {
      margin-left: 40px; }
  
  .color {
    display: inline-block;
    vertical-align: middle;
    margin-right: 10px;
    height: 2em;
    width: 2em;
    border-radius: 2px; }
    .color:first-of-type {
      margin-left: 20px; }
  
  .add-to-cart, .like {
    background: #ff9f1a;
    padding: 1.2em 1.5em;
    border: none;
    text-transform: UPPERCASE;
    font-weight: bold;
    color: #fff;
    -webkit-transition: background .3s ease;
            transition: background .3s ease; }
    .add-to-cart:hover, .like:hover {
      background: #b36800;
      color: #fff; }
  
  .not-available {
    text-align: center;
    line-height: 2em; }
    .not-available:before {
      font-family: fontawesome;
      content: "\f00d";
      color: #fff; }
  
  .orange {
    background: #ff9f1a; }
  
  .green {
    background: #85ad00; }
  
  .blue {
    background: #0076ad; }
  
  .tooltip-inner {
    padding: 1.3em; }
  
  @-webkit-keyframes opacity {
    0% {
      opacity: 0;
      -webkit-transform: scale(3);
              transform: scale(3); }
    100% {
      opacity: 1;
      -webkit-transform: scale(1);
              transform: scale(1); } }
  
  @keyframes opacity {
    0% {
      opacity: 0;
      -webkit-transform: scale(3);
              transform: scale(3); }
    100% {
      opacity: 1;
      -webkit-transform: scale(1);
              transform: scale(1); } }
  
  /*# sourceMappingURL=style.css.map */
</style>
<div class="container">
    <div class="row">
        <h3 class="col float-left">Thông tin khóa học</h3>
        <a href="./?ctl=courses&page=<?php echo isset($_GET['page'])?$_GET['page']:1; ?>" class="d-inline-block btn btn-primary px-3 mr-2 float-right">Quản lý khóa học</a>
    </div>
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="<?php echo $course['fileUpload'] ?>" /></div>
						</div>
					</div>
					<div class="details col-md-6">
						<h3 class="product-title"><?php echo $course['name'] ?></h3>
						<p class="product-description"><?php echo $course['described'] ?></p>
                        <div class="rating">
							<span class="review-no">Lượt truy cập: <?php echo $course['interact'] ?></span> <br>
							<span class="review-no">Ngày tạo: 
                <?php 
                  $date = date_create($course['created_at']);
                  echo date_format($date, 'd/m/Y') 
                ?></span> <br>
              <!-- XXX -->
							<!-- <span class="review-no">Số bài giảng: 
                <?php //echo '<span class="text-primary">' . count($lessons) . '</span>'; ?>
              </span> -->
						</div>
						<h4 class="price">Giá bán: <span>
                            <?php 
                                if ($course['price'] == 0) {
                                    echo 'free';
                                }else{
                                    echo $course['price'] . ' VND';
                                }
                            ?>
                            </span>
                        </h4>
						<h5 class="sizes">Yêu Cầu:
                            <?php echo $course['inputs'] ?>
						</h5>
                    
						<h5 class="colors">Tags:
              <?php
                  $tags = explode(' ', trim($course['tags']));
                  foreach ($tags as $tag) {
                      if(empty($tag)) continue;
                      echo '<strong class="badge badge-primary m-1 px-1">' . trim($tag) .'</strong>';
                  }
              ?>
						</h5>
					</div>
				</div>
			</div>

      <div class="row mt-3">
        <div class='col-sm-auto m-1 px-2 badge text-uppercase'>
          <h5 class="m-0">Bài giảng</h5>
        </div>
        <?php
          if(empty($lessons)){
            echo "<div class='col-sm-auto m-1 px-2 badge badge-pill badge-danger'>
                    <h5 class='m-0'>Khóa học chưa có bài giảng</h5>
                  </div>";
          }else{
            foreach ($lessons as $lesson) {
            echo "<div class='col-sm-auto m-1 px-2 badge badge-pill badge-info'>
                    <a class='text-dark h5' href='./?ctl=lessons&act=show&id=" . $lesson['id'] . "'>" . $lesson['name'] . "</a>
                  </div>";
            }
          }
        ?>

        <div class="col-12"></div>
        <div class='col-sm-auto m-1 px-2 badge text-uppercase'>
          <h5 class="m-0">Bài tập</h5>
        </div>
        <?php
          if(empty($exercises)){
            echo "<div class='col-sm-auto m-1 px-2 badge badge-pill badge-danger'>
                    <h5 class='m-0'>Khóa học chưa có bài tập</h5>
                  </div>";
          }else{
            foreach ($exercises as $exercise) {
            echo "<div class='col-sm-auto m-1 px-2 badge badge-pill badge-warning'>
                    <a class='text-dark h5' href='./?ctl=exercises&act=show&id=" . $exercise['id'] . "'>" . $exercise['name'] . "</a>
                  </div>";
            }
          }
        ?>
      </div>
		</div>
	</div>


