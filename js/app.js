// init materialize
document.addEventListener('DOMContentLoaded', function(){
	//Collapsible
	var elemsc = document.querySelectorAll('.collapsible');
	var instances = M.Collapsible.init(elemsc);
	//Dropdown
	var elemsd = document.querySelectorAll('.dropdown-trigger');
	var instances = M.Dropdown.init(elemsd);
	//Modals
	var elemsm = document.querySelectorAll('.modal');
	var instances = M.Modal.init(elemsm);
	//Slidenav
	var elemsv = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elemsv);
	//Tooltips
	var elems = document.querySelectorAll('.tooltipped');
	var instances = M.Tooltip.init(elems);
	//Material Box
	var elemsx = document.querySelectorAll('.materialboxed');
	var instances = M.Materialbox.init(elemsx);
	//Slider
	var elemsr = document.querySelectorAll('.slider');
	var instances = M.Slider.init(elemsr);
	//Parallax
	var paralax_elemens = document.querySelectorAll('.parallax');
	var instances = M.Parallax.init(paralax_elemens);
    //Toast
    // var toastElement = document.querySelector('.toast');
	// var toastInstance = M.Toast.getInstance(toastElement);
	// toastInstance.dismiss();
	var elemsB = document.querySelectorAll('.fixed-action-btn');
	var instances = M.FloatingActionButton.init(elemsB);
});