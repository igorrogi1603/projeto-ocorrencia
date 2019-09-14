function validarCaracter(valor, tipo)
{
  switch (tipo) {
    case 1:
      string = valor.value.replace(/[^a-zA-Zà-úÀ-Ú ]/g,'');
      valor.value = string;
      break;
    case 2:
      string = valor.value.replace(/[^a-zA-Z0-9 ]/g,'');
      valor.value = string;
      break;
    case 3:
      string = valor.value.replace(/[^a-zA-Z0-9à-úÀ-Ú ]/g,'');
      valor.value = string;
      break;
  }
}