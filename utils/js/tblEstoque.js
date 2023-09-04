$('#cadEstoque').submit(function (e) {
  e.preventDefault();
  const empresa = $('#cboEmpresa').val();

  getEstoque(empresa);
});
function getEstoque(empresa) {
  $.ajax({
    url: localhost + 'utils/getEstoque.php',
    method: 'POST',
    data: { nome_emp: empresa },
    dataType: 'json',
  }).done(function (result) {
    if (typeof result === 'string') {
      const msg = $('.msg');
      msg.text('A empresa que escolheu ainda não tem produtos.');
      msg.fadeIn();

      setTimeout(function () {
        msg.fadeOut();
      }, 4000);
    } else {
      $('#ocultar').css('display', 'none');
      $('#cadEstoque').css('display', 'none');
      $('#tblEstoque').css('display', 'table');
      $('#cadEstoque').after(`<h1>${empresa}</h1>`);
      $('.holdTip').before(`<a href="?estoque" class="voltar">Voltar</a>`);
      result.forEach((element) => {
        const preco = Number(element['preco']);

        $('#tblEstoque').append(`
        <tr>
          <th>
            <p>${element['nome_produto']}</p>
          </th>
          <th>
          <p>${element['marca']}</p>
        </th>
          <th>
          <span>
            <p>${preco.toLocaleString('pt-BR', {
              style: 'currency',
              currency: 'BRL',
            })}</p>
            </span>
          </th>
        </tr>
        `);
      });
    }
  });
}
