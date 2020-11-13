// vanilla javascript
// function tampilCardTambah() {
//     var x = document.getElementById("card-tambah");
//     if (x.style.display === "none") {
//         x.style.display = "block";
//     } else {
//         x.style.display = "none";
//     }
// }

// Tampilkan form tambah record jika button tambah-record di klik
function tampilCardTambah() {
    let cardTambah = $('#card-tambah');
    if (cardTambah.is(':hidden')) {
        cardTambah.show("fast");
    } else {
        cardTambah.hide("fast");
    }
}

// Tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})