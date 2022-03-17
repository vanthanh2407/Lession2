<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>
<?php
require_once('./model/product.php');
require_once('./model/category.php');
require_once('./connection.php');
$products = new Product();
$cate = new Cate();
$pdo = new DB();
$pdo = $pdo->getPDO();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'delete':
            if (is_numeric($_GET['id'])) {
                $products->delete($_GET['id']);
            }
            break;

        default:
            break;
    }
}
try {
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $count = 10;
    $offset = ($page - 1) * $count;
    $list = $products->getAll($offset, $count);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<style>
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_asc:before {
        bottom: .5em;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2
    }

    th {
        cursor: pointer;
    }
</style>

<body>
    <div class="container">
    <form action="search.php" method="get" style="margin-top: 10px" class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="search" name="search_name" placeholder="Nhập từ khóa.." aria-label="Search">
                                <button class="btn btn-info" name="" type="submit">Tìm Kiếm</button>
                            </form>    </div>

    <div class="container-fluid">
        <table id="myTableSort" class="table table-striped  table-bordered table-sm" cellspacing="0" width="100%" border="1" style="text-align: center;">
            <thead>
                <tr>
                    <th onclick="sortTable(0)" class="th-sm" scope="col">#</th>
                    <th onclick="sortTable(1)" class="th-sm" scope="col">Product Name</th>
                    <th onclick="sortTable(2)" class="th-sm" scope="col">Category</th>
                    <th onclick="sortTable(3)" class="th-sm" scope="col">Image</th>
                    <th onclick="sortTable(4)" class="th-sm" scope="col">Thao tác</th>
                </tr>
            </thead>
            <br>
            <a class="btn btn-primary" href="add.php" style="float:right; margin-right:20px;">Thêm</a>
            <br>
            <br>
             <!-- get list product -->
            <tbody id="myTable">
                <?php
                foreach ($list as $r) {
                    $listImg = $products->getImg($r['masp']);
                ?>
                    <tr>
                        <td><?php echo $r['masp'] ?></td>
                        <td><?php echo $r['tensp'] ?></td>
                        <?php
                        $obj = $cate->getCateById($r['madm']);
                        ?>
                        <td><?php echo $obj['tendm'] ?></td>
                        <td><img height="100px" width="100px" src="<?php echo 'img/' . $listImg[0]['hinh'] ?>" alt=""></td>
                        <td>
                            <a class="btn btn-warning" href="edit.php?id=<?php echo $r['masp'] ?>">Sửa</a>
                            <a class="btn btn-danger" href="add.php?id=<?php echo $r['masp']; ?>">Thêm</a>
                            <a class="btn btn-danger" href="copy.php?id=<?php echo $r['masp']; ?>">Copy</a>
                            <a class="btn btn-danger" href="show.php?id=<?php echo $r['masp']; ?>">Hiển thị</a>

                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
        //tinh tổng số bản ghi
        $row = $pdo->query('select count(*) as count from product');
        foreach ($row as $r) {
            $allRows = $r['count'];
        }
        $page = ceil($allRows / $count); //(12 dong / 10)= 1.2 trang => 2 trang
        for ($i = 0; $i < $page; $i++) {
            $pageCount = $i + 1;
            echo ' <button> <a href="?page=' . $pageCount . '">' . $pageCount . '</a></button>';
        }
        ?>
    </div>
    <br>
</body>
