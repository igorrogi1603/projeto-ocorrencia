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
$('#id-btn-cnasc-rg-vitima').on('click', function() {
  $('#id-up-cnasc-vitima').trigger('click');
});

$('#id-up-cnasc-vitima').on('change', function() {
  var fileName = $(this)[0].files[0].name;
  $('#id-up-cnasc-file-vitima').val(fileName);
});