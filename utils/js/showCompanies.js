const showCompanies = () => {
  $.ajax({
    //Busca as empresas e faz a listagem na tabela
    url: 'http://localhost/Cursophp/Supermarket/utils/showCompanies.php',
    method: 'GET',
    datatype: 'json',
  }).done(function (result) {
    // console.log(result);
    result.forEach((element) => {
      $('#showCo tbody').append(`
      <tr class="tableRowEmp">
      <th>
        <span>
          <h1>${element['nome_emp']}</h1>
        </span>
      </th>
      <th>
        <span>
          <h1>${element['end']}</h1>
        </span>
      </th>
      <th>
        <span>
          <h1>${element['cidade']}</h1>
        </span>
      </th>
      <th>
        <span>
          <h1>${element['num_lojas']}</h1>
        </span>
      </th>
      <th>
        <span>
          <h1>${element['total_prods']}</h1>
        </span>
      </th>
    </tr>
      `);
    });

    $('.tableRowEmp').on('click', function () {
      //monta o card do produto que foi clicado
      const nomeSupermercado = $(this).find('h1:eq(0)').text();
      $.ajax({
        url: 'http://localhost/Cursophp/Supermarket/utils/getMoreInfoCo.php',
        method: 'POST',
        data: {
          nome_emp: nomeSupermercado,
        },
        datatype: 'json',
      }).done(function (result) {
        if (typeof result === 'string') {
          //se vier string é pq deu erro.
          const msg = $('.msg');
          msg.text(
            'Parece que não existem outras informações com esta empresa.',
          );
          msg.fadeIn();

          setTimeout(function () {
            msg.fadeOut();
          }, 4000);
        } else {
          $('.gridCard').css('display', 'grid');

          // verificação para ver se já existe um card de determinado produto.
          const textosDosH1 = [];
          $('.gridCard').each(function () {
            // Dentro de cada 'cardContent', pega todos os elementos <h1>
            $(this)
              .find('h1')
              .each(function () {
                // Obtém o texto de cada <h1> e adicione ao array
                textosDosH1.push($(this).text());
              });
            // Compara o texto do <h1> com 'nomeSupermercado' e exibe uma mensagem
            if (textosDosH1.includes(nomeSupermercado)) {
              const msg = $('.msg');
              msg.text('Já existe um card desta empresa.');
              msg.fadeIn();

              setTimeout(function () {
                msg.fadeOut();
              }, 1500);
              return false; // Para a verificação após encontrar uma correspondência
            } else {
              // montagem do card abaixo
              $('.gridCard').append(`<div class="cardContent">
          <span>
            <h1>${nomeSupermercado}</h1>
          </span>

          <div>

          </div>
        </div>`);

              if ($('.cardContent:last-child h1').text() === nomeSupermercado) {
                result.forEach((element) => {
                  $('.cardContent:last-child div').append(`
            <span class="rowInfo">
            <p>${element['nome_produto']}</p>
            <p>${Number(element['preco']).toLocaleString('pt-BR', {
              style: 'currency',
              currency: 'BRL',
            })}</p>
          </span>
            `);
                });
              } else {
                console.log($('.cardContent:last-child h1').text());
              }
            }
          });
        }
      });
    });
  });
};
showCompanies();
