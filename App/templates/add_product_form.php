<?php
use App\Posts\Post_handler;
use App\classes\ProductTypes;

$productTypeManager = new ProductTypes();
?>
<h2>Add Product</h2>
<form method="POST" id="product_form">
    <label for="sku">SKU:</label>
    <input type="text" name="sku" id="sku" required pattern="[A-Za-z0-9]{1,10}">
    <br>
    <label for="name">Product Name:</label>
    <input type="text" name="name" id="name" required>
    <br>
    <label for="price">Price($):</label>
    <input type="number" name="price" id="price" required min="0" step="0.01">
    <br>
    <label for="type">Type:</label>
    <select name="type" id="productType" required onchange="
     showAttributeFields(this.value)
    ">
        <?php
        // Render product type options dynamically
        echo $productTypeManager->renderProductTypeOptions();
        ?>
    </select>
    <br>
    <div id="attribute-fields">

    </div>
    <div id='error-message'></div>
</form>
<?php
$page = isset($_GET['page']) ? $_GET['page'] : null;
(new Post_handler($page))->addButton();
?>


<script>
    function showAttributeFields(productType) {
        fetch(`http://localhost/App/Handling/ProductTypeHandler.php?productType=${encodeURIComponent(productType)}`)
            .then(response => response.text()) 
            .then(data => {
              
                document.getElementById('attribute-fields').innerHTML = data;
            })
            .catch(error => console.error('Error fetching data:', error));
    }
</script>

<!-- <select name="type" id="productType" required onclick="showAttributeFields(this.value)">
        <option value="" disabled selected>Select type</option>
        <option value="DVD">DVD</option>
        <option value="Book">Book</option>
        <option value="Furniture">Furniture</option>
    </select> -->
