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
    

    
    // while(lastNode && lastNode.nodeType!=1) {
    //     //перейти к предыдущему узлу
    //     lastNode.parentNode.removeChild(lastNode);
    //   }

    for (let i = 0; i < 2; i++) {
        var lastNode = someId.lastChild;
        lastNode.parentNode.removeChild(lastNode);
    }
    
      
    // lastNode.parentNode.removeChild(lastNode);
    
    

    // document.body.removeChild(element);

}