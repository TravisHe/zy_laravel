$('.confirm').on('click', function (e) {
   return !!confirm($(this).data('confirm'));
});
