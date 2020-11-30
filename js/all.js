

$(document).ready(function(){
    $('#confirmation').on('click', function () {
        return confirm('Bạn có muốn hủy đăng kí lớp ? ');
    });

    $('#confirmation_teacher').on('click', function () {
        return confirm('Bạn có muốn xóa lớp này không ?  ');
    });

  
});

function modal2(){
    $('#Modal2').modal('show');
}

document.getElementsByClassName("cancel").onclick = function () {
    location.href = "google.com";
};

