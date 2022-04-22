console.log("e");
$(document).ready(function () {
    $('#commentForm').submit(function (e) {
        alert(e.submitter);
        e.preventDefault();
    });
});
