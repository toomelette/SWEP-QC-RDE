

export default {

  methods: {


    utilVSelectOptions(obj, id, text) {

	    var array = [];

	    if (Object.keys(obj).length != 0) {
		    Object.values(obj).forEach(val => {
		      array.push({code: val[id], label: val[text]});
		    });
	    }

	    return array;

    },



  }

}