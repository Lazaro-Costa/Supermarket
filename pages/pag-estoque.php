<section class="container mainContainer animeLeft">
  <h1 class="title">Listagem de Estoque</h1>
  <div class="holdTip" id="ocultar">
    <p>*Selecione a empresa para ver seu estoque</p>
  </div>

  <form id="cadEstoque" class="form">

    <div class="holdSelect">
      <select name="cboEmpresa" id="cboEmpresa" class="cbbox">
        <option selected disabled>Selecione uma Empresa</option>
      </select>
      <input type="submit" name="btnGetEstoque" id="btnGetEstoque" value="Ver estoque">
    </div>

    <div class="msg">
      <!-- um aviso aparece aqui -->
    </div>
  </form>

  <table class="tableEstoque" id="tblEstoque">
    <tbody>
      <tr>
        <th>
          <span>
            <h1>Produto</h1>
          </span>
        </th>
        <th>
          <span>
            <h1>Marca</h1>
          </span>
        </th>
        <th>
          <span>
            <h1>Preço</h1>
          </span>
        </th>
      </tr>
    </tbody>
  </table>

</section>