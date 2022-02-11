function edit(elementId) {
    if(document.getElementById(elementId).disabled == false) {
        document.getElementById(elementId).disabled = true;
    } else {
        document.getElementById(elementId).disabled = false;
    }
}

// function activeAll() {
//     document.getElementById('new_username').disabled = false;
//     document.getElementById('new_first_name').disabled = false;
//     document.getElementById('new_last_name').disabled = false;
//     document.getElementById('new_email').disabled = false;
// }