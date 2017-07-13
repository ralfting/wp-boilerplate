<?php 

/*** INÍCIO - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/

$enviaFormularioParaNome = 'Contato - Global JR ESPM';
$enviaFormularioParaEmail = 'contato@globaljrpoa.com.br';

$caixaPostalServidorNome = $_POST['nome'];
$caixaPostalServidorEmail = 'contato@globaljrpoa.com.br';
$caixaPostalServidorSenha = '30ewg828!';

/*** FIM - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/ 


/* abaixo as veriaveis principais, que devem conter em seu formulario*/
$nome  =  $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$cidade = $_POST['cidade'];
$assunto  = $enviaFormularioParaNome;
$mensagem = $_POST['mensagem'];

$mensagemConcatenada = 'Nome: '.$nome.'<br/>'; 
$mensagemConcatenada .= 'E-mail: '.$email.'<br/>'; 
$mensagemConcatenada .= 'Telefone: '.$telefone.'<br/>'; 
$mensagemConcatenada .= 'Cidade: '.$cidade.'<br/>'; 
$mensagemConcatenada .= 'Mensagem: "'.$mensagem.'"<br/>';
$mensagemConcatenada .= '-------------------------------<br/><br/>'; 

/*********************************** A PARTIR DAQUI NAO ALTERAR ************************************/ 

require_once('PHPMailer/PHPMailerAutoload.php');

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->SMTPAuth  = true;
$mail->Charset   = 'utf8_decode()';
$mail->Host  = 'mail.'.substr(strstr($caixaPostalServidorEmail, '@'), 1);
$mail->Port  = '587';
$mail->Username  = $caixaPostalServidorEmail;
$mail->Password  = $caixaPostalServidorSenha;
$mail->From  = $caixaPostalServidorEmail;
$mail->FromName  = utf8_decode($caixaPostalServidorNome);
$mail->IsHTML(true);
$mail->Subject  = utf8_decode($assunto);
$mail->Body  = utf8_decode($mensagemConcatenada);
	//$mail->SMTPDebug  = 4; // enables SMTP debug information (for testing)



$mail->AddAddress($enviaFormularioParaEmail,utf8_decode($enviaFormularioParaNome));

if(!$mail->Send()){
	$mensagemRetorno = 'Erro ao enviar formulário: '. print($mail->ErrorInfo);
}else{
	$response = ['status', 'success'];
		return json_encode($response);
} 
?>
