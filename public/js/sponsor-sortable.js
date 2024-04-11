$(document).ready(function() {
    // Enables sorting of sponsors within categories and moving them between categories
    $('.category').sortable({
        connectWith: '.category',
        items: '> div', 
        placeholder: 'ui-state-highlight',
        tolerance: 'pointer',
        revert: 300,
        receive: function(event, ui) {
            var newCategoryId = $(this).data('category-id');
            var sponsorId = ui.item.data('sponsor-id');
            updateSponsorCategory(sponsorId, newCategoryId);
        },
        update: function(event, ui) {
            if (!ui.sender) { 
                var sponsorOrder = $(this).sortable('toArray', { attribute: 'data-sponsor-id' });
                var categoryId = $(this).data('category-id');
                updateSponsorOrder(sponsorOrder, categoryId);
            }
        }
    }).disableSelection();

    $('.sponsors-list').sortable({
        items: '.category-group', // Ensure this targets the direct children correctly
        handle: 'h2', // Handles to drag the categories
        placeholder: 'ui-state-highlight-category',
        update: function(event, ui) {
            var categoryOrder = $(this).sortable('toArray', { attribute: 'data-category-id' });
            updateCategoryOrder(categoryOrder);
        }
    }).disableSelection();
});

function updateSponsorCategory(sponsorId, newCategoryId) {
    $.post('/sponsors/update-category', {
        _token: $('meta[name="csrf-token"]').attr('content'), 
        sponsorId: sponsorId,
        categoryId: newCategoryId,
        updateCategories: false
    });
}

function updateSponsorOrder(sponsorOrder, categoryId) {
    $.post('/sponsors/update-order', {
        _token: $('meta[name="csrf-token"]').attr('content'), 
        order: sponsorOrder,
        categoryId: categoryId
    });
}

function updateCategoryOrder() {
    var orderData = $('.category-group').map(function(index, elem) {
        return {
            id: $(elem).find('.category').data('category-id'),
            position: index
        };
    }).get();

    $.post('/sponsors/update-order', {
        _token: $('meta[name="csrf-token"]').attr('content'),
        order: orderData,
        updateCategories: true
    }).done(function(response) {
        console.log('Update successful:', response);
    }).fail(function(xhr, status, error) {
        console.log('Update failed:', status, error);
    });
}



