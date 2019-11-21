function changePrice(el) {
    var product_id = el.parentElement.parentElement.childNodes[1].textContent;
    return fetch('/products', {
        method: 'POST',
        cache: 'no-cache',
        headers: {
            'X-CSRF-TOKEN': new Document().querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            price: el.value,
            product_id: product_id
        })
    })
}