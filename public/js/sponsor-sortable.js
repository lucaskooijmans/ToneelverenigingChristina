$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".sponsors-list").sortable({
        placeholder: "ui-state-highlight",
        tolerance: "pointer",
        revert: 300, // Smooth reversion over 200 milliseconds
        update: function(event, ui) {
            var sponsorOrder = $(this).sortable('toArray', { attribute: 'data-sponsor-id' });
            $.post('/sponsors/update-order', {
                order: sponsorOrder
            });
        }
    });
    $(".sponsors-list").disableSelection();
});
