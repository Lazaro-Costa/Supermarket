$('.formAtt').submit(function (e) {
  e.preventDefault();

  const emp = $('#cboEmpresa').val();
  const prod = $('#cboProduto').val();
  const quant = Number($('#attProdQuant').val());
  const preco = $('#attProdPreco').val().replace(',', '.');
  if (emp === null || prod === null || preco === 'R$ 0,00' || quant === 0) {
    const msg = $('.msg');
    msg.text('Dados incompletos');
    msg.fadeIn();

    setTimeout(function () {
      msg.fadeOut();
    }, 1500);
  } else {
    $.ajax({
      url: 'http://localhost/Cursophp/Supermarket/utils/attProduto.php',
      method: 'POST',
      data: {
        nome_emp: emp,
        nome_prod: prod,
        preco: preco,
        prod_quant: quant,
      },
      dataType: 'json',
    }).done(function (result) {
      const msg = $('.msg');
      msg.text(result);
      msg.fadeIn();

      setTimeout(function () {
        msg.fadeOut();
      }, 1500);
      $('#attProdQuant').val('');
      $('#attProdPreco').val('');
    });
  }
});
