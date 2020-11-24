

export const getHeader = function(){

	const tokenData = JSON.parse(window.localStorage.getItem('auth_usr'))

	const headers = {
		'Accept': 'application/json',
		'Authorization': 'Bearer ' + tokenData.access_token
	}

	return headers

}