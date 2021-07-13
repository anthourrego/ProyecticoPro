function RASTREO($cambio, $programa) {
	var date = new Date(),
		fecha = date.getFullYear() + "-" + date.getDate() + "-" + (date.getMonth() + 1) + " " +  date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
	return {
		fecha 	: 	fecha,
		programa: 	$programa,
		cambio 	: 	$cambio
	};
}