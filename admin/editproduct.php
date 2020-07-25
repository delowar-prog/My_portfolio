<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once "../classes/Product.php";?>
<?php include_once "../classes/category.php";?>
<?php include_once "../classes/brand.php";?>
<?php 
 $pd=new Product();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <div class="block copyblock"> 
<?php
if(!isset($_GET['proid'])||$_GET['proid']==NULL){
    echo "Data not  found !";
}else{
    $id=$_GET['proid'];
}
?>
<?php 
if(($_SERVER['REQUEST_METHOD']=='POST') && isset($_POST['submit'])){
    $Updateproduct=$pd->ProductUpdate($_POST, $_FILES, $id);
    if(isset($Updateproduct)){
        echo $Updateproduct;
    }
}
?>

<?php
 $selectproduct=$pd->getProductbyId($id);
    if($selectproduct){
       while ($result=$selectproduct->fetch_assoc()) {
?>
<form action="" method="post" enctype="multipart/form-data">
<table>
<tr>
    <td>Name:</td>
    <td><input type="text" value="<?php echo $result['productName'];?>" name="Productname"></td>
</tr>
<tr>
    <td>Category:</td>
    <td>
        <select id="select" name="catId">
        <option>Select Catgory</option>
        <?php
        $cat=new Category();
        $SelectData=$cat->getAlldata();
        if($SelectData){
            while($value=$SelectData->fetch_assoc()){
        ?>
        <option 
        <?php if($result['catId']==$value['id']){ ?>
        selected='selected'
        <?php } ?>
        value="<?php echo $value['id']; ?>"><?php echo $value['catname']; ?></option>
        
        <?php } } ?>
        </select>
    </td>
</tr>


<tr>
    <td>Brand:</td>
    <td>
        <select id="select" name="brandId">
        <option>Select Brand</option>
        <?php
        $brand=new Brand();
        $SelectData=$brand->getAlldata();
        if($SelectData){
            while($value=$SelectData->fetch_assoc()){
        ?>
        <option 
        <?php if($result['brandId']==$value['id']){ ?>
        selected='selected'
        <?php } ?>
        value="<?php echo $value['id']; ?>"><?php echo $value['brandname']; ?></option>
        <?php } } ?>
        </select>
    </td>
</tr>


<tr>
    <td>Image:</td>
    <td>
    <img src="<?php echo $result['image'];?>" height="100px" width="150px"></br>
    <input type="file" name="image"></td>
</tr>
<tr>
    <td>Description:</td>
    <td><textarea name="body"><?php echo $result['body'];?></textarea></td>
</tr>
<tr>
    <td>Price:</td>
    <td><input type="text" name="price" value="<?php echo $result['price'];?>"></td>
</tr>
<tr>
    <td>Product Type:</td>
    <td>
    <select id="select" name="type">
        <option>Select Type</option>
        <?php if($result['type']==0) { ?>
        <option value="0" selected='selected'>Featured</option>
        <option value="1">General</option>
        <?php } else{ ?>
        <option value="0">Featured</option>
        <option selected='selected' value="1">General</option>
        <?php } ?>
    </select>
    </td>
</tr>                           
<tr>
    <td></td>
    <td><input type="submit" name="submit" value="Update"></td>
</tr>

</table>
</form>
<?php } } ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>