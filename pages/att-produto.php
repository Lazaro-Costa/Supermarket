<section class="container mainContainer animeLeft">
  <h1 class="title">Atribuição de Produtos</h1>
  <p class="disclaimer">Aqui você pode adicionar produtos já cadastrados as empresas.</p>
  <div class="holdTip">
    <p>*Escolha as Opções abaixo</p>
  </div>

  <form class="formAtt">
    <div class="holdSelect">
      <select id="cboEmpresa" class="cbbox">
        <option selected disabled>Selecione uma Empresa</option>
      </select>
      <select id="cboProduto" class="cbbox" disabled>
        <option selected disabled>Selecione uma Produto</option>
      </select>
    </div>


    <div class="holdPreco">
      <div>
        <p>R$</p>
        <input type="text" id="attProdPreco" placeholder="Preço">
      </div>
      <div>
        <p>Quantidade:</p>
        <input type="text" id="attProdQuant" placeholder="Quantidade em Estoque">
      </div>
      <input type="submit" id="btnAtt" value="Atribuir">
    </div>
  </form>
  <div class="msg">
    <!-- aqui aparece a mensagem de confirmacao -->
  </div>
</section>