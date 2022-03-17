<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>

<?php
require_once('./model/product.php');
require_once('./upload.php');
require_once('./model/category.php');
if (isset($_SESSION['success'])) {
    unset($_SESSION['success']);
}

$cate = new Cate();
$listcate = $cate->getAllnoLimit();
$product = new Product();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (is_numeric($id)) {
        //  var_dump($contents);
        $obj = $product->getProductById($id);
        //get  cate by product id
        $catesOfProduct = $cate->getCatesByProductId($id);
        if ($catesOfProduct == NULL) {
            $catesOfProduct = array(0, 0, 0);
        }
    } else {
        header('Location:index.php');
    }
}
if (isset($_FILES['files']) && isset($_POST['submit'])) {
    $id = $_POST['masp'];  
    $count = $product->update($_POST);
    $_SESSION['success'] = "Sửa thành công ";  
    header('Location:edit.php?id=' . $id);
}

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
        <form method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <input type="hidden" value="<?php echo $obj['masp'] ?>" name="masp" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Product Name</label>
                <div class="col-sm-10">
                    <input type="text" value="<?php echo $obj['tensp'] ?>" name="tensp" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                    <select name="madm">

                        <?php 
                            foreach ($listcate as $cate) {
                        ?>
                            <option <?php if ($cate['madm'] == $obj['madm']) echo 'selected'; ?> value="<?php echo $cate['madm']  ?>"><?php echo $cate['tendm'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <?php
                    $listImg = $product->getImg($obj['masp']);
                    foreach ($listImg as $r) { ?>
                        <img height="300px" width="400px" src="<?php echo 'img/' . $r['hinh'] ?>" alt="">
                    <?php } ?>
                    <br>
                    <input type="file" name="files[]" multiple />
                </div>
            </div>

            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
        </form>
    </div>
</body>