<?php
/*
 * Factux le facturier libre
 * Copyright (C) 2003-2005 Guy Hendrickx, 2017 Thomas Ingles
 *
 * Licensed under the terms of the GNU  General Public License:
 * 		http://opensource.org/licenses/GPL-3.0
 *
 * For further information visit:
 * 		http://factux.free.fr
 *
 * File Name: fr.php
 * 	fichier contenant les variables francophones
 *
 * * Version:  5.0.0
 * * * Modified: 07/10/2016
 *
 * File Authors:
 * 		Guy Hendrickx
 */
error_reporting(0);


$lang_factux = "Factux - Le Facturier libre Révision 2017";
$lang_source_fac = $lang_factux . ' Webiciel à source ouverte<br>dérivé de <a href=\'http://sourceforge.net/projects/factux/\' target=\'_blank\' >Factux 1.1.5</a><br>Réécrit et distribué par';
$lang_new_config_ok= "Votre nouvelle configuration est enregistrée";
$lang_nbr_impression= "Nombre d'impressions";
$lang_choix_Impression= "Utiliser l'impression automatique";
////variables ajoutées
$lang_lots = "Lots";
$lang_choix_use_stock = "Utiliser le module de stocks";
$lang_administra = "Administration";
$lang_choix_theme ="Choisir le thême de Factux";
$lang_choix_use_lot ="Utiliser le module de lots";
$lang_use_payement = "Utiliser le module de type de paiement des factures";
$lang_use_list_client = "Utiliser le listage avancé des clients ";
$lang_use_cat ="Utiliser le module des catégories";
$lang_modif_par ="Modifier les paramètres de Factux";
$lang_cr_lot ="Créer un lot.";
$lang_depenses_par_fournisseur ="Statistiques par fournisseur ";
$lang_conf_env = " Êtes-vous sûr de vouloir envoyer la facture N°";
$lang_conf_env2= "par courriel au client";
$lang_conf_notif =" Êtes-vous sûr de vouloir notifier le client";
$lang_conf_notif2 ="de l'existence de la facture ";
$lang_par ="par";
$lang_conf_carte_reg =" Êtes-vous sûr de vouloir régler la facture N°";
$lang_con_env_pdf=" Êtes-vous sûr de vouloir envoyer par courriel le bon N°";
$lang_con_env_notif=" Êtes-vous sûr de vouloir notifier par courriel le client du bon N°";
$lang_mode_paiement ="Mode de paiement";
$lang_carte_ban ="Carte";
$lang_pay_ok ="Réglée";
$lang_paypal ="Cheque";
$lang_non_pay = "Non payée";
$lang_virement = "Virement";
$lang_visa = "Visa";
$lang_liquide ="Especes";
$lang_status_pay = " Statut de paiement ";
$lang_pour_mont = "pour un montant de";
$lang_aj_au_bon = "Ajouter un autre bon";
$lang_cré_fac_orph ="Créer une facture à partir du bon N°";
$lang_tele = "Téléphone";
$lang_fax = "Fax";
$lang_civ = "Civilité";
$lang_nouv_categorie = "Nouvelle catégorie ajoutée";
$lang_cat_nom ="nom de la catégorie";
$lang_categorie_ajout = "Ajouter une catégorie";
$lang_categorie = "Catégorie";
$lang_err_ancien_mdp ="votre ancien mot de passe est incorrect veuillez le vérifier ";
$lang_stock="Stock";
$lang_stomin="mini";
$lang_stomax="maxi";
$lang_stock_jour="Article mis à jour";
$lang_regler_fact2 ="au statut réglé ?";
///Variables modifiées
$lang_conf_effa = "Désirez-vous vraiment effacer cette ligne du bon de livraison ?";
$lang_conf_effa_li_dev = "Désirez-vous vraiment effacer cette ligne du devis ?";
$lang_con_effa = "Désirez-vous vraiment effacer le bon de livraison N°";
$lang_regler_fact = "Êtes-vous sûr de vouloir mettre la facture N°";
$lang_art_effa= "Êtes-vous sûr de vouloir effacer l\'article ";
$lang_lot_inact= "Êtes-vous sûr de vouloir désactiver le lot N°";
$lang_lot_act= "Êtes-vous sûr de vouloir réactiver le lot N°";
$lang_cli_effa = "Êtes-vous sûr de vouloir effacer le client ";
$lang_eff_dev = "Êtes-vous sûr de vouloir effacer le devis N°";
$lang_convert_dev = "Êtes-vous sûr de vouloir transformer le devis N°";
$lang_convert_dev2 = "en bon de commande ?";
$lang_dev_perd = "Êtes-vous sûr de vouloir mettre le devis N°";
$lang_dev_perd2 ="au statut perdu ?";
$lang_eff_conf_dep = "Êtes-vous sûr de vouloir effacer la dépense N°";
////

////
$lang_fi_b_c="Bon de commande";#pdf filename
$lang_facture="Facture";
$lang_fact_mu_err = "Aucune facture n'a ete crée le ";
$lang_imp_multi = "Impression multiples";
$lang_fact_multi ="Factures multiples";
$lang_facture_impri ="Imprimer les factures";
$lang_facture_onclick ="Imprimer les factures faites le";
$lang_deflang = "Langue par defaut";
$lang_po_acquis = "Pour acquit";
$lang_nouv_d="Nouvelle facture de ";
$lang_nouv_add ="Une nouvelle facture vous a étée adressée par";
$lang_salut_dist="Vous la trouverez en piece jointe de ce courriel\n Salutations distinguées";

$lang_condi_ven = "Conditions de vente au verso";# Algemene verkoopsvoorwaarden, zie keerzijde.
$lang_Lister_lots = "Lister les lots";
$lang_com_cont_lot = "Les bons de commandes qui contiennent le lot";
$lang_lot = "lots";
$lang_num_lot ="N° de lot";
$lang_lot_four = "N° de lot fournisseur ";
$lang_ingred = "Ingredient";
$lang_produit = "Produit";
$lang_all_lots = "Tous les lots";
$lang_impo_del_util = "impossible d'effacer cet utilisateur . Vous devez tout d'abord lui retirer les droits d'administration";
$lang_con_effa_utils = "Ests vous sur de vouloir effacer cet utilisateur ?";
$lang_rest_pay = "Solde à payer";
$lang_acompte = "Acompte";
#$lang_ctrl = "Vous pouver choisir plusieurs clients en enfoncant la touche 'Ctrl' de votre clavier";#unused.2015
$lang_choi_cli_utis = "Choisir les clients pour cet utilisateur";
$lang_choi_cli_enr = "Veuillez à present choisir les clients qu'il pourra gérer";
$lang_don_rest = "vous aver donné des droits restreints a l'utilisateur";
$lang_est_enr = "est maintenant enregistré et a comme login:";
$lang_ret_cli_util = "Retirer un client de cet utilisateur";
$lang_admi_modu = "Les droits d'administration donnent l'acces a tout les autres modules";
$lang_dr_admi = "A les droits d'administrateurs";
$lang_ger_cli ="Peut gerer les clients ?";
$lang_ger_art = "Peut gerer les articles ?";
$lang_ger_stat = "Peut gerer les statistiques ?";
$lang_ger_dep = "Peut gerer les dépenses ?";
$lang_ger_fact = "Peut gerer les factures ?";
$lang_ger_com = "Peut gerer les commandes ?";
$lang_ger_dev = "Peut gerer les devis ?";
$lang_val_actu = "Rétablir aux valeurs actuelles";
$lang_util_droit = "Les droits de cet utilisateur";
$lang_utilisateur_editer = "Editer un utilisateur";
$lang_retirer = "Retirer";
$lang_multi_select_ctrl = "Choix de plusieurs clients en restant appuyé sur la touche 'Ctrl' du clavier";
$lang_ajou_cli_util = "Ajouter des clients à cet utilisateur";
$lang_oui = "oui";
$lang_non = "non";
$lang_restrint = "restreint";
$lang_list_utl = "Lister les utilisateurs";

$lang_client_droit = "Vous n'avez pas les droits nécessaires pour gérer les clients contactez l'administrateur si vous penser qu'il y as erreur";
$lang_article_droit = "Vous n'avez pas les droits nécessaires pour gérer les articles contacter l'administrateur si vous penser qu'il y as erreur";
$lang_statistique_droit = "Vous n'avez pas les droits necessaire pour voir les statistiques contactez l'administrateur si vous pensez qu'il y as erreur";
$lang_depense_droit = "Vous n'avez pas les droits pour gerer les dépenses contacter l'administrateur si vou pensez qu'il y as erreur";
$lang_facture_droit = "Vous n'avez pas les droits nécessaires pour gérer les factures contactez l'administrateur si vous pensez qu'il y as erreur.";
$lang_commande_droit = "Vous n'avez pas les droits nécessaires pour gérer les bons de commandes contactez l'administrateur si vous pensez qu'il y as erreur.";
$lang_devis_droit = "Vous n'avez pas les droits nécessaires pour gérer les devis contactez l'administrateur si vous pensez qu'il y as erreur";
$lang_admin_droit = "vous n'avez pas les droits necessaire il faut etre administrateur pour pouvoir acceder a cette page";

$lang_mdp_jour = "Votre mot de passe a ete mis a jour ";
$lang_dif_mail_mdp = "Modification  de votre mot de passe";
$lang_mdp_chang = "Votre mot de passe à été changé <br>Un courriel vas etre envoyé avec vos nouveau login et mot de passe à";
$lang_err_mdp_corr = "Erreur les deux mots de passe ne correspondent pas";
$lang_err_chan_mdp = "Erreur!!!!Vous devez absolument remplir touts les champs <br> Veuiller vous reedentifier avec vos ancien login et mot de passe";
$lang_chng_mdp = "Changer de mot de passe";
$lang_con_cli = "convertit par le client";
$lang_bad_log = "Mauvais login ou mot de passe. Merci de recommencer";
$lang_mail_ref = "refusé par le client";
$lang_conf_conv = "Veuillez confirmer et ajouter un message pour l'administrateur";
$lang_refu = "Refuser";
$lang_accepter = "Accepter";
$lang_non_facu = "Non facturées";
$lang_non_reg = "Non réglées";
$lang_non_com = "Non commandé";
$lang_moi_cli = "Par mois un client";
$lang_stat_art = "Statistiques par article";
$lang_cli_moi = "Par client 1 mois";
$lang_ca_cli = "C.A par client";
$lang_annuelles = "annuelles";
#$lang_email = "e-mail"; doublon
$lang_sortir = "Sortir";
$lang_back_men = "Sauvegardes";
$lang_infolettre ="Infolettre";
$lang_aj_utl ="Ajout utilisateur";
$lang_cherc = "Chercher";
$lang_creer = "Créer";
$lang_lister = "Lister";
$lang_admini = "administrateur";
$lang_en_cli = "Entrée clients";
$lang_en_admi = "Entrée administration";
$lang_ident = "Veuiller entrer vos données d'identifications. ";
$lang_notif_env = "Notification de changement du mot de passe envoyé à";
$lang_pass_modif = "Modification de votre mot de passe";
$lang_mail_li_up1= "Cher client<br>Votre mot de passe a été mis a jour par l'administrateur<br>Login:";
$lang_mail_cli_up = "Ce mot de passe etant encodé dans notre base de données, il nous est impossible de vous le renvoyer si vous le perdiez.";
$lang_ba_imp ="Montant HT";
$lang_fact_num_ab = "Facture N°:";
$lang_totaux = "Total hors tva:\n Total tva:\n Total tva comprise:";
$lang_num_bon_ab = "Bon N°:";
$lang_de = "de";
$lang_page = "Page";
$lang_condi = "{$entrep_nom} {$social} Tel :{$tel_vend} \n{$tva_vend} {$compte} {$reg}";
$lang_prix_htva = "Prix H.T.V.A";
$lang_dev_pdf_soc = " Société\n Siège social\n Tel/Fax\n T.V.A\n Banque\n Courriel";
$lang_ajo_fact = "Ajouter un commentaire sur la facture (facultatif)";
$lang_bon_enregistrer = "Enregistrer le bon";
$lang_bon_ajouter = "Ajouter au bon";
$lang_bon_editer = "Editer le bon";
$lang_dev_date = "Date du devis";
$lang_ga_per = "Gagné/Perdu";
$lang_de_num = "Devis N°";
$lang_ajo_com_dev = "Ajouter un commentaire sur le devis";
$lang_ajo_com_bo = "Ajouter un commentaire sur le bon de commande (facultatif)";
$lang_factpdf_penalites_conditions = "Conditions de vente au verso.\n";# Algemene verkoopsvoorwaarden, zie keerzijde
$lang_t_tva = "Taux tva";
$lang_con_per = "Êtes-vous sûr de vouloir mettre ce devis au statut perdu ?";
$lang_con_gag = "Êtes-vous sûr de vouloir mettre ce devis au statut gagné ?";
$lang_con_effa_dev = "Êtes-vous sûr de vouloir effacer ce devis ?";
$lang_mail_a = "courriel envoyé à:";
$lang_benef = "Bénéfice";
$lang_de_per = sprintf('Votre devis %s est maintenant au statut de devis perdu', $num_dev);
$lang_sup_li = "Désirez-vous vraiment effacer cette ligne du bon de livraison ?";
$lang_edit_bon = "Editer un bon de commande";
$lang_che_dep = "Chercher une dépense";
$lang_no_dep = "N° de dépense";
$lang_cli_jour = "Le client à été mis à jour";
$lang_noti_pa = "Notification du mot de passe envoyé ";
$lang_mai_cre = "Cher client<br>Votre mot de passe a ete créé par l'administrateur <br>Login:";
$lang_mai_cr_pa = " Mot de passe:";
$lang_mai_cre_enc = "<br><br>vous pouver changer ce mot de passe en ligne mais pas le login. <br>Ce mot de passe est encodé dans notre base de données .<br>Si vous le perdez, veuillez prévenir !";
$lang_pass_nou = "pour qu'il vous en donne un nouveau ";
$lang_cre_mo_pa = "Création de votre mot de passe";
$lang_er_mo_pa = "Erreur le login existe déjà";
$lang_mot_pa = "Erreur les deux mots de passe ne correspondent pas";
$lang_dev_cov = sprintf('Le devis %s à bien été converti en bon de commande %s ', $num_dev, $max);
$lang_evo_ben = "Evolution du bénéfice";
$lang_evo_ca = "Evolution du C.A.";
$lang_periode = "Période";
$lang_dep_htva = "Depenses hors tva";
$lang_bc_login = "Nom de la base de données";
$lang_back_upl = sprintf("Si vous désirez restaurer cette sauvegarde :<br>1.Téléverser le fichier dans le répertoire dump de votre %s.<br>2.Executer l'utilitaire de Sauvegarde et choissiser l'option restaurer une sauvegarde", $lang_factux);
$lang_back_effac = "Votre demande d'effacement de sauvegarde s'est bien déroulé";
$lang_back_utili = "Utilitaire de sauvegarde de Factux";
$lang_voir = "Voir";
$lang_rest = "Restaurer";
$lang_tai = "Taille";
$lang_fichier = "Fichier";
$lang_back_restO2 = 'Si aucune erreur est apparue alors vos données ont bien été restaurées. Cet outil restaure seulement les sauvegardes crées a partir de ' . $lang_factux;
$lang_back_resto = "Restauration de sauvegarde";
$lang_back_ext = "Fichier backup.sql extrait de";
$lang_back_ti_re = "Utilitaire de sauvegarde de Factux: Restaurer une sauvegarde";
$lang_back_ret = "Retour à l'utilitaire de sauvegarde";
$lang_back_lon2 = "Ce fichier ne peut être restauré que grâce à l'utilitaire de sauvegarde de Factux et la base de donnée doit avoir le meme nom.<br />Pensez à effacer cette sauvegarde apres l'avoir téléchargé. Laisser des sauvegardes sur le serveur est un risque majeur pour la sécurité de Factux.";
$lang_back_lon = "Si aucune erreur est apparue alors la sauvegarde est dans le répertoire 'dump' (sans les guillemets) du répertoire d'installation de factux.<br> Ce fichier se nomme 'backup.sql'.<br />Il contient les tables suivantes:<br />";
$lang_back_ok = "Sauvegarde créée";
$lang_back_titr = "MySQL/Mariadb PHP Backup :: Sauvegarde";
$lang_back_ex = "Sans l'extension";
$lang_back_comp = "Nom du fichier compressé:";
$lang_back_gzip = "Télécharger au format Gzip ";
$lang_sql = "Télécharger au format sql";
$lang_back_tel = "Télécharger la sauvegarde";
$lang_bac_efkf = "Effacer le dossier de sauvegarde";
$lang_back_ser = "La sauvegarde doit etre sur le serveur dans le répertoire dump";
$lang_nom_back = "Nom du fichier de sauvegarde: backup.sql";
$lang_fi_back = "Créer une sauvegarde";
$lang_con_dev_effa = "Désirez-vous vraiment effacer ce devis ?";

$lang_dep_choi = "Vous devez soit choisir un fournisseur dans la liste soit en entrer un nouveau !!!";
$lang_dep_enr ="La depense à été enregitrée";
$lang_rappel = "rappel";
$lang_erreur_var = "Le fichier include/config/var.php est accessible en écriture. Veuillez réduire les droits de ce fichier à la lecture seule.";
$lang_erreur_common = "Le fichier include/config/common.php est accessible en écriture. Veuillez réduire les droits de ce fichier à la lecture seule.";
$lang_erreur_backup = "Présence de sauvegarde(s) dans le répertoire dump ceci présente un risque majeur de sécurité.";
$lang_erreur_insta = "L'installeur est encore présent. Ceci est un risque majeur de sécurité. <a href='del_installeur.php?util=del'>Supprimer l'installeur en cliquant ici.</a>";
$lang_devis_compr = sprintf('Le devis de %s comprend:', $nom);
$lang_nv_devis = "Créer un nouveau devis";
$lang_prixunitaire = "Prix unitaire";
$lang_reglement_conditions = "Conditions de règlement: Règlement 30 jours après livraison";
$lang_interdit = "Cette zone vous est interdite";
$lang_devis = "Devis";
$lang_edi_cont_devis = 'Modifier le contenu du ' . $lang_devis;
$lang_devis_pluriel = "Devis";
$lang_devis_enregistrer = 'Enregistrer le ' . $lang_devis;
$lang_devis_ajouter = 'Ajouter au ' . $lang_devis;
$lang_devis_gagner="Gagner";
$lang_devis_perdre="Abandonner";
$lang_imprimer = "Imprimer";
$lang_supprimer = "Supprimer";
$lang_client_modifier = $lang_editer . ' le client';
$lang_tva = "T.V.A.";
$lang_commandes_lister = "Lister les commandes";
$lang_gagne_perdu = "Résultat";
$lang_articles_liste = "Liste des Articles";
$lang_article_creer = "Créer un article";
$lang_complement = "Complément";
$lang_rue="Rue";
$lang_code_postal="Code postal";
$lang_ville="Ville";
$lang_numero_tva ='N° ' . $lang_tva;
$lang_email = "Courriel";
$lang_bc_base = "Base de données";
$lang_annuler = "Annuler";
$lang_mailing_list_message = "Message";
$lang_mailing_list_titremessage = "Titre du message";
$lang_mailing_list = "Infolettre";
$lang_motdepasse = "Mot de passe";
$lang_motdepasse_changer = 'Changer de ' . $lang_motdepasse;
$lang_motdepasse_ancien = 'Ancien ' . $lang_motdepasse;
$lang_motdepasse_nouveau = 'Nouveau ' . $lang_motdepasse;
$lang_motdepasse_verification = $lang_motdepasse . ' (pour vérification)';
$lang_nom = "Nom";
$lang_prenom = "Prénom";
$lang_mail = "Courriel";
$lang_mot_de_passe = "Mot de passe";
$lang_utilisateur_nom = "Nom d'utilisateur (login) ";
$lang_utilisateur_ajouter = "Ajouter un utilisateur";
$lang_ca_par_client_1mois = "Statistiques par client de";
$lang_pourcentage = "Pourcentage";
$lang_ca_annee = "C.A. de l'année";
$lang_ca_par_client = "C.A. par client pour";
$lang_depenses_liste = "Liste des dépenses";
$lang_regler = "Régler";
$lang_depuis ="Depuis";
$lang_resultat_net = "Résultat net";
$lang_oublie_champ = "Vous avez oublié de remplir un champ.";
$lang_authentification_ko = "Vous n'êtes pas autorisé à accéder cette zone";
$lang_authentification_ok = "Authentification réussie.";
$lang_bienvenue = "Bienvenue";
$lang_facture_creer = "Créer une nouvelle facture";
$lang_date = "Date";
$lang_commande_numero = "Commande N°";
$lang_commandes_non_facturees = "Commandes non facturées";
$lang_commandes_liste="Commandes du mois";
$lang_choisissez="Choisissez";
$lang_commandes_chercher = "Chercher une commande";
$lang_devis_numero=$lang_devis . ' N°';
$lang_numero = "N°";
$lang_devis_date = 'Date du ' . $lang_devis;
$lang_devis_perdus = sprintf('Liste des %s perdus', $lang_devis);
$lang_devis_chercher = 'Rechercher un ' . $lang_devis;
$lang_devis_créer = 'Créer un ' . $lang_devis;
$lang_devis_liste = 'Liste des ' . $lang_devis;
$lang_clients_existants = "Liste des clients";
$lang_client_accesprive = "Optionnel (pour permettre l'accès à la partie client)<br>Si vous entrez un login et mot de passe, un courriel sera envoyé au client pour lui en faire part. ";
$lang_retablir = "Rétablir";
$lang_num_dev =sprintf('%s de %s', $lang_numero, $lang_devis);
$lang_envoyer = "Envoyer";
$lang_outils = "Outils";
$lang_articles = "Articles";
$lang_factures = "Factures";
$lang_commandes = "Commandes";
$lang_clients = "Clients";
$lang_depenses = "Dépenses";
$lang_htva = "H.T.";
$lang_depenses_htva = 'Dépenses ' . $lang_htva;
$lang_ca_htva = "Chiffre d'affaire " . $lang_htva;
$lang_ttc = "T.T.C.";
$lang_ca_ttc = 'C.A. ' . $lang_ttc;

$lang_statistiques_basees_bons = "Les statistiques sont basées sur les bons de commandes.";
$lang_statistiques_par_client = "Les statistiques détaillées par client";
$lang_articles_existants = "Les articles existants";
$lang_statistiques_annee = "Statistiques de l'année";
$lang_statistiques = "Statistiques";
$lang_libelle = "Libellé";
$lang_depenses_par_fournisseur_mois = "Par Mois";
#$lang_depenses_par_fournisseur_mois_annee = "Stat. Année";
$lang_calculette = "Calculatrice";
$lang_depenses_tri_par_fournisseur = "Tri des dépenses par fournisseur";
$lang_res_rech = "Résultat de la recherche";
$lang_fournisseur = "Fournisseur";
$lang_fournisseur_entrez = "Ou entrez le nom du fournisseur";
$lang_depense_ajouter = "Ajouter une dépense";
$lang_oubli_champ = "Vous avez oublié de renseigner un champ.";
$lang_nouv_art = "Votre nouvel article à bien été ajouté dans le catalogue.";
$lang_commentaire = "Avec comme commentaire";
$lang_choix_client = "Vous devez choisir un client.";
$lang_devis_cree = "Devis créé pour";
$lang_donne_devis = "Entrez les données du devis";
$lang_bon_cree = "Bon de commande créé pour";
$lang_bon_cree2 = "en date du ";
$lang_montant = "Montant";
$lang_facture_creer_bouton = "Créer la facture";
$lang_mois = "Mois";
$lang_donne_bon = "Entrez les données du bon de commande";
$lang_quanti = "Quantité";
$lang_article = "Article";
$lang_valid = "Valider";
$lang_editer = "Modifier";
$lang_enre = "Bon enregistré";
$lang_champ_oubli = "Vous avez oublié de remplir le champ quantité";
$lang_nv_bon = "Créer un nouveau bon de commande";
$lang_bon_compr = sprintf('Le bon de commande de %s comprend:', $nom);
#$lang_suprimer = "Supprimer";
#$lang_som_tot = "Pour une somme totale de <font size = 4>$total_bon  $lang_htva</font>";
#$lang_som_tot2 = "Pour une somme totale de ";
$lang_mont_tva = sprintf(' et un montant de %s de ', $lang_tva);
$lang_ajou_bon = "Ajouter au bon";
$lang_ter_enr = "Terminer et enregistrer";
$lang_ex_rech = "Exécuter une recherche";
$lang_num_bon = $lang_numero . ' de bon';
$lang_jour = "Jour";
$lang_jours = "jours";
$lang_annee = "Année";
$lang_tri = "Trier par";
$lang_client_enr = sprintf('Votre nouveau client %s à bien été enregistré.', $nom);
$lang_effacer_bon = sprintf('Êtes-vous sûr de vouloir effacer le bon de commande %s de %s ?', $num_bon, $nom);
$lang_effacer = "Effacer";
$lang_client = "Client";
$lang_rech = "Rechercher";
$lang_client_ajouter = "Ajouter un client";
$lang_bon_effa = sprintf('Le bon %s à été effacé.', $num_bon);
$lang_li_effa = "La ligne à été effacée.";
$lang_continuer = "Continuer";
$lang_err_edi_bon = sprintf("Ce bon fait partie d'une facture vous ne pouvez plus l'%s.", $lang_editer);
$lang_edi_bon = $lang_editer . ' un bon de livraison.';
$lang_cont_bon = sprintf('Le bon de commande de %s comprend ', $nom);
$lang_cont_devis = sprintf('Le devis de %s comprend ', $nom);
$lang_tot_de = "pour un total de";
$lang_bon_comp = sprintf('Le bon de commande de %s comprend:', $nom);
#$lang_pou_so_to = "Pour une somme totale de <b>$total_bon  $lang_htva</b>";
#$lang_to_tva = " et un montant de T.V.A de <b>$total_tva </b> ";
$lang_edi_cont_bon = $lang_editer . " le contenu d'un bon";
$lang_modifier = "Modifier";
$lang_err_fact = "Certains bons de commande appartiennent déjà à une facture pour le client ";
$lang_err_fact_2 = "Aucun bon de commande de cette période appartient au client ";
$lang_unite = "Unité";
$lang_quantite = "Quantité";
$lang_factpdf_penalites_taux = "Taux de pénalité de retard pour l'année.";
$lang_tot_arti = "Total article";
$lang_facture_date_debut = "Date d'émission";
$lang_po_rec ="Pour \n accord:";
$lang_devis_date_debut = "Date d'émission";
$lang_devis_date_fin = "Devis valable jusqu'au";

$lang_dev_effa = "Le devis a bien été effacé";
$lang_societe = "Société";
$lang_siege_social = "Adresse";
$lang_tel_fax = "Tél / Fax";
#$lang_email = "e-mail"; doublon
$lang_factures_non_reglees_total = "Total";
$lang_prix_h_tva = "Prix H.T.";
$lang_total_h_tva = "Total H.T.";
$lang_total_ttc = "Total ttc";
$lang_taux_tva = '% ' . $lang_tva;
$lang_tot_tva = 'Total ' . $lang_tva;
$lang_date_bon = "Date du bon";
$lang_impri = "Imprimer";
$lang_total = "Total";
$lang_total_annee = $lang_total . ' de l\'année';
$lang_total_mois = $lang_total . ' du mois';
$lang_tot_ttc = sprintf('%s %s', $lang_total, $lang_ttc);
$lang_tou_fact = "Toutes les factures";
$lang_factures_non_reglees = "Factures non réglées";
$lang_factures_chercher = "Chercher des Factures";
$lang_li_tot2 = sprintf('%s%s de %s au prix de %s', $quanti, $uni, $article, $tot);
$lang_date_fact = "date fact";
$lang_date_deb = "Date de début";
$lang_date_fin = "Date de fin";
$lang_facture_date = "Date de la facture";
$lang_pay = "Réglée ?";
$lang_action = "Action";
$lang_err_efa_bon = "Ce bon fait partie d'une facture, vous ne pouvez plus le supprimer.";
$lang_art_jour = "Prix de l'article mis à jour";
$lang_montant_htva = 'Montant ' . $lang_htva;
$lang_total_htva = sprintf('%s %s', $lang_total, $lang_htva);
$lang_montant_ttc = 'Montant ' . $lang_ttc;
$lang_modi_pri ="Modifier l'article";
$lang_nv_pr_art = "Nouveau prix H.T. unitaire de";
$lang_ajou_art ="Ajouter un nouvel article";
$lang_art_no = "Nom de l'article";
$lang_uni_art = "Unité de l'article (kg, pcs, gr....)";
$lang_prix_uni = "Prix H.T. unitaire";
$lang_prix_uni_abrege = "P.U.";
$lang_ttva = '% ' . $lang_tva;
$lang_commentaire_opt ="Commentaire (optionel)";
$lang_cre_bon = "Créer un bon de commande";
$lang_10_der_bon ="Les 10 derniers bons de commande";
$lang_crer_bon = "Créer le bon";
$lang_fai_rec = "Faire une recherche";
$lang_bc_bata_pwd = "Mot de passe";
$lang_login = "Login";
$lang_bc_bata = "mot de passe mysql";
$lang_bc_host = "Host";
$lang_bc_titre = "Sauvegarde de la base de données";
$lang_devis_editer = $lang_editer . ' le devis';
$code_langue = "fr_FR";

//ajout 5.0.0
$lang_le = "le";
$lang_bon = "Bon";
$lang_prix = "Prix";
$lang_remise = "Remise";
$lang_marge = "Marge";
$lang_enregistre = "enregistré";
$lang_créée_pour = "créée pour";
$lang_suite_edit_utilisateur_err_pass = "Erreur les deux mots de passe ne correspondent pas";
$lang_suite_edit_utilisateur_succes = sprintf("Les nouvelles données de l'utilisateur %s ont bien été enregistrées", $login2);
$lang_modifier_depense = "Modifier une dépense";
$lang_del_utilisateur_succes = "Toutes les informations de l'utilisateur sont supprimées.";
$lang_actif = "actif";
$lang_inactif = "inactif";
$lang_rendre_actif = "rendre actif";
$lang_rendre_inactif = "rendre inactif";
$lang_lot_maj="Mise à jour réussie du lot";
$lang_cat_maj="Mise à jour réussie de la catégorie";
$lang_cat_effa= "Êtes-vous sûr de vouloir effacer la categorie ";
$lang_err_efa_cat = "Cette categorie comprends des articles, vous ne pouvez pas la supprimer.";
$lang_cat_eff = sprintf('La catégorie %s à été effacé.', $categorie);
$lang_echea = "Echéance à";
$lang_num_fact = $lang_numero . ' de facture';
$lang_simu = "Simulation";

$lang_art_eff = sprintf("l'article %s à été effacé.", $article);
$lang_ga = "Gagné";
$lang_perdu = "Perdu";
$lang_vers = "vers";
$lang_divers = "divers";

$lang_voir_bons_du_lot="Voir les bons contenant ce lot";
$lang_lot_cherche_lot = "Rechercher un bon par son N° de lot";
$lang_lot_cherche_four = "Rechercher à partir du lot fournisseur";
$lang_effacer_ligne_devis = "Désirer vous vraiment effacer cette ligne du devis?";
$lang_dev_editer = "Editer le devis";
$lang_env_par_mail = "Envoyer par courriel";
$lang_env_par_mail_non = "Erreur, courriel non envoyé!";
$lang_edit_fact_n = "Editer la facture N°";
$lang_ajou_fact_n = "Ajouter a la facture N°";
$lang_ajouter = "Ajouter";
$lang_enter = "entrer";
$lang_pay_le = sprintf('%s %s', $lang_pay_ok, $lang_le);
$lang_dat_inva = $lang_date . ' invalide';

$lang_les_utl = "Les utilisateurs";
$lang_id_or_mail_exist = sprintf('Erreur le login/%s existe déjà', $lang_email);
$lang_mail_exist = sprintf('Erreur le %s existe déjà', $lang_email);

$lang_admin = "admin";
$lang_gerer = "gerer";
$lang_stat = "stat";
$lang_art = "art";
$lang_point = "points";

$lang_lot_zero = "Le lot zéro est vide car inexistant.<br />Créer un lot et sélèctionné le lors d'ajout d'un article au bon de commande.";
$lang_edit_lot = "Éditer un lot";
$lang_cont_lot = "Contenu du lot";

$lang_changer_client = "changer le client";
$lang_au_cli_choi = "Aucun client sélectionné pour l'ajout!";

$lang_convertir = "convertir";
$lang_irrecouvrable = "Irrecouvrable";
$lang_reglee = "réglée";
$lang_prix_dachat = "Prix d'achat";
$lang_coef_de_marge = "Coef de marge";
$lang_pdv_mrg_ht = "Prix de vente Hors Taxe margé";
$lang_taux_marge = "Taux de marge";

$lang_notif_par_mail = "notifier par courriel";
$lang_facturer_ce_bon = "Facturer ce bon";
$lang_facture_lister = "Lister les factures";
$lang_fact_enr = "Facture enregistrée pour le client ";

$lang_restore_backup = "Restauration de la base de données en cours... Veulliez patienter ;-)";
$lang_telecharger = "Télécharger";
$lang_sauve = "Sauver";
$lang_back_t_a_s = "les tables à sauvegarder";
$lang_decompresser = "Extraire";
$lang_back_err = "Aucune table n'a été sauvegardée";#No tables have been backed-up
$lang_restore_err_dbinfo_file = "Impossible de trouver le fichier d'informations de sauvegarde, restauration interrompue";#"Cannot find backup info file, restore aborted";
$lang_restore_err_crea_sql = "Impossible de créé le fichier backup.sql";#"No sql file can be created";
$lang_restore_err_zip = "Impossible de lire le fichier compréssé (zip)";#"Cannot read zip file";
//download
$lang_aucun_sql = "Aucun fichier backup.sql présent dans le dossier dump.";#"No sql file found";
$lang_err_c_zip = "Impossible de créer le fichier compressé ";#"Cannot create zip file ";
$lang_err_f = "Erreur de Fichier.";#"File error";

$lang_total_vente = "Total des ventes";
$lang_dep_maj = "Dépense mise à jour";
$lang_dep_eff = "Dépense effacée";

$lang_premier = "premier";
$lang_deuxieme = "deuxieme";
$lang_troisieme = "troisième";
$lang_premier_rappel = "Nous avons constatés que vous aviez probablement oublié de régler les factures si dessous. \n Merci de bien vouloir y remédier au plus tôt. \n Veuillez agréer Madame Monsieur L'expression de nos sentiments respectueux.\nSi votre payement avait croisé ce rappel, veuillez le considérer comme nul et non avenu.\n";
$lang_deuxieme_rappel = "			 								Madame, Monsieur, \n 									 Malgrès notre premier rappel, vous n'avez toujours pas réglé les factures ci-dessous.\nMerci de bien vouloir créditer notre compte endéans les huits jours.\n Dans le cas contraire nous serions dans l'obligation d'appliquer nos conditions générales de vente se trouvant au dos de ce document ainsi qu'au dos de toutes nos factures.\n			Si votre payement avait croisé ce rappel, veuillez le considérer comme nul et non avenu.\n";
$lang_troisieme_rappel = "Troisième rappel";

$lang_categorie_modif = "Modifier une catégorie";

$lang_monnaie = "euro";#nb.php ds nombre_literal()
$lang_centime = "centime";#nb.php ds nombre_literal()

$lang_notifi_cli = "Courriel de notification envoyé !";
$lang_notifi_cli_non = "Envoi du Courriel de notification Echoué!";
$lang_notifi_titre_bon = "Nouveau bon de commande";
$lang_notifi_message_bon = sprintf('Un nouveau bon de commade vous est adressé par %s <br>vous pouvez le consulter en vous rendant sur le site internet avec votre login mot de passe<br>%s', $entrep_nom, $entrep_nom);
$lang_notifi_titre_fact = "Nouvelle facture";
$lang_notifi_message_fact = sprintf('Une nouvelle facture vous est adressé par %s <br>vous pouvez la consulter en vous rendant sur le site internet avec votre login mot de passe<br>%s', $entrep_nom, $entrep_nom);
$lang_notifi_titre_dev = "Nouveau devis";
$lang_notifi_message_dev = sprintf('Un nouveau devis vous est adressé par %s <br>vous pouvez le consulter en vous rendant sur le site internet avec votre login mot de passe<br>%s', $entrep_nom, $entrep_nom);

#rapel
$lang_envoyée_depuis = "envoyée depuis";
$lang_email_envoyé = "Courriel bien envoyé";
$lang_email_envoi_err = "Une erreur est survenu, impossible d'envoyer le courriel!";

#stats
$lang_toutes = "toutes";
$lang_tous = "tous";
$lang_dachat = "d'achat";
$lang_de_vente = "de vente";
$lang_au_reel = "Au réél (payé)";
$lang_graph_cir = "Graphique circulaire";
$lang_evo_dep = "Evolution des dépenses";
$lang_facturé = "facturé";
$lang_commandé = "commandé";
$lang_acquitté = "acquitté";
$lang_encaissé = "encaissé";
$lang_l_année = "l'année";
$lang_toutes_les_années = "toutes les années";

#convert
$lang_déja_commandé = "déja commandé";

#fpdf
$lang_mail_client_bon_sujet = "Bon de commande de ";
$lang_mail_client_bon_message = "un nouveau bon de commande vous a été adressé par {$entrep_nom}. \n Vous le trouverez en piece jointe de ce courriel. \n Salutations distinguées \n ";
$lang_mail_client_dev_sujet = "Devis de ";
$lang_mail_client_dev_message = "un nouveau devis vous a été adressé par {$entrep_nom}. \n Vous le trouverez en piece jointe de ce courriel. \n Salutations distinguées \n";
$lang_mail_client_fact_sujet = "Nouvelle facture de ";
$lang_mail_client_fact_message = "Une nouvelle facture vous a étée adressée par  {$entrep_nom} . \nVous la trouverez en piece jointe de courriel\n Salutations distinguées \n ";

#admin
$lang_choix_auth_cli_devis = "Permettre aux clients l'affichage des devis et leurs transformation en commandes";
$lang_choix_auth_cli_bon = "Permettre aux clients l'affichage des commandes";
$lang_choix_auth_cli_fact = "Permettre aux clients l'afichage des factures";
$lang_choix_first_art = "Choix de l'article sélèctionné par defaut";
$lang_choix_echeance_fact = "Échéance des délais de paiement des factures";
$lang_fi_innouvr = "Impossible d'ouvrir le fichier";
$lang_fi_inedita = "Impossible d'écrire dans le fichier";
$lang_fi_lect_sl = "Le fichier est inaccessible en écriture";

//installeur
$lang_install_user_create = "Cet utilisateur aura les droits d'administrateur et ne pourra être effacé par la suite.";
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);#error_reporting(E_ALL);
