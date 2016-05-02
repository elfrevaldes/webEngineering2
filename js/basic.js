$(document).ready(function () {
    // this function allows the menu to be interactive
    $(function () {
        $('.icoMenu').on('click', function () {
            $('.mainNav').toggleClass('open');
            $('.icoMenu').css('display', 'none');
        });
        $('.mainNav').on('click', function (){
            // for now
            $('.mainNav').toggleClass('open');
            $('.icoMenu').css('display', 'block');
        });
    });
});