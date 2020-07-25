<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add Product</h2>
        <div class="block copyblock"> 
<?php 
if(($_SERVER['REQUEST_METHOD']=='POST') && isset($_POST['submit'])){
    $insertproduct=$pd->ProductInsert($_POST, $_FILES);
    if($insertproduct){
        echo $insertproduct;
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
<table>
<tr>
    <td>Name:</td>
    <td><input type="text" placeholder="Enter Product Name..." name="Productname"></td>
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
        <option value="<?php echo $value['id']; ?>"><?php echo $value['catname']; ?></option>
        
        <?php }} ?>
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
        <option value="<?php echo $value['id']; ?>"><?php echo $value['brandname']; ?></option>
        
        <?php }} ?>
        </select>
    </td>
</tr>


<tr>
    <td>Image:</td>
    <td><input type="file" name="image"></td>
</tr>
<tr>
    <td>Description:</td>
    <td><textarea name="body" ></textarea></td>
</tr>
<tr>
    <td>Price:</td>
    <td><input type="text" name="price"></td>
</tr>
<tr>
    <td>Product Type:</td>
    <td>
    <select id="select" name="type">
        <option>Select Type</option>
        <option value="0">Featured</option>
        <option value="1">General</option>
    </select>
    </td>
</tr>                           
<tr>
    <td></td>
    <td><input type="submit" name="submit" value="Save"></td>
</tr>

</table>
</form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>