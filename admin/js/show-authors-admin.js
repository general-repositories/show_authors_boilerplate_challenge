
function saveOptions(){

	let adminSet = false;
	let authorSet = false;
	let editorSet = false;

	if(document.getElementById('admin').checked)adminSet = true;
	if(document.getElementById('author').checked)authorSet = true;
	if(document.getElementById('editor').checked)editorSet = true;

	fetch(ajax.url, {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
		},
		body: `action=save_options&admin=${adminSet}&author=${authorSet}&editor=${editorSet}`
	})
	.then(res=>res.json())
	.then(object=>{
		
		if(object.success){

			document.getElementById('show-saved').style.opacity = 1;
	
			setTimeout(()=>{
				document.getElementById('show-saved').style.opacity = 0;
			}, 1500);
		}else{

			document.getElementById('saved-heading').innerText = 'Error';
			document.getElementById('show-saved').style.opacity = 1;
	
			setTimeout(()=>{
				document.getElementById('show-saved').style.opacity = 0;
			}, 1500);
		}
	});
}

