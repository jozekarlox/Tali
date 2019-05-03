$(document).ready(function () {
    $('#iTel').mask(mask);
});

var mask = function (value) {
    return value.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
}

function fecharOverlay() {
    document.getElementById('overlay').className = 'close';
}