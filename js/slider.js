$(document).ready(function () {

$('.multi-image-slider').carousel({
    interval: 7000
});
$('.multi-image-slider .item').each(function(){
var next = $(this).next();
if (!next.length) {
    next = $(this).siblings(':first');
}
next.children(':first-child').clone().appendTo($(this));
if (next.next().length>0) {
    next.next().children(':first-child').clone().appendTo($(this));
} else {
$(this).siblings(':first').children(':first-child').clone().appendTo($(this));
}
});

});