function toggleOpen(element) {
    if (element.attributes['data-open'].value === 'true') {
        element.attributes['data-open'].value = 'false';
    } else {
        element.attributes['data-open'].value = 'true';
    }
}