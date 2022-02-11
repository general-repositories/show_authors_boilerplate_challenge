let isRan = false;

function showUsers(){

	const userList = document.getElementById('userList');
	const div = document.getElementById('showUsers');

	if(!isRan){

		isRan = true;

		fetch(ajax.url, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
			},
			body: `action=show_authors&nonce=${div.getAttribute('data-nonce')}`
		})
		.then(res=>res.json())
		.then(object=>{

			if(object.type != 'must login'){

				for(const key in object){
					
					if(key == 'success')continue;
					const element = document.createElement('li');
					element.innerText = `${object[key]} (${key != 'no_opt_message' ? key.slice(0, -6) : null})`;
					userList.appendChild(element);
				}
			}else alert('you must be logged in to see the list');
		});
	}
}