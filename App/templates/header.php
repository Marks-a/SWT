<?php use App\Posts\Post_handler; ?>
<header>
    <div class="header-right">
        <h1>Products List</h1>
    </div>
    <nav>
	
        <?php if ($currentPage === 'add_product_form.php'): ?>
            <!-- Cancel button (navigates back to product list) -->
            <a href="<?= htmlspecialchars($deleteButtonLink) ?>" class="button" id="second-btn">
                <?= htmlspecialchars($deleteButtonText) ?>
            </a>
            <!-- Save button (submits add product form) -->
            <a href="#" class="button" id="save-btn">
                <?= htmlspecialchars($actionButtonText) ?>
            </a>


        <?php else: ?>
            <!-- Mass Delete button nd the id -->
            <a href="#" class="button" id="delete-product-btn">
                 <?= htmlspecialchars($deleteButtonText) ?>
            </a>
            <form id="delete-form" method="post" action="<?= htmlspecialchars($deleteButtonLink) ?>" style="display:none;">
                <input type="hidden" name="items" id="items-to-delete" value="">
            </form>
            <!-- Add button -->
            <a href="?page=<?= htmlspecialchars($actionButtonLink) ?>" class="button" id="add"">
                 <?= htmlspecialchars($actionButtonText) ?>
            </a>
        <?php endif; ?>
    </nav>
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : null;
    (new Post_handler($page))->deleteButton();
    ?>
    <script>
        // Function to show error messages
        function showError(element, message) {
            if (element) {
                // Create a new paragraph element for the error message
                const errorParagraph = document.createElement('p');
                errorParagraph.classList.add('error-message');
                errorParagraph.textContent = message;

                // Append the new error message to the parent
                element.parentElement.appendChild(errorParagraph);
                element.classList.add('input-error');
            } else {
                console.log('Error displaying the message:', message);
            }
        }

        // Function to clear previous error states
        function clearErrors() {
            // Select and remove all error messages
            const errorMessages = document.querySelectorAll('.error-message');
            errorMessages.forEach(error => error.remove());

            // Select and remove error highlighting from inputs
            const inputs = document.querySelectorAll('.input-error');
            inputs.forEach(input => input.classList.remove('input-error'));
        }

    </script>
    <script>
        const saveBtn = document.getElementById('save-btn');
        if (saveBtn) {
            document.querySelectorAll('.error-message').forEach(el => el.remove());
            saveBtn.addEventListener('click', function (event) {
                event.preventDefault();
                const form = document.getElementById('product_form');
                let isValid = true;

                clearErrors();

                const sku = form.querySelector('#sku');
                if (!sku.value.match(/^[A-Za-z0-9]{1,10}$/)) {
                    showError(sku, "Please, provide a valid SKU (alphanumeric, up to 10 characters).");
                    isValid = false;
                }
                const name = form.querySelector('#name');
                if (!name.value.match(/^[A-Za-z0-9]{1,20}$/)) {
                    showError(name, "Please, provide a valid Name (alphanumeric, up to 20 characters).");
                    isValid = false;
                }

                const price = form.querySelector('#price');
                if (price.value <= 0 || isNaN(price.value)) {
                    showError(price, "Please, provide a valid price (positive number).");
                    isValid = false;
                }

                const type = document.querySelector('#productType');
                if (!type || type.value === '') {
                    showError(type, "Please, choose a type");
                    isValid = false;
                }

                const attributeSelectors = {
                    DVD: ['#size'],
                    Book: ['#weight'],
                    Furniture: ['#height', '#width', '#length']
                };
                const selectedType = productType.value;
                const selectors = attributeSelectors[selectedType] || [];
                selectors.forEach(selector => {
                    const attribute = form.querySelector(selector);
                    if (!attribute) {
                        // If attribute field is not found
                        showError(productType, `Missing required attribute field for ${selectedType}.`);
                        isValid = false;
                    } else if (attribute.value <= 0 || isNaN(attribute.value)) {
                        // If attribute field is found 
                        showError(attribute, `Please, provide a valid ${selector.replace('#', '')} (positive number).`);
                        isValid = false;
                    }
                });
                if (!isValid) {
                    showError(sku, 'Fill in all required fields');
                }
                if (form.checkValidity()) {
                    if (isValid) {
                        // Submit the form or handle it with PHP
                        //(new Post_handler($currentPage))->addButton(); 
                        form.submit();
                    }
                } else {
                    console.log('Fill in all required fields');
                }
            })
        }
    </script>
    <script>
        const deleteBtn = document.getElementById('delete-product-btn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function (event) {
                event.preventDefault();

                const checkboxes = document.querySelectorAll('.delete-checkbox');
                const selectedItems = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                if (selectedItems.length > 0) {
                   
                        const deleteForm = document.getElementById('delete-form');

                        // Clear existing hidden inputs
                        deleteForm.innerHTML = '';

                        // Create hidden inputs for each selected item
                        selectedItems.forEach(item => {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'items[]'; // Name it as an array
                            input.value = item;
                            deleteForm.appendChild(input);
                        });

                        deleteForm.submit();
                        // (new Post_handler($currentPage))->deleteButton(); 
                    


                } else {
                   // alert('No items selected.');
                }
            }
            )
        };
    </script>
</header>
