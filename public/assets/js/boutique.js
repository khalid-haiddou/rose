
        // Toggle filters on mobile
        document.getElementById('filterToggle').addEventListener('click', function() {
            const filters = document.getElementById('filters');
            filters.classList.toggle('active');
        });
      
        
        // Toggle subcategories when clicking on the category label or toggle button
        document.querySelectorAll('.filter-option label[for^="cat-"], .toggle-subcategories').forEach(element => {
            element.addEventListener('click', function(e) {
                if (this.classList.contains('toggle-subcategories')) {
                    e.stopPropagation();
                }
                
                const filterOption = this.closest('.filter-option');
                const subcategories = filterOption.querySelector('.subcategories');
                const toggleButton = filterOption.querySelector('.toggle-subcategories');
                
                if (subcategories) {
                    subcategories.classList.toggle('active');
                    
                    if (toggleButton) {
                        toggleButton.classList.toggle('active');
                    }
                }
            });
        });

        // Show subcategories if any are checked on page load
        document.querySelectorAll('.subcategories').forEach(subcat => {
            const hasChecked = subcat.querySelector('input[type="checkbox"]:checked');
            if (hasChecked) {
                subcat.classList.add('active');
                const toggleButton = subcat.closest('.filter-option').querySelector('.toggle-subcategories');
                if (toggleButton) {
                    toggleButton.classList.add('active');
                }
            }
        });

        // If any subcategory is checked, ensure its parent category is checked
        document.querySelectorAll('input[name="subcategories[]"]').forEach(input => {
            if (input.checked) {
                const parentCategory = input.closest('.filter-option').querySelector('input[name="categories[]"]');
                if (parentCategory) {
                    parentCategory.checked = true;
                }
            }
        });