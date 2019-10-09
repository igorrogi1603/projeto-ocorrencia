$(document).ready(function() {
  $("#id-qtd-vitima").keyup(function() {
      $("#id-qtd-vitima").val(this.value.match(/[0-9]*/));
  });
});

/**********************************************************/
/**********************************************************/
/**				Criar Ocorrencia					     **/
/**********************************************************/
/**********************************************************/

/*Upload Vitima
----------------------------------------------*/
/*Upload CPF
-------------------------*/
$('#id-btn-up-cpf-vitima').on('click', function() {
  $('#id-up-cpf-vitima').trigger('click');
});

$('#id-up-cpf-vitima').on('change', function() {
  var fileName = $(this)[0].files[0].name;
  $('#id-up-cpf-file-vitima').val(fileName);
});

/*Upload RG
------------------------*/
$('#id-btn-up-rg-vitima').on('click', function() {
  $('#id-up-rg-vitima').trigger('click');
});

$('#id-up-rg-vitima').on('change', function() {
  var fileName = $(this)[0].files[0].name;
  $('#id-up-rg-file-vitima').val(fileName);
});

/*Upload Certidão de Nascimento
------------------------*/
$('#id-btn-up-cnasc-vitima').on('click', function() {
  $('#id-up-cnasc-vitima').trigger('click');
});

$('#id-up-cnasc-vitima').on('change', function() {
  var fileName = $(this)[0].files[0].name;
  $('#id-up-cnasc-file-vitima').val(fileName);
});


/**********************************************/
/*Upload Agressor
----------------------------------------------*/
$('#id-btn-up-cpf-agressor').on('click', function() {
  $('#id-up-cpf-agressor').trigger('click');
});

$('#id-up-cpf-agressor').on('change', function() {
  var fileName = $(this)[0].files[0].name;
  $('#id-up-cpf-file-agressor').val(fileName);
});

/*Upload RG
------------------------*/
$('#id-btn-up-rg-agressor').on('click', function() {
  $('#id-up-rg-agressor').trigger('click');
});

$('#id-up-rg-agressor').on('change', function() {
  var fileName = $(this)[0].files[0].name;
  $('#id-up-rg-file-agressor').val(fileName);
});

/*********************************************/
/*Upload Documento
------------------------*/
$('#id-btn-up-documento').on('click', function() {
  $('#id-up-documento').trigger('click');
});

$('#id-up-documento').on('change', function() {
  var fileName = $(this)[0].files[0].name;
  $('#id-up-documento-file').val(fileName);
});