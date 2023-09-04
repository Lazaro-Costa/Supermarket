function getEmpresas() {
  $.ajax({
    url: localhost + 'utils/getempresa.php',
    method: 'GET',
    dataType: 'json',
  }).done(function (result) {
    result.forEach((element) => {
      $('#cboEmpresa').prepend(`<option>${element}</option>`);
    });
  });
}
getEmpresas();
