/* iubito's menu - http://iubito.free.fr/prog/menu.php - configuration du javascript */


/* true = le menu sera vertical, à gauche.
   false = le menu sera horizontal, en haut. */
var vertical = false;

/* TRES IMPORTANT !
	Il faut mettre ici le nombre de menus, le script n'est pas capable de compter tout
	seul ! :-p Donc si votre code va jusqu'à <p id="menu5"...> il faut mettre 5. */
	
var nbmenu = 8;



/* Centrer le menu ? (true/false).
	Centre horizontalement ou verticalement suivant le mode choisi. */
var centrer_menu = true;

/* On est obligé de définir une largeur pour les menus. */
var largeur_menu = 105;

/* En mode vertical, on a besoin de connaître la hauteur de chaque menu.
	Même si les "cases" ne sont pas dimensionnées en hauteur.
	Ajustez cette variable si les menus sont trop rapprochés ou espacés en vertical. */
var hauteur_menu = 25;

/* En mode horizontal.
	Largeur des sous-menus, pour IE uniquement, les autres navigateurs respectent la largeur
	auto. Mettez "auto" uniquement si vous êtes sûr d'avoir mis des &nbsp; à la place des
	espace dans les items ! */
var largeur_sous_menu = 105;

/* ... pour mettre un peu d'espace entre les menus ! */
var espace_entre_menus = 1;


/* position du menu par rapport au haut de l'écran ou de la page.
	0 = le menu est tout en haut. en px */
var top_menu = 2;
/* En version horizontale.
	position des sous-menus par rapport au haut de l'écran ou de la page. Il faut prévoir
	la hauteur des menus, donc ne pas mettre 0 et faire "à tâton". en px */
var top_ssmenu = top_menu + 65;

/* Position gauche du menu, en px. */
var left_menu = 0;
/* En version verticale.
	Position des sous-menus par rapport au bord gauche de l'écran. */
var left_ssmenu = largeur_menu+2;


/* Quand la souris quitte un sous-menu, si le sous-menu disparait immédiatement,
	cela gêne l'utilisateur. Alors on peut mettre un délai avant disparition du sous-menu.
	500 ms c'est bien :-) */
var delai = 650; // en milliseconde

/* En version horizontale.
	Comme le menu peut se superposer avec le texte de la page, il est possible de faire
	descendre un peu la page (on augmente la marge du haut) pour aérer un peu la page,
	une quarantaine de pixel c'est pas mal. en px*/
var marge_en_haut_de_page = top_menu + 90;
/* En version verticale.
	On décale le document à droite pour pas que le menu le superpose. */
var marge_a_gauche_de_la_page = largeur_menu + 10;


/* Mettez à true si vous souhaitez que le menu soit toujours visible.
	Mettez false si vous ne le souhaitez pas, dans ce cas le menu "disparaîtra" quand vous
	descendrez dans la page. */
var suivre_le_scroll=false;



var timeout; //ne pas toucher, c'est pour déclarer la variable
var agt = navigator.userAgent.toLowerCase();
var isMac = (agt.indexOf('mac') != -1);
var isOpera = (agt.indexOf("opera") != -1);
var IEver = parseInt(agt.substring(agt.indexOf('msie ') + 5));
var isIE = ((agt.indexOf('msie')!=-1 && !isOpera && (agt.indexOf('webtv')==-1)) && !isMac);
var isIE5win = (isIE && IEver == 5);
var isIE5mac = ((agt.indexOf("msie") != -1) && isMac);
var blnOk=true;

// onScroll pour Internet Explorer, le position:fixed fait ce boulot pour les autres navigateurs
// qui respectent les normes CSS...
window.onscroll = function()
{
	if (blnOk && suivre_le_scroll && (isIE || isIE5mac))
	{
		for(i=1;i<=nbmenu;i++)
		{
			if (!vertical) {
				document.getElementById("menu"+i).style.top = document.body.scrollTop + top_menu + "px";
				if (document.getElementById("ssmenu"+i))//undefined
					document.getElementById("ssmenu"+i).style.top = document.body.scrollTop + top_ssmenu + "px";
			} else {
				document.getElementById("menu"+i).style.top = document.body.scrollTop
							+(((i-1)*(hauteur_menu+espace_entre_menus))+1+top_menu)+"px";
				if (document.getElementById("ssmenu"+i))//undefined
					document.getElementById("ssmenu"+i).style.top = document.body.scrollTop
							+(((i-1)*(hauteur_menu+espace_entre_menus))+1+top_menu)+"px";
					
			}
		}
	}
}

function preChargement()
{
	if (document.getElementById("conteneurmenu"))
	{
		document.getElementById("conteneurmenu").style.visibility="hidden";
		//IE5 mac a un bug : quand un texte est dans un élément de style float, il n'apparait pas.
		/*if (isIE5mac)
		{
			document.getElementById("conteneurmenu").style="";
		}*/
	}
}

function Chargement() {
	if(document.body.style.backgroundColor!="") { blnOk=false; }
	if(document.body.style.color!="") { blnOk=false; }
	if(document.body.style.marginTop!="") { blnOk=false; }
	if(document.getElementById) {
		with(document.getElementById("texte").style) {
			if(position!="" || top!="" || left!=""
					|| width!="" || height!="" || zIndex!=""
					|| margin!="" || visibility!="") {
				blnOk=false;
			}
		}
	}
	else{
		blnOk=false;
	}

	if(blnOk)
	{
		trimespaces();
		
		with(document.body.style) {
			if (!vertical) marginTop=marge_en_haut_de_page;
			else		   marginLeft=marge_a_gauche_de_la_page;
		}
		
		if (centrer_menu) {
			if (!vertical) {
				var largeur_totale = (largeur_menu * nbmenu) + (espace_entre_menus * (nbmenu-1));
				var largeur_fenetre = (isIE?document.body.clientWidth:window.innerWidth);
				left_menu = (largeur_fenetre - largeur_totale)/2;
			} else {
				var hauteur_fenetre = (isIE?document.body.clientHeight:window.innerHeight);
				var hauteur_totale = (hauteur_menu * nbmenu) + (espace_entre_menus * (nbmenu-1));
				top_menu = (hauteur_fenetre - hauteur_totale)/2;
			}
		}

		for(i=1;i<=nbmenu;i++) {
			with(document.getElementById("menu"+i).style) {
				if (!vertical) {
					top=top_menu+"px";
					left=(((i-1)*(largeur_menu+espace_entre_menus))+1+left_menu)+"px";
				} else {
					top=(((i-1)*(hauteur_menu+espace_entre_menus))+1+top_menu)+"px";
					left=left_menu+"px";
				}
				if (!suivre_le_scroll || isIE || isIE5mac)
					position="absolute";
				else position="fixed";
				width=largeur_menu+"px";
				//if (vertical) height=hauteur_menu+"px";
				margin="0";
				zIndex="2";
			}
		}

		for(i=1;i<=nbmenu;i++) {
			if (document.getElementById("ssmenu"+i))//undefined
			{
				with(document.getElementById("ssmenu"+i).style) {
					if (!suivre_le_scroll || isIE || isIE5mac)
						position="absolute";
					else position="fixed";
					if (!vertical) {
						top=top_ssmenu+"px";
						left=(((i-1)*(largeur_menu+espace_entre_menus))+1+left_menu)+"px";
					} else {
						left=left_ssmenu+"px";
						top=(((i-1)*(hauteur_menu+espace_entre_menus))+1+top_menu)+"px";
					}
					if (isIE||isOpera||isIE5mac)
						width = largeur_sous_menu+(largeur_sous_menu!="auto"?"px":"");
					else width = largeur_sous_menu+(largeur_sous_menu!="auto"?"px":"");
					margin="0";
					zIndex="3";
				}
			}
		}

		CacherMenus();
	}

	// comme on a évité le clignotement, maintenant on fait apparaître le menu ;-)
	document.getElementById("conteneurmenu").style.visibility = "visible";
}


function MontrerMenu(strMenu) {
	if(blnOk) {
		AnnulerCacher();
		CacherMenus();
		if (document.getElementById(strMenu))//undefined
			with (document.getElementById(strMenu).style)
				visibility="visible";
	}
	SelectVisible("hidden",document.getElementsByTagName('select'));
}

function CacherDelai() {
	if (blnOk) {
		timeout = setTimeout('CacherMenus()',delai);
	}
}
function AnnulerCacher() {
	if (blnOk && timeout) {
		clearTimeout(timeout);
	}
}
function CacherMenus() {
	if(blnOk) {
		for(i=1;i<=nbmenu;i++) {
			if (document.getElementById("ssmenu"+i))//undefined
				with(document.getElementById("ssmenu"+i).style)
					visibility="hidden";
		}
	}
	SelectVisible("visible",document.getElementsByTagName('select'));
}

function trimespaces() {
	//Contourne un bug d'IE5/win... il ne capte pas bien les css pour les <li>, donc on les vire !
	if(blnOk&&isIE5win) {
		for(i=1;i<=nbmenu;i++) {
			if (document.getElementById("ssmenu"+i))//undefined
				with(document.getElementById("ssmenu"+i))
					innerHTML = innerHTML.replace(/<LI>|<\/LI>/g,"");
		}
	}
}

function SelectVisible(v,elem) {
	if (blnOk && (isIE||isIE5win))
		for (var i=0;i<elem.length;i++) elem[i].style.visibility=v;
}
