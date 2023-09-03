const getProducts = () => {
  $.ajax({ //Busca os produtos e faz a listagem na tabela
    url: 'http://localhost/Cursophp/Supermarket/utils/getProduto.php',
    method: 'GET',
    datatype: 'json',
  }).done(function (result) {
    result.forEach((element) => {
      $('.tabelaProdutos tbody').append(`
      <tr class="tableRow">
      <th>
        <span>
          <h1>${element['nome_empresa']}</h1>
        </span>
      </th>
      <th>
        <span>
          <h1>${element['marca']}</h1>
        </span>
      </th>
      <th>
        <span>
          <h1>${element['nome_produto']}</h1>
        </span>
      </th>
      <th>
        <span>
          <h1>${element['tam_quant']}</h1>
        </span>
      </th>
      <th>
        <span>
          <h1>${Number(element['preco']).toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL',
          })}</h1>
        </span>
      </th>
    </tr>
      `);
    });

    $('.tableRow').on('click', function () { //monta o card do produto que foi clicado
      const nomeSupermercado = $(this).find('h1:eq(0)').text();
      const nomeProduto = $(this).find('h1:eq(2)').text();

      $.ajax({
        url: 'http://localhost/Cursophp/Facudade2/utils/getMoreEstoque.php',
        method: 'POST',
        data: {
          nome_emp: nomeSupermercado,
          nome_prod: nomeProduto,
        },
        datatype: 'json',
      }).done(function (result) {
        if (typeof result === 'string') { //se vier string é pq deu erro.
          const msg = $('.msg');
          msg.text(
            'Parece que não existem outras empresas com o mesmo produto.',
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
            // Compara o texto do <h1> com 'nomeProduto' e exibe uma mensagem
            if (textosDosH1.includes(nomeProduto)) {
              const msg = $('.msg');
              msg.text('Já existe um card deste produto.');
              msg.fadeIn();

              setTimeout(function () {
                msg.fadeOut();
              }, 1500);
              return false; // Para a verificação após encontrar uma correspondência
            } else { // montagem do card abaixo
              $('.gridCard').append(`<div class="cardContent">
          <span>
            <h1>${nomeProduto}</h1>
          </span>
      
          <div>
            
          </div>
        </div>`);

              if ($('.cardContent:last-child h1').text() === nomeProduto) {
                result.forEach((element) => {
                  $('.cardContent:last-child div').append(`
            <span>
            <p>${element['nome_empresa']}</p>
            <p>${Number(element['preco_produto']).toLocaleString('pt-BR', {
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
getProducts();
