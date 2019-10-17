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

//Responsavel Ocorrencia
$(document).ready(function(){
  $("#id-cep-responsavel").focusout(function(){
    let cep = $("#id-cep-responsavel").val();
    cep = cep.replace("-", "");

    let urlStr = "https://viacep.com.br/ws/"+ cep +"/json/";
 
    $.ajax({
        url : urlStr,
        type : "get",
        dataType : "json",
        success : function(data){
            console.log(data);
             
            $("#id-cidade-responsavel").val(data.localidade);
            $("#id-estado-responsavel").val(data.uf.toLowerCase());
            $("#id-bairro-responsavel").val(data.bairro);
            $("#id-rua-responsavel").val(data.logradouro);
        },
        error : function(erro){
            console.log(erro);
        }
    });
  });
});

//Vitimas Ocorrencia
$(document).ready(function(){
  $("#id-cep-vitima").focusout(function(){
    let cep = $("#id-cep-vitima").val();
    cep = cep.replace("-", "");

    let urlStr = "https://viacep.com.br/ws/"+ cep +"/json/";
 
    $.ajax({
        url : urlStr,
        type : "get",
        dataType : "json",
        success : function(data){
            console.log(data);
             
            $("#id-cidade-vitima").val(data.localidade);
            $("#id-estado-vitima").val(data.uf.toLowerCase());
            $("#id-bairro-vitima").val(data.bairro);
            $("#id-rua-vitima").val(data.logradouro);
        },
        error : function(erro){
            console.log(erro);
        }
    });
  });
});

//Ocorrencia Agressor Pessoa
$(document).ready(function(){
  $("#id-cep-agressor").focusout(function(){
    let cep = $("#id-cep-agressor").val();
    cep = cep.replace("-", "");

    let urlStr = "https://viacep.com.br/ws/"+ cep +"/json/";
 
    $.ajax({
        url : urlStr,
        type : "get",
        dataType : "json",
        success : function(data){
            console.log(data);
             
            $("#id-cidade-agressor").val(data.localidade);
            $("#id-estado-agressor").val(data.uf.toLowerCase());
            $("#id-bairro-agressor").val(data.bairro);
            $("#id-rua-agressor").val(data.logradouro);
        },
        error : function(erro){
            console.log(erro);
        }
    });
  });
});

//Ocorrencia Agressor Instituicao
$(document).ready(function(){
  $("#id-cep-instituicao").focusout(function(){
    let cep = $("#id-cep-instituicao").val();
    cep = cep.replace("-", "");

    let urlStr = "https://viacep.com.br/ws/"+ cep +"/json/";
 
    $.ajax({
        url : urlStr,
        type : "get",
        dataType : "json",
        success : function(data){
            console.log(data);
             
            $("#id-cidade-instituicao").val(data.localidade);
            $("#id-estado-instituicao").val(data.uf.toLowerCase());
            $("#id-bairro-instituicao").val(data.bairro);
            $("#id-rua-instituicao").val(data.logradouro);
        },
        error : function(erro){
            console.log(erro);
        }
    });
  });
});