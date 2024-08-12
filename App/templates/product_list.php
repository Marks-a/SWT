<div class="container">
    <div class="product-grid">
        <?php if (!empty($items)): ?>
            <?php foreach ($items as $item): ?>
                <div class="product-box" onclick="toggleCheckbox(this)">
                <input type="checkbox" class="delete-checkbox" value="<?php echo htmlspecialchars($item['SKU']); ?>">
                    <p><?php echo htmlspecialchars($item['SKU']); ?></p>
                    <p><?php echo htmlspecialchars($item['name']); ?></p>
                    <p><?php echo htmlspecialchars($item['price']." $"); ?></p>
                    <p><?php echo htmlspecialchars($item['type']); ?></p>
                    <p><?php echo htmlspecialchars($item['attribute']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>
</div>
<!-- Function for instead of clicking on the checkbox, just click on the div element -->
 <!-- Also this is the function that when clicked on checkbox it does not click -->
<!-- <script>
    function toggleCheckbox(divElement) {
        const checkbox = divElement.querySelector('.delete-checkbox');
        checkbox.checked = !checkbox.checked; 
    }
    
</script> -->
