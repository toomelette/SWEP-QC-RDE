

export default {

  methods: {


    utilJsonObjToArray(obj, id, text) {

	    var array = [];

	    if (Object.keys(obj).length != 0) {
		    Object.values(obj).forEach(val => {
		      array.push({id: val[id], text: val[text]});
		    });
	    }

	    return array;

    },



  }

}