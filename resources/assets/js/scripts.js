$(function() {

	// Отправка формы
	$('form').submit(function() {
		let data = $(this).serialize()
		data += '&ajax-request=true'
		$.ajax({
			type: 'POST',
			url: '/sender.php',
			dataType: 'json',
			data: data,
			success: (function() {
				$.fancybox.open({src:'#thanks'})
			})()
		})
		return false
	})

})
