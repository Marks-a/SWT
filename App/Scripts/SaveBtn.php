<?php
namespace App\Scripts;

// This class does not work.
class saveBtn
{
    private static $page;
    public function __construct(){}
    public static function setPage($page) {
      self::$page = $page;
    }
    public static function getPage()
    {
        return self::$page;
    }
}

?>
<!-- 
Use this function.
1.Creating new Object.
2.Settings to the correct page (In header.php is a param $currentPage)
3.Should work. 
-->
<script>
    // Script for showing Errors when 
    function showError(element, message) {
        if (element) {
            // Create a new paragraph element for the error message
            const errorParagraph = document.createElement('p');
            errorParagraph.classList.add('error-message');
            errorParagraph.textContent = message;

            // Append the new error message to the parent element
            element.parentElement.appendChild(errorParagraph);

            // Optionally: Add a class to highlight the invalid input
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
    const page = "<?php echo $page ?>"
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
                    // If attribute field is found but the value is invalid
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
                    // Prob will not work.
                    // $CurrentPage = new saveBtn();

                    (new Post_handler(page)).addButton();
                    form.submit();
                }
            } else {
                console.log('Fill in all required fields');
            }
        })
    }
</script>