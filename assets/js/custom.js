var formSelectors = document.querySelectorAll('.form-selector');

    formSelectors.forEach(function (formSelector) {
        formSelector.addEventListener('change', function () {
            var selectedOption = this.value;
            var formContainers = document.querySelectorAll('.form-container');

            formContainers.forEach(function (formContainer) {
                formContainer.style.display = 'none';
            });

            var selectedForm = document.querySelector('.' + selectedOption + '-form');
            if (selectedForm) {
                selectedForm.style.display = 'block';
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        var sizeSelector = document.querySelector('.size-selector');
        var costMediumContainer = document.querySelector('.costMedium-container');
        var costLargeContainer = document.querySelector('.costLarge-container');
    
        sizeSelector.addEventListener('change', function () {
            var selectedSize = this.value;
    
            if (selectedSize === 'MediumOnly') {
                costMediumContainer.style.display ='block';
                costLargeContainer.style.display = 'none';
            } else if (selectedSize === 'LargeOnly') {
                costMediumContainer.style.display = 'none';
                costLargeContainer.style.display ='block';
            } else {
                costMediumContainer.style.display ='block';
                costLargeContainer.style.display ='block';
            }
        });
    });
    