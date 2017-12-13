

function displayValid(){
	document.getElementById('subMail').textContent = "VALIDER_";
	document.getElementById('subMail').disabled = false;
	var classesFocus = ['subMail','tr1_L','tr2_L','dot1']
	for (var i = 0; i < classesFocus.length; i++) {
		document.getElementById(classesFocus[i]).classList.add(classesFocus[i]+'Focus');
	}
}

function valideMail() {
	var mail = document.getElementById('inMail').value;
	var match = mail.match('^[_.0-9a-z-]+@([0-9a-z][0-9a-z_-]+.)+[a-z]{2,4}$');

  	if (!match) {
		var redRec = document.createElement('div');
		redRec.id = 'redRec';
		document.getElementById('midRecWrap').appendChild(redRec);
		redRec.innerHTML = '<a href="index.php#sectionBas" id="link" onclick="HideRedRec();">STATUT:<br><span id="refuse">REFUSÉ</span></a>';
		document.getElementById('subMail').innerHTML = 'Entrez Email';
		var classesFocus = ['subMail','tr1_L','tr2_L','dot1']
		for (var i = 0; i < classesFocus.length; i++) {
			document.getElementById(classesFocus[i]).classList.remove(classesFocus[i]+'Focus');
		}
		return false;
		}
	}

function HideRedRec() {
	document.getElementById('redRec').remove();
}

// function scrollToBottom(){
// 	document.scrollTo(0,document.body.scrollHeight);
// }

function scrollToBottom() {
    if (typeof(scr1)!='undefined') clearTimeout(scr1)   
    var scrollTop = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
    var scrollHeight = (document.documentElement && document.documentElement.scrollHeight) || document.body.scrollHeight;
    if((scrollTop + window.innerHeight) >= scrollHeight-50) window.scrollTo(0,scrollHeight+50)
    scr1=setTimeout(function(){scrollbottom()},200) 
 }

function reset(){
	sessionStorage.removeItem('valid');
	sessionStorage.removeItem('popUp');
	sessionStorage.removeItem('card');
}

function displayPop(){

	document.getElementById('formPopUp').style.opacity = 0;
    document.getElementById('formPopUp').style.display = 'initial';
    setTimeout(function(){document.getElementById('formPopUp').style.opacity = 1;}, 100); 
	// for(var i=0.1; i<1; i+=0.1) {
	//     document.getElementById('formPopUp').style.opacity = i;
	// }
	
	document.getElementById('formPopUp').classList.add('bckgA');
	//sessionStorage.setItem('popUp', 1);	
}
function hiddenPop() {
	setTimeout(function(){document.getElementById('formPopUp').style.opacity = 0;}, 100); 
    setTimeout(function(){document.getElementById('formPopUp').style.display = 'none';}, 500);
	document.getElementById('formPopUp').classList.add('bckgA');
}

if (sessionStorage.getItem('valid') == 1) {			
	var confirmRec = document.createElement('div');
	confirmRec.id = 'confirmRec';
	document.getElementById('midRecWrap').appendChild(confirmRec);
	document.getElementById('confirmRec').innerHTML = 'STATUT:<br><span id="ok">CONFIRMÉ</span>';
	document.getElementById('subMail').textContent = "Rejoignez Cystopia_";
	var classesConf = ['subMail','tr1_R','tr2_R','tr3_R','dot2','msg'];
	for (var i = 0; i < classesConf.length; i++) {
		document.getElementById(classesConf[i]).classList.add(classesConf[i]+'Conf');
	}
}

if (sessionStorage.getItem('popUp') == 1){
	
}

if (sessionStorage.getItem('card') == 1){
	document.getElementById('popForm').style.display = 'none';
	document.getElementById('formPopUp').classList.add('bckgB');
	document.getElementById('contact').innerHTML = 'Message OK_';
	document.getElementById('contact').href = 'index.php';
	document.getElementById('contact').onclick = reset();
}

function refreshPage(){
    var page_y = document.getElementsByTagName('body')[0].scrollTop;
    window.location.href = window.location.href.split('?')[0] + '?page_y=' + page_y;
}
window.onload = function(){
    setTimeout(refreshPage, 35000);
    if ( window.location.href.indexOf('page_y') != -1 ) {
        var match = window.location.href.split('?')[1].split("&")[0].split("=");
        document.getElementsByTagName('body')[0].scrollTop = match[1];
    }
};


