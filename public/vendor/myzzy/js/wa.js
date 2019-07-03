
function enviaMensage(){


    var options = {
 whatsapp: "+5561984548100", // Número do WhatsApp
 company_logo_url: "MYZZY", // URL com o logo da empresa
 greeting_message: "Olá! Bem Vindo à Myzzy.", // Texto principal
 call_to_action: "Precisando de um projeto? Contate-nos no WhatsApp.", // Chamada para ação
 position: "right", // Posição do widget na página 'right' ou 'left'
 };
 var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
 var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
 s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
 var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
 

	


}





 
