function add() {
    var element = document.getElementById('block-a');
    var link = document.createElement('a');
    var br = document.createElement('br');

    link.innerHTML = 'Go to google';
    link.href = 'http://google.com';

    element.appendChild(br);
    element.appendChild(link); 
}

function delete_element() {
    // gets element with some ID
    var someId = document.getElementById('block-a');

    // gets last child node from some element 
    




    for (let i = 0; i < 2; i++) {
        var lastNode = someId.lastChild;
        lastNode.parentNode.removeChild(lastNode);
    }

}