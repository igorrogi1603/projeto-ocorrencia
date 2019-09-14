//CALCULAR CEP
//Cadastrar Usuario e Editar Usuario
$(document).ready(function(){
  $("#id-cep-usuario").focusout(function(){
    let cep = $("#id-cep-usuario").val();
    cep = cep.replace("-", "");

    let urlStr = "https://viacep.com.br/ws/"+ cep +"/json/";
 
    $.ajax({
        url : urlStr,
        type : "get",
        dataType : "json",
        success : function(data){
            console.log(data);
             
            $("#id-cidade-usuario").val(data.localidade);
            $("#id-estado-usuario").val(data.uf.toLowerCase());
            $("#id-bairro-usuario").val(data.bairro);
            $("#id-rua-usuario").val(data.logradouro);
        },
        error : function(erro){
            console.log(erro);
        }
    });
  });
});

//------------------------------------------------------------------
//Criar Apuracao
function getCalculaCepApuracao(){
  for (let i = 0; i <= 100; i++) {
    $(document).ready(function(){
      $("#id-cep-vitima-"+i).focusout(function(){
        let cep = $("#id-cep-vitima-"+i).val();
        cep = cep.replace("-", "");

        let urlStr = "https://viacep.com.br/ws/"+ cep +"/json/";
     
        $.ajax({
            url : urlStr,
            type : "get",
            dataType : "json",
            success : function(data){
                console.log(data);
                 
                $("#id-cidade-vitima-"+i).val(data.localidade);
                $("#id-estado-vitima-"+i).val(data.uf.toLowerCase());
                $("#id-bairro-vitima-"+i).val(data.bairro);
                $("#id-rua-vitima-"+i).val(data.logradouro);
            },
            error : function(erro){
                console.log(erro);
            }
        });
      });
    });
  }
}