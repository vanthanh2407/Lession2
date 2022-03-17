<?php
require_once('./connection.php');
require_once('iproduct.php');
class Product extends DB implements Iproduct
{
    const tableName = 'product';
    public function __construct()
    {
        parent::__construct();
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
   
    function getListProductByCategory($madm)
    {
        $stm = $this->db->prepare("SELECT p.masp, p.tensp,p.tendm,p.hinh FROM product p INNER JOIN category c ON c.madm= p.madm WHERE c.madm=$madm ORDER BY p.id DESC");
        $stm->execute();
        return $stm->fetchAll();
    }
   
    function getAll($offset, $count)
    {
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " LIMIT $offset,$count");
        $stm->execute();
        return $stm->fetchAll();
    }
   
    function getImg($id)
    {
        try {
            $stm = $this->db->prepare("SELECT hinh FROM " . 'product WHERE masp=' . "$id");
            $stm->execute();
            return $stm->fetchAll();
        } catch (\Throwable $e) {
            echo $e;
        }
    }

    function getListBySearchCate($name)
    {
        try {
            
            $stm = $this->db->prepare("SELECT * FROM  product p join category c on p.madm=c.madm ". ' WHERE tendm LIKE :name or tensp LIKE :name' );
            $stm->setFetchMode(PDO::FETCH_ASSOC);
            $stm->execute(array(":name" => '%' . $name . '%'));
            return $stm->fetchAll();
        } catch (\Throwable $e) {
            echo $e;
        }
    }

    function insert($payload, $srcs, $srcOfContent)
    {
        try {
            $tensp = $payload['productName'];
            $cate_id = $payload['madm'];
            
            foreach ($srcs as $src) {
                $stm = $this->db->prepare('INSERT INTO ' .
                    self::tableName . '(tensp,madm,hinh)
                                VALUES(:productName,:cate_id,:img)');
                $stm->execute(array(
                    ':productName' => $tensp,
                    ':cate_id' => $cate_id,
                    ':img' => $src,
                ));
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        //tra ve so ban ghi
        return $stm->rowCount();
    }

    function delete($id)
    {
        $this->db->query("DELETE FROM " . self::tableName . " WHERE masp = " . $id);
    }

    function update($payload)
    {
        try {
            $tensp = $payload['tensp'];
            $madm = $payload['madm'];
            $id = $payload['masp'];

            $stm = $this->db->prepare('UPDATE ' . self::tableName . ' 
             SET  tensp = :tensp, madm = :madm WHERE masp = :masp');
            $stm->execute(array(
                ':tensp' => $tensp,
                ':madm' => $madm,
                ':masp' => $id
        ));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        } //tra ve so ban ghi
        return $stm->rowCount();
    }

    function getListByListID($id)
    {
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " WHERE id= $id");
        $stm->execute();
        return $stm->fetchAll();
    }

    function getProductById($id)
    {
        $rows = $this->db->query("SELECT * FROM " . self::tableName . " WHERE masp= $id");
        foreach ($rows as $r) {
            $row  = $r;
        }
        return $r;
    }
    
}
