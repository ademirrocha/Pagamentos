<!-- WhatsHelp.io widget-->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"
  integrity="sha256-7LkWEzqTdpEfELxcZZlS6wAx5Ff13zZ83lYO2/ujj7g=" crossorigin="anonymous"></script>
<!--query sendo carregado em sua página -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<style>
  .wc_whatsapp_app {
    position: fixed;
    bottom: 30px;
    z-index: 9999999999;
    /Força o widget ficar acima de qualquer elemento/
    display: flex;
    align-items: center;
  }

  .wc_whatsapp_app.left {
    left: 15px;
  }

  .wc_whatsapp_app.right {
    right: 15px;
  }

  .wc_whatsapp {
    width: 50px;
    height: 50px;
    display: block;
    border-radius: 50%;
    background: #25d366;
    box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.4);
  }

  .wc_whatsapp:hover,
  .wc_whatsapp:focus {
    box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
  }

  .wc_whatsapp::before {
    content: "";
    display: block;
    background: url("data:image/svg+xml;charset=UTF-8,%3csvg aria-hidden='true' focusable='false' data-prefix='icon' data-icon='whatsapp' class='svg-inline' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'%3e%3cpath fill='%23fff' d='M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z'%3e%3c/path%3e%3c/svg%3e") top center no-repeat;
    height: 35px;
    margin-top: 6px;
  }

  .wc_whatsapp p {
    font-family: 'Arial', sans-serif;
  }

  .wc_whatsapp_secondary,
  .wc_whatsapp_primary {
    display: none;
  }

  .wc_whatsapp_secondary {
    max-width: 300px;
  }

  .wc_whatsapp_secondary p {
    margin-left: 15px;
    border: 1px solid #e2e2e2;
    padding: 5px 10px;
    border-radius: 5px;
    position: relative;
    color: #000;
    font-size: 14px;
    background: #fff;
  }

  .wc_whatsapp_secondary p::before {
    top: 20px;
    left: -9px;
    content: '';
    position: absolute;
    background: white;
    border-bottom: 1px solid #e2e2e2;
    border-right: 1px solid #e2e2e2;
    left: -5px;
    top: 50%;
    margin-top: -4px;
    width: 8px;
    height: 8px;
    z-index: 1;
    -ms-transform: rotate(135deg);
    -webkit-transform: rotate(135deg);
    -moz-transform: rotate(135deg);
    -o-transform: rotate(135deg);
    transform: rotate(135deg);
  }

  .wc_whatsapp_primary {
    border-radius: 5px;
    border: 1px solid #eaeaea;
    background: #fff;
    padding: 10px;
    bottom: 70px;
    align-items: center;
    max-width: 350px;
    box-shadow: 7px 7px 15px 8px rgba(0, 0, 0, 0.17);
    position: absolute;
    width: 350px;
  }

  .wc_whatsapp_primary img {
    width: 50px;
    border-radius: 5px;
    margin-left: 10px;
  }

  .wc_whatsapp_primary p {
    margin: 20px;
    border: 1px solid #e2e2e2;
    padding: 10px;
    border-radius: 5px;
    position: relative;
    color: #000;
    font-size: 14px;
  }

  .wc_whatsapp_primary p::before {
    top: 20px;
    left: -9px;
    content: '';
    position: absolute;
    background: white;
    border-bottom: 1px solid #e2e2e2;
    border-right: 1px solid #e2e2e2;
    left: -5px;
    top: 50%;
    margin-top: -4px;
    width: 8px;
    height: 8px;
    z-index: 1;
    -ms-transform: rotate(135deg);
    -webkit-transform: rotate(135deg);
    -moz-transform: rotate(135deg);
    -o-transform: rotate(135deg);
    transform: rotate(135deg);
  }

  .wc_whatsapp_primary .close {
    position: absolute;
    right: 10px;
    top: 10px;
    font-size: 14px;
    color: #000;
    opacity: .5;
  }

  .wc_whatsapp_primary .close:hover,
  .wc_whatsapp_primary .close:focus {
    color: #f00;
    opacity: 1;
  }
</style>
<script type='text/javascript'>

  $(document).ready(function () {
    var cookieMessagePrimary = $.cookie("wc_whatsapp_primary");
    if (cookieMessagePrimary !== '1') {
      $.cookie("wc_whatsapp_primary", 1, { expires: 5.000 }); //Mensagem Principal volta exibir após de 30 dias
      setTimeout(showMessagePrimary, 4000);
    } else {
      //se tiver no mobile, a mensagem primária não exibe
      if (screen.width > 550) {
        setTimeout(showMessageSecondary, 4000);
      }
    }
    //esconde mensagem secundária ao clicar
    $('.wc_whatsapp_secondary').click(function () {
      $(this).fadeOut(400);
    });
    //esconde mensagem primária ao clicar
    $('.wc_whatsapp_primary').click(function () {
      $(this).fadeOut(400);
    });
    //controla botão de fechar da mensagem primária
    $('.wc_whatsapp_primary .close').click(function () {
      $('.wc_whatsapp_primary').fadeOut(400);
      return false;
    });
    //esconde mensagem secundária ao passar o mouse no botão
    $('.wc_whatsapp').hover(function () {
      $('.wc_whatsapp_secondary').fadeOut(400);
    });

    //função para exibir mensagem secundária
    function showMessageSecondary() {
      $('.wc_whatsapp_secondary').fadeIn(400);
    }

    //função para exibir mensagem primária
    function showMessagePrimary() {
      $('.wc_whatsapp_primary').fadeIn(400).css("display", "flex");
    }
  });

  function open(){
    window.open('https://wa.me/5561984548100', '_blank');
  }

</script>
<div class="wc_whatsapp_app left">
  <a href="https://wa.me/5561984548100" target="_blank" class="wc_whatsapp" alt="Contate-nos no WhatsApp"  title="Contate-nos no WhatsApp">
    <span class="wc_whatsapp_primary">
      <span class="close">x</span>
      <img src="http://localhost//imag/logo.jpg" />
      <p>Olá, Seja bem Vindo(a) !<br> Em que podemos ajudar? Clica aqui e fale conosco.</p>
    </span>
  </a>
  <a href="https://wa.me/5561995711230" target="_blank" class="wc_whatsapp_secondary">
    <p>Solicitar Orçamento Grátis</p>
  </a>
</div>
<!--/WhatsHelp.io widget -->