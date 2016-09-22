<?php 
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2004 Guy Hendrickx
 * 
 * Licensed under the terms of the GNU  General Public License:
 * 		http://www.opensource.org/licenses/gpl-license.php
 * 
 * For further information visit:
 * 		http://factux.sourceforge.net
 * 
 * File Name: menu.inc.php
 * 	menu d'inclusion dans les themes personalisés
 * 
 * * Version:  1.1.5
 * * * Modified: 23/07/2005
 * 
 * File Authors:
 * 		Guy Hendrickx
 *.
 */
 ?> 

<script type="text/javascript">

//*****************************************************************************
// Do not remove this notice.
//
// Copyright 2000-2004 by Mike Hall.
// See http://www.brainjar.com for terms of use.
//*****************************************************************************

//----------------------------------------------------------------------------
// Code to determine the browser and version.
//----------------------------------------------------------------------------

function Browser() {

  var ua, s, i;

  this.isIE    = false;  // Internet Explorer
  this.isOP    = false;  // Opera
  this.isNS    = false;  // Netscape
  this.version = null;

  ua = navigator.userAgent;

  s = "Opera";
  if ((i = ua.indexOf(s)) >= 0) {
    this.isOP = true;
    this.version = parseFloat(ua.substr(i + s.length));
    return;
  }

  s = "Netscape6/";
  if ((i = ua.indexOf(s)) >= 0) {
    this.isNS = true;
    this.version = parseFloat(ua.substr(i + s.length));
    return;
  }

  // Treat any other "Gecko" browser as Netscape 6.1.

  s = "Gecko";
  if ((i = ua.indexOf(s)) >= 0) {
    this.isNS = true;
    this.version = 6.1;
    return;
  }

  s = "MSIE";
  if ((i = ua.indexOf(s))) {
    this.isIE = true;
    this.version = parseFloat(ua.substr(i + s.length));
    return;
  }
}

var browser = new Browser();

//----------------------------------------------------------------------------
// Code for handling the menu bar and active button.
//----------------------------------------------------------------------------

var activeButton = null;

// Capture mouse clicks on the page so any active button can be
// deactivated.

if (browser.isIE)
  document.onmousedown = pageMousedown;
else
  document.addEventListener("mousedown", pageMousedown, true);

function pageMousedown(event) {

  var el;

  // If there is no active button, exit.

  if (activeButton == null)
    return;

  // Find the element that was clicked on.

  if (browser.isIE)
    el = window.event.srcElement;
  else
    el = (event.target.tagName ? event.target : event.target.parentNode);

  // If the active button was clicked on, exit.

  if (el == activeButton)
    return;

  // If the element is not part of a menu, reset and clear the active
  // button.

  if (getContainerWith(el, "DIV", "menu") == null) {
    resetButton(activeButton);
    activeButton = null;
  }
}

function buttonClick(event, menuId) {

  var button;

  // Get the target button element.

  if (browser.isIE)
    button = window.event.srcElement;
  else
    button = event.currentTarget;

  // Blur focus from the link to remove that annoying outline.

  button.blur();

  // Associate the named menu to this button if not already done.
  // Additionally, initialize menu display.

  if (button.menu == null) {
    button.menu = document.getElementById(menuId);
    if (button.menu.isInitialized == null)
      menuInit(button.menu);
  }

  // Reset the currently active button, if any.

  if (activeButton != null)
    resetButton(activeButton);

  // Activate this button, unless it was the currently active one.

  if (button != activeButton) {
    depressButton(button);
    activeButton = button;
  }
  else
    activeButton = null;

  return false;
}

function buttonMouseover(event, menuId) {

  var button;

  // Find the target button element.

  if (browser.isIE)
    button = window.event.srcElement;
  else
    button = event.currentTarget;

  // If any other button menu is active, make this one active instead.

  if (activeButton != null && activeButton != button)
    buttonClick(event, menuId);
}

function depressButton(button) {

  var x, y;

  // Update the button's style class to make it look like it's
  // depressed.

  button.className += " menuButtonActive";

  // Position the associated drop down menu under the button and
  // show it.

  x = getPageOffsetLeft(button);
  y = getPageOffsetTop(button) + button.offsetHeight;

  // For IE, adjust position.

  if (browser.isIE) {
    x += button.offsetParent.clientLeft;
    y += button.offsetParent.clientTop;
  }

  button.menu.style.left = x + "px";
  button.menu.style.top  = y + "px";
  button.menu.style.visibility = "visible";

  // For IE; size, position and show the menu's IFRAME as well.

  if (button.menu.iframeEl != null)
  {
    button.menu.iframeEl.style.left = button.menu.style.left;
    button.menu.iframeEl.style.top  = button.menu.style.top;
    button.menu.iframeEl.style.width  = button.menu.offsetWidth + "px";
    button.menu.iframeEl.style.height = button.menu.offsetHeight + "px";
    button.menu.iframeEl.style.display = "";
  }
}

function resetButton(button) {

  // Restore the button's style class.

  removeClassName(button, "menuButtonActive");

  // Hide the button's menu, first closing any sub menus.

  if (button.menu != null) {
    closeSubMenu(button.menu);
    button.menu.style.visibility = "hidden";

    // For IE, hide menu's IFRAME as well.

    if (button.menu.iframeEl != null)
      button.menu.iframeEl.style.display = "none";
  }
}

//----------------------------------------------------------------------------
// Code to handle the menus and sub menus.
//----------------------------------------------------------------------------

function menuMouseover(event) {

  var menu;

  // Find the target menu element.

  if (browser.isIE)
    menu = getContainerWith(window.event.srcElement, "DIV", "menu");
  else
    menu = event.currentTarget;

  // Close any active sub menu.

  if (menu.activeItem != null)
    closeSubMenu(menu);
}

function menuItemMouseover(event, menuId) {

  var item, menu, x, y;

  // Find the target item element and its parent menu element.

  if (browser.isIE)
    item = getContainerWith(window.event.srcElement, "A", "menuItem");
  else
    item = event.currentTarget;
  menu = getContainerWith(item, "DIV", "menu");

  // Close any active sub menu and mark this one as active.

  if (menu.activeItem != null)
    closeSubMenu(menu);
  menu.activeItem = item;

  // Highlight the item element.

  item.className += " menuItemHighlight";

  // Initialize the sub menu, if not already done.

  if (item.subMenu == null) {
    item.subMenu = document.getElementById(menuId);
    if (item.subMenu.isInitialized == null)
      menuInit(item.subMenu);
  }

  // Get position for submenu based on the menu item.

  x = getPageOffsetLeft(item) + item.offsetWidth;
  y = getPageOffsetTop(item);

  // Adjust position to fit in view.

  var maxX, maxY;

  if (browser.isIE) {
    maxX = Math.max(document.documentElement.scrollLeft, document.body.scrollLeft) +
      (document.documentElement.clientWidth != 0 ? document.documentElement.clientWidth : document.body.clientWidth);
    maxY = Math.max(document.documentElement.scrollTop, document.body.scrollTop) +
      (document.documentElement.clientHeight != 0 ? document.documentElement.clientHeight : document.body.clientHeight);
  }
  if (browser.isOP) {
    maxX = document.documentElement.scrollLeft + window.innerWidth;
    maxY = document.documentElement.scrollTop  + window.innerHeight;
  }
  if (browser.isNS) {
    maxX = window.scrollX + window.innerWidth;
    maxY = window.scrollY + window.innerHeight;
  }
  maxX -= item.subMenu.offsetWidth;
  maxY -= item.subMenu.offsetHeight;

  if (x > maxX)
    x = Math.max(0, x - item.offsetWidth - item.subMenu.offsetWidth
      + (menu.offsetWidth - item.offsetWidth));
  y = Math.max(0, Math.min(y, maxY));

  // Position and show it.

  item.subMenu.style.left       = x + "px";
  item.subMenu.style.top        = y + "px";
  item.subMenu.style.visibility = "visible";

  // For IE; size, position and show the menu's IFRAME as well.

  if (item.subMenu.iframeEl != null)
  {
    item.subMenu.iframeEl.style.left    = item.subMenu.style.left;
    item.subMenu.iframeEl.style.top     = item.subMenu.style.top;
    item.subMenu.iframeEl.style.width   = item.subMenu.offsetWidth + "px";
    item.subMenu.iframeEl.style.height  = item.subMenu.offsetHeight + "px";
    item.subMenu.iframeEl.style.display = "";
  }

  // Stop the event from bubbling.

  if (browser.isIE)
    window.event.cancelBubble = true;
  else
    event.stopPropagation();
}

function closeSubMenu(menu) {

  if (menu == null || menu.activeItem == null)
    return;

  // Recursively close any sub menus.

  if (menu.activeItem.subMenu != null) {
    closeSubMenu(menu.activeItem.subMenu);


    // Hide the sub menu.
    menu.activeItem.subMenu.style.visibility = "hidden";

    // For IE, hide the sub menu's IFRAME as well.

    if (menu.activeItem.subMenu.iframeEl != null)
      menu.activeItem.subMenu.iframeEl.style.display = "none";

    menu.activeItem.subMenu = null;
  }

  // Deactivate the active menu item.

  removeClassName(menu.activeItem, "menuItemHighlight");
  menu.activeItem = null;
}

//----------------------------------------------------------------------------
// Code to initialize menus.
//----------------------------------------------------------------------------

function menuInit(menu) {

  var itemList, spanList;
  var textEl, arrowEl;
  var itemWidth;
  var w, dw;
  var i, j;

  // For IE, replace arrow characters.

  if (browser.isIE) {
    menu.style.lineHeight = "2.5ex";
    spanList = menu.getElementsByTagName("SPAN");
    for (i = 0; i < spanList.length; i++)
      if (hasClassName(spanList[i], "menuItemArrow")) {
        spanList[i].style.fontFamily = "Webdings";
        spanList[i].firstChild.nodeValue = "4";
      }
  }

  // Find the width of a menu item.

  itemList = menu.getElementsByTagName("A");
  if (itemList.length > 0)
    itemWidth = itemList[0].offsetWidth;
  else
    return;

  // For items with arrows, add padding to item text to make the
  // arrows flush right.

  for (i = 0; i < itemList.length; i++) {
    spanList = itemList[i].getElementsByTagName("SPAN");
    textEl  = null;
    arrowEl = null;
    for (j = 0; j < spanList.length; j++) {
      if (hasClassName(spanList[j], "menuItemText"))
        textEl = spanList[j];
      if (hasClassName(spanList[j], "menuItemArrow")) {
        arrowEl = spanList[j];
      }
    }
    if (textEl != null && arrowEl != null) {
      textEl.style.paddingRight = (itemWidth 
        - (textEl.offsetWidth + arrowEl.offsetWidth)) + "px";

      // For Opera, remove the negative right margin to fix a display bug.

      if (browser.isOP)
        arrowEl.style.marginRight = "0px";
    }
  }

  // Fix IE hover problem by setting an explicit width on first item of
  // the menu.

  if (browser.isIE) {
    w = itemList[0].offsetWidth;
    itemList[0].style.width = w + "px";
    dw = itemList[0].offsetWidth - w;
    w -= dw;
    itemList[0].style.width = w + "px";
  }

  // Fix the IE display problem (SELECT elements and other windowed controls
  // overlaying the menu) by adding an IFRAME under the menu.

  if (browser.isIE) {
    var iframeEl = document.createElement("IFRAME");
    iframeEl.frameBorder = 0;
    iframeEl.src = "javascript:;";
    iframeEl.style.display = "none";
    iframeEl.style.position = "absolute";
    iframeEl.style.filter = "progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=0)";
    menu.iframeEl = menu.parentNode.insertBefore(iframeEl, menu);
  }

  // Mark menu as initialized.

  menu.isInitialized = true;
}

//----------------------------------------------------------------------------
// General utility functions.
//----------------------------------------------------------------------------

function getContainerWith(node, tagName, className) {

  // Starting with the given node, find the nearest containing element
  // with the specified tag name and style class.

  while (node != null) {
    if (node.tagName != null && node.tagName == tagName &&
        hasClassName(node, className))
      return node;
    node = node.parentNode;
  }

  return node;
}

function hasClassName(el, name) {

  var i, list;

  // Return true if the given element currently has the given class
  // name.

  list = el.className.split(" ");
  for (i = 0; i < list.length; i++)
    if (list[i] == name)
      return true;

  return false;
}

function removeClassName(el, name) {

  var i, curList, newList;

  if (el.className == null)
    return;

  // Remove the given class name from the element's className property.

  newList = new Array();
  curList = el.className.split(" ");
  for (i = 0; i < curList.length; i++)
    if (curList[i] != name)
      newList.push(curList[i]);
  el.className = newList.join(" ");
}

function getPageOffsetLeft(el) {

  var x;

  // Return the x coordinate of an element relative to the page.

  x = el.offsetLeft;
  if (el.offsetParent != null)
    x += getPageOffsetLeft(el.offsetParent);

  return x;
}

function getPageOffsetTop(el) {

  var y;

  // Return the x coordinate of an element relative to the page.

  y = el.offsetTop;
  if (el.offsetParent != null)
    y += getPageOffsetTop(el.offsetParent);

  return y;
}

//]]></script>



<!-- Menu bar. -->

<div class="menuBar" style="width:80%;"
><a class="menuButton"
    href="#"
    onclick="return buttonClick(event, 'DevisMenu');"
    onmouseover="buttonMouseover(event, 'DevisMenu');"
><?php echo $lang_devis_pluriel; ?></a
><a class="menuButton"
    href="#"
    onclick="return buttonClick(event, 'CommandesMenu');"
    onmouseover="buttonMouseover(event, 'CommandesMenu');"
><?php echo "$lang_commandes"; ?></a
><a class="menuButton"
    href="#"
    onclick="return buttonClick(event, 'FacturesMenu');"
    onmouseover="buttonMouseover(event, 'FacturesMenu');"
><?php echo $lang_factures; ?></a
><a class="menuButton"
    href="#"
    onclick="return buttonClick(event, 'DepensesMenu');"
    onmouseover="buttonMouseover(event, 'DepensesMenu');"
><?php echo $lang_depenses; ?></a
><a class="menuButton"
    href="#"
    onclick="return buttonClick(event, 'ArticlesMenu');"
    onmouseover="buttonMouseover(event, 'ArticlesMenu');"
><?php echo $lang_articles; ?></a
><a class="menuButton"
    href="#"
    onclick="return buttonClick(event, 'ClientsMenu');"
    onmouseover="buttonMouseover(event, 'ClientsMenu');"
><?php echo $lang_clients; ?></a
><a class="menuButton"
    href="#"
    onclick="return buttonClick(event, 'StatsMenu');"
    onmouseover="buttonMouseover(event, 'StatsMenu');"
><?php echo $lang_statistiques; ?></a>

<a class="menuButton"
    href="#"
    onclick="return buttonClick(event, 'OutilsMenu');"
    onmouseover="buttonMouseover(event, 'OutilsMenu');"
><?php echo $lang_outils; ?></a>
<?php if ($lot == 'y') { ?>
<a class="menuButton"
    href="#"
    onclick="return buttonClick(event, 'LotsMenu');"
    onmouseover="buttonMouseover(event, 'LotsMenu');"
><?php echo $lang_lots; ?></a>
<?php } ?>

</div>

<!-- devis -->

<div id="DevisMenu" class="menu"
     onmouseover="menuMouseover(event)">
		 <?php if ($user_dev != 'n') { ?>
<a class="menuItem" href="form_devis.php"><?php echo $lang_creer ?></a>
<div class="menuItemSep"></div>
<a class="menuItem" href="lister_devis.php"><?php echo $lang_lister ?></a>
<a class="menuItem" href="chercher_devis.php"><?php echo $lang_cherc ?></a>
<div class="menuItemSep"></div>
<a class="menuItem" href="devis_non_commandes.php"><?php echo $lang_non_com ?></a>
<div class="menuItemSep"></div>
<?php } ?>
</div>
<!-- commandes -->
<div id="CommandesMenu" class="menu"
     onmouseover="menuMouseover(event)">
		 <?php if ($user_com != 'n') { ?>
<a class="menuItem" href="form_commande.php"><?php echo $lang_creer ?></a>
<div class="menuItemSep"></div>
<a class="menuItem" href="lister_commandes.php"><?php echo $lang_lister ?></a>
<a class="menuItem" href="chercher_commande.php"><?php echo $lang_cherc ?></a>
<div class="menuItemSep"></div>
<a class="menuItem" href="lister_commandes_non_facturees.php"><?php echo $lang_non_facu ?></a>
<?php } ?>
</div>
<!-- factures -->
<div id="FacturesMenu" class="menu">
<?php if ($user_fact != 'n') { ?>
<a class="menuItem" href="form_facture.php"><?php echo $lang_creer ?></a>
<div class="menuItemSep"></div>
<a class="menuItem" href="lister_factures.php"><?php echo $lang_lister ?></a>
<a class="menuItem" href="chercher_factures.php"><?php echo $lang_cherc ?></a>
<div class="menuItemSep"></div>
<a class="menuItem" href="lister_factures_non_reglees.php"><?php echo $lang_non_reg ?></a>
<a class="menuItem" href="form_multi_facture.php"><?php echo $lang_fact_multi ?></a>
<a class="menuItem" href="oneclick.php"><?php echo $lang_imp_multi ?></a>
<?php } ?>
</div>
<!-- depenses -->
<div id="DepensesMenu" class="menu"
     onmouseover="menuMouseover(event)">
		 <?php if ($user_dep != 'n') { ?>
<a class="menuItem" href="form_depenses.php"><?php echo $lang_creer ?></a>
<div class="menuItemSep"></div>
<a class="menuItem" href="lister_depenses.php"><?php echo $lang_lister ?></a>
<a class="menuItem" href="chercher_dep.php"><?php echo $lang_cherc ?></a>
<div class="menuItemSep"></div>
<?php if ($user_stat != 'n') { ?>
<a class="menuItem" href="stats_dep.php"><?php echo $lang_depenses_par_fournisseur; ?></a>
<a class="menuItem" href="stat_depenses_mois.php"><?php echo $lang_depenses_par_fournisseur_mois; ?></a>
<a class="menuItem" href="stat_depenses_annee.php"><?php echo $lang_depenses_par_fournisseur_mois_annee ?></a>
<?php }
} ?>
</div>
<!-- articles -->
<div id="ArticlesMenu" class="menu">
<?php if ($user_art != 'n') { ?>
<a class="menuItem" href="form_article.php"><?php echo $lang_creer ?></a>
<a class="menuItem" href="lister_articles.php"><?php echo $lang_lister ?></a>
<?php } ?>
</div>
<!-- clients -->
<div id="ClientsMenu" class="menu">
<?php if ($user_cli != 'n') { ?>
<a class="menuItem" href="form_client.php"><?php echo $lang_creer ?></a>
<a class="menuItem" href="lister_clients.php"><?php echo $lang_lister ?></a>
<?php } ?>
</div>
<!-- Statistiques -->
<div id="StatsMenu" class="menu">
<?php if ($user_stat != 'n') { ?>
<a class="menuItem" href="ca_annee.php"><?php echo $lang_annuelles ?></a>
<a class="menuItem" href="ca_parclient.php"><?php echo $lang_ca_cli ?></a>
<div class="menuItemSep"></div>
<a class="menuItem" href="ca_parclient_1mois.php"><?php echo $lang_cli_moi ?></a>
<a class="menuItem" href="ca_articles.php"><?php echo $lang_stat_art ?></a>
<a class="menuItem" href="form_stat_client.php"><?php echo $lang_moi_cli ?></a>
<a class="menuItem" href="stat_depenses_mois.php"><?php echo $lang_depenses_par_fournisseur_mois; ?></a>
<a class="menuItem" href="stats_dep.php"><?php echo $lang_depenses_par_fournisseur; ?></a>
<?php } ?>
</div>

<!-- outils -->
<div id="OutilsMenu" class="menu">
<?php if ($user_admin == 'y'){ ?>
<a class="menuItem" href="form_utilisateurs.php"><?php echo $lang_aj_utl ?></a>
<a class="menuItem" href="lister_utilisateurs.php"><?php echo $lang_list_utl ?></a>
<a class="menuItem" href="form_mailing.php"><?php echo $lang_mainling_list ?></a>
<a class="menuItem" href="form_backup.php"><?php echo $lang_back_men ?></a>
<a class="menuItem" href="admin.php"><?php echo $lang_administra ?></a>
<?php } ?>
<div class="menuItemSep"></div>
<a class="menuItem" href="include/calculette.html" onclick="window.open('','popup','width=300,height=220,top=200,left=150,toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0')" target="popup"><?php echo $lang_calculette; ?></a>
<a class="menuItem" href="logout.php"><?php echo $lang_sortir ?></a>

</div>

<!-- Lots -->
<div id="LotsMenu" class="menu">
<?php if ($user_fact != 'n') { ?>
<a class="menuItem" href="lister_lot.php"><?php echo "Lister" ?></a>
<a class="menuItem" href="form_lot.php"><?php echo "Créer" ?></a>
<div class="menuItemSep"></div>
<a class="menuItem" href="form_recherche_lot.php"><?php echo "Rechercher" ?></a>
<?php } ?>
</div>
