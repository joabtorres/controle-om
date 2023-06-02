window.HELP_IMPROVE_VIDEOJS = false;
/**
 *
 * @author Joab Torres Alencar
 * @description Só carrega o conteudo da página após seu total carregamento
 */
function mostrarConteudo() {
   var elemento = document.getElementById("tela_load");
   elemento.style.display = "none";

   var elemento = document.getElementById("tela_sistema");
   if (elemento) {
      elemento.style.display = "block";
   }

   var elemento = document.getElementById("interface_login");
   if (elemento) {
      elemento.style.display = "block";
   }
}
/**
 * @author Joab Torres Alencar
 * @description classes para tratamento de preenchimento de campos
 */
$(document).ready(function () {
   mostrarConteudo();
   $(".input-data").mask("00/00/0000");
   $(".input-hora").mask("00:00:00");
});
/**
 * @author Joab Torres Alencar
 * @description Está função submite o forumlário de buscar rápida que está no menu da direita
 */
function submit_form_navbar() {
   if (document.nSearchSGL) {
      document.nSearchSGL.submit();
   }
}

//oculta o arlert de mensagem
$("[data-hide]").on("click", function () {
   $("#alert-msg").toggle().addClass("oculta");
});
/**
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @description Este codigo abaixo é responsável para fazer o carregamento da imagem setada pelo usuário ao muda a foto do perfil
 */

if (document.getElementById("container-usuario-form")) {
   /**
    * @author Joab Torres <joabtorres1508@gmail.com>
    * @description Este codigo abaixo é responsável para fazer o carregamento da imagem setada pelo usuário ao muda a foto do perfil
    */
   readURL = function (input) {
      if (input.files && input.files[0]) {
         var reader = new FileReader();
         var num = input.name.replace("tImagem-", "");
         reader.onload = function (e) {
            $("#viewImagem-" + num).attr("src", e.target.result);
         };
         reader.readAsDataURL(input.files[0]);
      }
   };
   /**
    * @author Joab Torres <joabtorres1508@gmail.com>
    * @description Este codigo abaixo é responsável para fazer o carregamento da imagem setada pelo usuário ao muda a foto do perfil
    */
   readDefaultURL = function () {
      var valor = $("input[name=nSexo]:checked").val();
      if (valor === "M") {
         $("#viewImagem-1").attr(
            "src",
            base_url + "/assets/imagens/user_masculino.png"
         );
      } else {
         $("#viewImagem-1").attr(
            "src",
            base_url + "/assets/imagens/user_feminino.png"
         );
      }
      if ($("#iImagem-user").val() !== null) {
         $("#iImagem-user").val(null);
      }
   };
}

/**
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @description Este codigo abaixo é responsável para fazer o carregamento da imagem setada pelo usuário ao muda a foto do perfil
 */

if (document.getElementById("formAluno")) {
   readURL = function (input) {
      if (input.files && input.files[0]) {
         var reader = new FileReader();
         var num = input.name.replace("tImagem-", "");
         reader.onload = function (e) {
            $("#viewImagem-" + num).attr("src", e.target.result);
         };
         reader.readAsDataURL(input.files[0]);
      }
   };
   function validarCampo(valor, name) {
      if (valor === "Não") {
         $("input[name='" + name + "']").attr("disabled", "true");
      } else {
         $("input[name='" + name + "']").removeAttr("disabled", "true");
      }
   }
   $(document).ready(function () {
      //ao carregar a página
      validarCampo($("input[name='nAlergia']:checked").val(), "nQualAlergia");
      validarCampo($("input[name='nDoenca']:checked").val(), "nQualDoenca");
      validarCampo(
         $("input[name='nDoencaFamilia']:checked").val(),
         "nQualDoencaFamilia"
      );
      validarCampo($("input[name='nLesao']:checked").val(), "nQualLesao");
      validarCampo(
         $("input[name='nMedicamento']:checked").val(),
         "nQualMedicamento"
      );
      validarCampo(
         $("input[name='nAtividadeFisica']:checked").val(),
         "nQualAtividadeFisica"
      );
      validarCampo(
         $("input[name='nSuplemento']:checked").val(),
         "nQualSuplemento"
      );
      //ao clicar
      $("input[name='nAlergia']").click(function () {
         validarCampo(this.value, "nQualAlergia");
      });
      $("input[name='nDoenca']").click(function () {
         validarCampo(this.value, "nQualDoenca");
      });
      $("input[name='nDoencaFamilia']").click(function () {
         validarCampo(this.value, "nQualDoencaFamilia");
      });
      $("input[name='nLesao']").click(function () {
         validarCampo(this.value, "nQualLesao");
      });
      $("input[name='nMedicamento']").click(function () {
         validarCampo(this.value, "nQualMedicamento");
      });
      $("input[name='nAtividadeFisica']").click(function () {
         validarCampo(this.value, "nQualAtividadeFisica");
      });
      $("input[name='nSuplemento']").click(function () {
         validarCampo(this.value, "nQualSuplemento");
      });
   });
}
