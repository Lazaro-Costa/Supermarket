function getProdutos(empresa) {
  $.ajax({
    url: localhost + 'utils/cboProduto.php',
    method: 'POST',
    data: {
      nome_emp: empresa,
    },
    dataType: 'json',
  }).done(function (result) {
    if (typeof result === 'string') {
      $('#cboProduto').empty();
      $('#cboProduto').prop('disabled', true);
      $('#cboProduto').prepend(
        `<option>${'Já possui todos os produtos.'}</option>`,
      );
    } else {
      $('#cboProduto').empty();
      result.forEach((e) => {
        $('#cboProduto').prepend(`<option>${e['nome_prod']}</option>`);
      });
      $('#cboProduto').prop('disabled', false);
    }
  });
}
$('#cboEmpresa').on('change', function () {
  const empresa = $('#cboEmpresa').val();
  getProdutos(empresa);
});
