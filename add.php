<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>
<?php

require_once('./model/product.php');
require_once('./upload.php');
require_once('./model/category.php');

if (isset($_SESSION['success'])) {
    unset($_SESSION['success']);
}

if (isset($_FILES['files']) && isset($_POST['submit'])) {
    $products = new Product();
    //check file upload
    $upload = new upload();
    $src = $upload->multiupload();
    $uploadContentImg = new upload();
    $srcOfContent = $uploadContentImg->uploadImgOfContent(3);
    // print_r($src);
    if ($src != null) { //upload funtion return
        $count = $products->insert($_POST, $src, $srcOfContent);
        if ($count == 1) {
            $_SESSION['success'] = 'Thêm thành công';
        }
    }
}

// get cate to show on select
$cate = new Cate();
$listcate = $cate->getAllnoLimit();
?>

<body>
    <br>
    <a href="./index.php" style="padding: 50px;"><button type="button" class="btn btn-primary">Home</button></a>
    <div class="container">
        <?php
        if (isset($_SESSION['success'])) {
        ?>
            <div class="alert alert-primary" role="alert">
                <?php echo $_SESSION['success'] ?>
            </div>
        <?php
        }
        ?>
        <br>
        <form method="post" enctype="multipart/form-data">

            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Product Name</label>
                <div class="col-sm-10">
                    <input type="text" name="productName" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                    <select name="madm">
                        <?php foreach ($listcate as $r) {
                        ?>
                            <option value="<?php echo $r['madm']  ?>"><?php echo $r['tendm'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <input type="file" name="files[]" multiple required />
                </div>
            </div>     
    <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
    </form>
    </div>

</body>

