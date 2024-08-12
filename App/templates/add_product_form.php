<?php use App\Posts\Post_handler; ?>
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
    <select name="type" id="productType" required onclick="showAttributeFields(this.value)">
        <option value="" disabled selected>Select type</option>
        <option value="DVD">DVD</option>
        <option value="Book">Book</option>
        <option value="Furniture">Furniture</option>
    </select>
    <br>
    <div id="attribute-fields"></div>
    <div id='error-message'></div>
</form>
<?php
$page = isset($_GET['page']) ? $_GET['page'] : null;
(new Post_handler($page))->addButton();
?>

<script>
    function showAttributeFields(type) {
        const attributeFields = document.getElementById('attribute-fields');
        attributeFields.innerHTML = '';

        if (type === 'DVD') {
            attributeFields.innerHTML = `
            <p>Please, provide size</p>
            <label for="size">Size (MB):</label>
            <input type="number" name="size" id="size" required min="0" step="0.01">
            <br>
        `;
        } else if (type === 'Book') {
            attributeFields.innerHTML = `
         <p>Please, provide weight</p>
            <label for="weight">Weight (KG):</label>
            <input type="number" name="weight" id="weight" required min="0" step="0.01">
            <br>
        `;
        } else if (type === 'Furniture') {
            attributeFields.innerHTML = `
        <p>Please, provide dimensions</p>
            <label for="height">Height (CM):</label>
            <input type="number" name="height" id="height" required min="0" step="0.01">
            <br>
            <label for="width">Width (CM):</label>
            <input type="number" name="width" id="width" required min="0" step="0.01">
            <br>
            <label for="length">Length (CM):</label>
            <input type="number" name="length" id="length" required min="0" step="0.01">
            <br>
        `;
        }
    }
</script>