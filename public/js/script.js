var document = new Document();

function changePrice(value) {
    var product_id = document.getElementById("products_table_body");
    return fetch(url, {
        method: 'POST',
        cache: 'no-cache',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            price: value,
            product_id: product_id
        })
    })
}