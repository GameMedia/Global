var backstretch = function () {

    return {
        //main function to initiate the module
        init: function () {

             $.backstretch([
		        "assets/images/backend/1.jpg",
				"assets/images/backend/2.jpg",
				"assets/images/backend/3.jpg",
				"assets/images/backend/4.jpg"
		        ], {
		          fade: 1000,
		          duration: 8000
		      });
        }

    };

}();
