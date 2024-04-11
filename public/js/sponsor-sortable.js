$(document).ready(function(){
    $('.category').sortable({
        connectWith: '.category',
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
});

function updateSponsorCategory(sponsorId, newCategoryId) {
    $.post('/sponsors/update-category', {
        _token: $('meta[name="csrf-token"]').attr('content'), 
        sponsorId: sponsorId,
        categoryId: newCategoryId
    });
}

function updateSponsorOrder(sponsorOrder, categoryId) {
    $.post('/sponsors/update-order', {
        _token: $('meta[name="csrf-token"]').attr('content'), 
        order: sponsorOrder,
        categoryId: categoryId
    });
}
