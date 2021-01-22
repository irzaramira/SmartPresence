$('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('Are you sure you want to delete ' + recipient)
})

function realtimejam() {
    var rt = new Date();

    y = rt.getFullYear();
    m = rt.getMonth() + 1;
    d = rt.getDate();

    document.getElementById("tanggal").innerHTML =
        `${d}/${m}/${y}`;

    var jam = rt.getHours();
    var menit = rt.getMinutes();
    var detik = rt.getSeconds();

    var ampm = (jam < 12) ? "AM" : "PM";

    jam = ("0" + jam).slice(-2);
    menit = ("0" + menit).slice(-2);
    detik = ("0" + detik).slice(-2);

    document.getElementById("jam").innerHTML =
        `${jam} : ${menit} : ${detik}`;
    var t = setTimeout(realtimejam, 500);
}

var btn = $('#button');

$(window).scroll(function () {
    if ($(window).scrollTop() > 300) {
        btn.addClass('show');
    } else {
        btn.removeClass('show');
    }
});

btn.on('click', function (e) {
    e.preventDefault();
    $('html, body').animate({
        scrollTop: 0
    }, '300');
});

AOS.init();