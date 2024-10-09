$('.login-content [data-toggle="flip"]').click(function() 
{
	$('.login-box').toggleClass('flipped');
	return false;
});

//validación de formulario de login
document.addEventListener('DOMContentLoaded', function()
{
	if(document.querySelector("#formLogin"))
	{
		let formLogin = document.querySelector("#formLogin");
		formLogin.onsubmit = function(e) 
		{
			e.preventDefault();

			let strUsuario = document.querySelector('#txtUsuarioLogin').value;
			let strContraseña = document.querySelector('#txtContraseñaLogin').value;

			if(strUsuario == "" || strContraseña == "")
			{
				swal("Por favor", "Ingrese usuario y contraseña.", "error");
				return false;
			}
			else 
			{
				var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
				var ajaxUrl = base_url+'/Login/loginUsuario'; 
				var formData = new FormData(formLogin);
				request.open("POST",ajaxUrl,true);
				request.send(formData);

				//validación de lo datos de usuario
				request.onreadystatechange = function()
				{

					if(request.readyState != 4) return;
					if(request.status == 200){
						var objData = JSON.parse(request.responseText);
						if(objData.status)
						{
							window.location = base_url+'/principal';
						}else{
							swal("Atención", objData.msg, "error");
							document.querySelector('#txtContraseñaLogin').value = "";
						}
					}
					else
					{
						swal("Atención","Se produjo un error", "error");
					}
	
					return false;
				}
			}
		 }
	}

}, false);