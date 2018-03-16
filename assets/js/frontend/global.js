function sessOut(data){
	if(data.success == 'out')
		window.location = data.url;
}
