$('#formCadProduto').submit(function (e) {
  e.preventDefault();
  const produto = $('#nomeProd');
  const marca = $('#marca');
  const tamQuant = $('#tamQuant');

  $.ajax({
    url: localhost + 'utils/cadProduto.php',
    method: 'POST',
    data: {
      nome_prod: produto.val(),
      marca: marca.val(),
      tam_quant: tamQuant.val(),
    },
    datatype: 'json',
  }).done(function (result) {
    console.log('entrou aqui');
    produto.val('');
    marca.val('');
    tamQuant.val('');

    const msg = $('.msg');
    msg.text(result);
    msg.fadeIn();

    setTimeout(function () {
      msg.fadeOut();
    }, 4000); // 4 segundos
  });
});
