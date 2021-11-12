$(function(){

	$('td[dia]').click(function(){
		$('td').removeClass('day-selected');
		$(this).addClass('day-selected');
		var novoDia = $(this).attr('dia').split('-');
		var novoDia = novoDia[2]+ '/' + novoDia[1]+'/' + novoDia[0];
		trocarDatas($(this).attr('dia'),novoDia);

		aplicarEventos($(this).attr('dia'));
	})

	$('form').ajaxForm({
		dataType:'json',
		success:function(data){
			$('.box-alert').remove();
			$('form .card-title').after('<div class="box-alert sucesso">Envento foi Adicionado com sucesso!</div>');
			$('.box-tarefas .card-title').after('<div class="tarefas-single"><h2><i class="fa fa-pencil"></i> '+data.tarefa+'</h2></div>');
			$('form')[0].reset();
		}
	})

	function trocarDatas(nformatado,formatado) {
		$('input[name=data]').attr('vale',nformatado);
		$('form .card-title').html('Adicionar Tarefa para: '+ formatado);
		$('.box-tarefas .card-title').html('Adicionar Tarefa para: '+ formatado);
	}

	function aplicarEventos(data){
		$('.tarefas-single').remove();
		$.ajax({
			url: include_path+'ajax/calendario.php',
			method:'post',
			data:{'data':data,'acao':'puxar'}
		}).done(function(data){
			$('.box-tarefas .card-title').after(data);
		})
	}
})