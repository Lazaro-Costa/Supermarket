$('#formCadEmpresa').submit(function (e) {
  e.preventDefault();
  const empresa = $('#nomeEmp');
  const endereco = $('#endereco');
  const cidade = $('#cidade');
  const numLojas = $('#numLojas');
  $.ajax({
    url: localhost + 'utils/cadEmpresa.php',
    method: 'POST',
    data: {
      nome_emp: empresa.val(),
      end: endereco.val(),
      cidade: cidade.val(),
      num_lojas: numLojas.val(),
    },
    datatype: 'json',
  }).done(function (result) {
    empresa.val('');
    endereco.val('');
    cidade.val('');
    numLojas.val('');

    const msg = $('.msg');
    msg.text(result);
    msg.fadeIn();

    setTimeout(function () {
      msg.fadeOut();
    }, 4000); // 4 segundos
  });
});
