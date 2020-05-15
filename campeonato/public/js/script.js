//Get all days in a specific month
function getDaysInMonth(month, year) {
	return ((new Date (year, month)).getTime() - (new Date (year, month-1)).getTime())/(1000*60*60*24);
}

//this function get all dates for calendar
function set_calendar(matches,date_start_championship,teams){
	var array_date = date_start_championship.split('-');
	var d = new Date(array_date[0],parseInt(array_date[1]) - 1 ,array_date[2]);
	var number_day = d.getDay();
	var count_day_month = getDaysInMonth(array_date[1],array_date[0]);
	var date_temporal = array_date;
	var  info = new Array();
	var last = matches[0].team_one;

	for (var i = 0; i < matches.length; i++) {
		if(i == 20){
			var hola = 0;
		}
		if(last != matches[i].team_one ){
			array_date = date_start_championship.split('-');
			number_day = d.getDay();
			count_day_month = getDaysInMonth(array_date[1],array_date[0]);
		}
		date_temporal = get_date(matches[i].day,number_day,count_day_month,array_date);
		var date_temp  = new Date(date_temporal[0],parseInt(date_temporal[1]) - 1,date_temporal[2]);
		number_day = date_temp.getDay();
		count_day_month = getDaysInMonth(date_temporal[1],date_temporal[0]);
		date_temporal = check_exist_team_same_date(info,date_temporal,matches[i].team_one,matches[i].team_two,matches[i].day,number_day,count_day_month);


		var data = {
			title: matches[i].team_one + " vs " + matches[i].team_two ,
			start: date_temporal[0]+ "-" + date_temporal[1] +"-"+ date_temporal[2] + 'T' + convert_time_militar(matches[i].time_game)
		}
		info.push(data);
		last = matches[i].team_one;
		array_date = date_temporal;
	}
	return info;
}
//This function check that the team can only be there once in the same day
function check_exist_team_same_date(info,date_temporal,id_team_one,id_team_two,name_day,number_day,count_day_month){
	var entry = 0;
	var array_date = "";
	var date = date_temporal[0] + "-" + date_temporal[1] + "-" + date_temporal[2];
	var result = new Array();

	for (var i = 0; i < info.length; i++) {
		var id_teams = info[i].title.split('vs');
		var date_match = info[i].start.split("T");
		if(date == date_match[0]){
			if(id_teams[0] == id_team_one || id_teams[1] == id_team_two || id_teams[0] == id_team_two || id_teams[1] == id_team_one  ){
				array_date = get_date(name_day,number_day,count_day_month,date_temporal,);
				date_temp  = new Date(date_temporal[0],parseInt(date_temporal[1]) - 1,date_temporal[2]);
				number_day = date_temp.getDay();
				count_day_month = getDaysInMonth(array_date[1],array_date[0]);
				entry = 1;
			}
		}
	}
	if(entry == 1){
		entry = 0;
		result = 	check_exist_team_same_date(info,array_date,id_team_one,id_team_two,name_day,number_day,count_day_month);
		return result;
	}else{
		if(array_date != ""){
			result[0] = array_date[0].toString();
			result[1] = array_date[1].toString();
			result[2] = array_date[2].toString();
		}else{
			result[0] = date_temporal[0].toString();
			result[1] = date_temporal[1].toString();
			result[2] = date_temporal[2].toString();

		}
		return result;
	}

}
//this function set date of match in calendar
function get_date(name_day,number_day,count_day_month,array_date,time_matches){
	var result = 0;
	var month = parseInt(array_date[1]);
	var day  = parseInt(array_date[2]);
	var year = parseInt(array_date[0]);
	var local_number_day = get_number_day(name_day);
	var count_day = 0;
	while (true) {
		number_day = (number_day == 6) ? 0 : number_day + 1;
		count_day++;
		if(local_number_day == number_day){
			day += count_day;
			break;
		}
	}
	return 	validate_day_month_year(day,month,year,count_day_month,time_matches);
}
//This function validate day month and year is true
function validate_day_month_year(day,month,year,count_day_month,time_matches){
	if(day <= count_day_month){

	}else if(month < 12){
		day = day - count_day_month;
		month += 1;
	}else if(month == 12){
		year+= 1;
		month = 1;
		day = day - count_day_month;
	}
	month = (month.toString().length == 1) ? "0" + month.toString() : month;
	day = (day.toString().length == 1) ? "0" + day.toString() : day;
	var date = [year,month,day];
	return date;
}
//this function convert time to militar
function convert_time_militar(time_matches){
	var time = time_matches;
	var hours = Number(time.match(/^(\d+)/)[1]);
	var minutes = Number(time.match(/:(\d+)/)[1]);
	var am_pm = time.substr(time.length - 2);
	if(am_pm == "PM" && hours<12) hours = hours+12;
	if(am_pm == "AM" && hours==12) hours = hours-12;
	var sHours = hours.toString();
	var sMinutes = minutes.toString();
	if(hours<10) sHours = "0" + sHours;
	if(minutes<10) sMinutes = "0" + sMinutes;

	return sHours + ":" + sMinutes;
}
//get number of day
function get_number_day(name_day){
	var local_number_day = "";
	switch (name_day) {
		case "Lunes":
		local_number_day = 1;
		break;
		case "Martes":
		local_number_day = 2;
		break
		case "Miércoles":
		local_number_day = 3;
		break
		case "Jueves":
		local_number_day = 4;
		break
		case "Viernes":
		local_number_day = 5;
		break
		case "Sábado":
		local_number_day = 6;
		break
		case "Domingo":
		local_number_day = 0;
		break
		default:
	}
	return local_number_day;
}

//this function get name of team
function get_name_team(teams,id){
	for (var i = 0; i < teams.length; i++) {
		if(teams[i].id == id || teams[i].id == id){
			return teams[i].name;
		}
	}
}



$('#calendar').fullCalendar({
	monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
	monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
	dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
	dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
	locale: 'es',
	timeZone: 'local',
	timeFormat: 'hh:mm a',
	header: {
		left: 'prev,next today',
		center: 'title',
		right: 'month'
	},
	buttonText: {
		today:    'Hoy',
		month:    'Mes',
		list:     'Lista',
	},

	editable: false,
	eventLimit: true, // allow "more" link when too many events
	eventColor: '#3490dc',

	events: function(start, end, timezone, callback) {
		var id_championship = "";
		var url =(window.location.pathname).toString();
		id_championship = url.split('/', 4)[3];
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: '/calendar/get_match/'+id_championship,
			type: 'get',
			data: {
				"_token": $('meta[name="csrf-token"]').attr('content') ,
			},
			success: function(response) {
				var away_match = [];
				var all_matches = [];
				var rematch = [];
				response['matches'].sort((a, b) => (a.team_one > b.team_one) ? 1 : -1);
				away_match = set_calendar(response['matches'],response['start_championship'][0].start_championship,response['teams']);
				if(response['matches'][0].round_trip_match == 1){
					var matches = 	reverse_teams(response['matches']);
					matches.sort((a, b) => (a.team_one > b.team_one) ? 1 : -1);
					var last_date = get_last_date(away_match);
					rematch = set_calendar(matches,last_date,response['teams']);
				}
				all_matches = add_event_fullcalendar(away_match,rematch,response['teams']);
				callback(all_matches);
			}
		});
	},

	eventClick: function(event) {
		if (event.url) {
			$.magnificPopup.open({
				items: {
					iframe: event.url,
					type: 'iframe'
				}

			});
		}
	}

});
//this function set all event to play soccer
function add_event_fullcalendar(away_match,rematch,teams){
	var  info_about_match = new Array();
	for (var i = 0; i < away_match.length; i++) {
		var id_teams = away_match[i].title.split('vs');
		var data = {
			title: get_name_team(teams,id_teams[0]) + " vs " + get_name_team(teams,id_teams[1]) ,
			start: away_match[i].start
		}
		info_about_match.push(data);
	}
	for (var i = 0; i < rematch.length; i++) {
		var id_teams = rematch[i].title.split('vs');
		var data = {
			title: get_name_team(teams,id_teams[0]) + " vs " + get_name_team(teams,id_teams[1]) ,
			start: rematch[i].start
		}
		info_about_match.push(data);
	}
	return info_about_match;
}
//this function reverse all teams for play again
function reverse_teams(matches){
	var first_team = "";
	var second_team = "";
	for (var i = 0; i < matches.length; i++) {
		first_team = matches[i].team_one;
		second_team = matches[i].team_two;
		matches[i].team_one = second_team;
		matches[i].team_two = first_team;
	}
	return matches;
}
//This function get last date
function get_last_date(all_matches){
	var last_date = all_matches[0].start;
	var temp_date = "";
	for (var i = 0; i < all_matches.length; i++) {
		temp_date = all_matches[i].start;
		temp_date = temp_date.split('T')[0];
		if( temp_date > last_date){
			last_date = temp_date;
		}
	}
	return last_date;
}
