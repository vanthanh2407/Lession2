<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>

<?php
require_once('./model/product.php');
require_once('./upload.php');
require_once('./model/category.php');
$listProduct = array();
if (isset($_GET['search_name']) && !empty($_GET['search_name'])) {
    $name = $_GET['search_name'];
    $product = new Product();
    $cate = new Cate();
    $resultSearchCate = $product->getListBySearchCate($name);
}
?>

<br>
<a href="./index.php" style="padding: 50px;"><button type="button" class="btn btn-primary">Home</button></a>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <h2>Kết quả tìm kiếm cho từ khóa :
                <?php
                echo $name;
                ?></h2>
            <!-- show listProducts -->
            <table id="myTableSort" class="table table-striped  table-bordered table-sm" cellspacing="0" width="100%" border="1" style="text-align: center;">
            <thead>
                <tr>
                    <th onclick="sortTable(0)" class="th-sm" scope="col">#</th>
                    <th onclick="sortTable(1)" class="th-sm" scope="col">Product Name</th>
                    <th onclick="sortTable(2)" class="th-sm" scope="col">Category</th>
                    <th onclick="sortTable(3)" class="th-sm" scope="col">Image</th>
                </tr>
            </thead>
            <br>
            <tbody id="myTable">
                <?php
                foreach ($resultSearchCate as $r) {
                    $listImg = $product->getImg($r['masp']);
                ?>
                    <tr>
                        <td><?php echo $r['masp'] ?></td>
                        <td><?php echo $r['tensp'] ?></td>
                        <?php
                        $obj = $cate->getCateById($r['madm']);
                        ?>
                        <td><?php echo $obj['tendm'] ?></td>
                        <td><img height="100px" width="100px" src="<?php echo 'img/' . $listImg[0]['hinh'] ?>" alt=""></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .pagenum {
        color: black
    }
</style>
