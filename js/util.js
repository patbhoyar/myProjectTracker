function getURLParam(name) {
	var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
	if (results != null) 
		return results[1];
	else
		return 0;
};


var Util = new (function () {

	var months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

	/*
		objectType 	: clients, projects, tasks
		object 		: object to sort
		sortBy		: parameter to sort by
		sortOrder	: asc, desc
	*/
	this.sortObject = function (objectType, object, sortBy, sortByType, sortOrder){

		switch(objectType){
			case "clients":

				break;
			case "projects":
					if (sortByType == "int")
						return this.sortInt(object, sortBy, sortOrder);

					if (sortByType == "string")
						return this.sortString(object, sortBy, sortOrder);
				break;
			case "tasks":
				
				break;
		}
	};

	this.sortInt = function (object, sortBy, sortOrder){

		if (sortOrder == "asc") {
			return object.sort(function(a, b){
			 	return a[sortBy] - b[sortBy];
			});
		}else if(sortOrder == "desc"){
			return object.sort(function(a, b){
			 	return b[sortBy] - a[sortBy];
			});
		}

		return object.sort(function(a, b){
		 	return a[sortBy] - b[sortBy];
		});
	};

	this.sortString = function (object, sortBy, sortOrder){

		if (sortOrder == "asc") {
			return object.sort(function(a, b){
				var nameA = a[sortBy].toLowerCase(), nameB = b[sortBy].toLowerCase();
				 	if (nameA < nameB) //sort string ascending
				  		return -1; 
				 	if (nameA > nameB)
				  		return 1;
				 	return 0; //default return value (no sorting)
			});
		}else if(sortOrder == "desc"){
			return object.sort(function(a, b){
				var nameA = a[sortBy].toLowerCase(), nameB = b[sortBy].toLowerCase();
				 	if (nameA > nameB) //sort string descending
				  		return -1; 
				 	if (nameA < nameB)
				  		return 1;
				 	return 0; //default return value (no sorting)
			});
		}

		return object.sort(function(a, b){
			var nameA = a[sortBy].toLowerCase(), nameB = b[sortBy].toLowerCase();
			 	if (nameA < nameB) //sort string ascending
			  		return -1; 
			 	if (nameA > nameB)
			  		return 1;
			 	return 0; //default return value (no sorting)
		});
	};

	this.sortDate = function (object, sortBy, sortOrder){

		if (sortOrder == "asc") {
			return object.sort(function(a, b){
			 	var dateA = new Date(a[sortBy]), dateB = new Date(b[sortBy]);
			 	return dateA - dateB; //sort by date ascending
			});
		}else if(sortOrder == "desc"){
			return object.sort(function(a, b){
			 	var dateA = new Date(a[sortBy]), dateB = new Date(b[sortBy]);
			 	return dateB - dateA; //sort by date descending
			});
		}


		return object.sort(function(a, b){
		 	var dateA = new Date(a[sortBy]), dateB = new Date(b[sortBy]);
		 	return dateA - dateB; //sort by date ascending
		});
	};

	this.formatDate = function(date){

		var newDate = new Date(date);
		var dd = newDate.getDate();
		var mm = newDate.getMonth()+1; 
		var yyyy = newDate.getFullYear();
		if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} 
		newDate = mm+'/'+dd+'/'+yyyy;
		
		return newDate;

	}

	this.getTodaysDate = function (){

		var today = new Date();
		return this.formatDate(today);
	};

	this.getPrettyDate = function(date){

		var date = new Date(date);
		var dd = date.getDate();
		var mm = date.getMonth(); 
		var yyyy = date.getFullYear();
		if(dd<10){dd='0'+dd}
		var prettyDate = months[mm]+" "+dd+", "+yyyy;

		return prettyDate;
	};

	this.prevDate = function(date){
		var prevDate = new Date(new Date(date).getTime() - 24 * 60 * 60 * 1000);
		return this.formatDate(prevDate);
	}

	this.nextDate = function(date){
		var nextDate = new Date(new Date(date).getTime() + 24 * 60 * 60 * 1000);
		return this.formatDate(nextDate);
	}








































































});