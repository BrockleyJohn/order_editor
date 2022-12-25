<?php
/*
  $Id: edit_orders.php v5.0 08/04/2017 djmonkey1 Exp $

  German translation by Martin Loos

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Ändere Bestellung #%s von %s');
define('ADDING_TITLE', 'Artikel zu Bestellung #%s hinzufügen');

// php7.3 avoid warning on first load
if (!defined('ORDER_EDITOR_CREDIT_CARD')) define('ORDER_EDITOR_CREDIT_CARD','Kreditkarten');

define('ENTRY_UPDATE_TO_CC', '(Wechsel zu ' . ORDER_EDITOR_CREDIT_CARD . ' um Kreditkartenfelder anzuzeigen.)');
define('TABLE_HEADING_COMMENTS', 'Kommentar');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_NEW_STATUS', 'Neuer status');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_DELETE', 'Löschen?');
define('TABLE_HEADING_QUANTITY', 'Menge');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Art.-Nr.');
define('TABLE_HEADING_PRODUCTS', 'Produkte');
define('TABLE_HEADING_TAX', 'MwSt.');
define('TABLE_HEADING_TOTAL', 'Summe');
define('TABLE_HEADING_BASE_PRICE', 'Grund-<br>preis');
define('TABLE_HEADING_UNIT_PRICE', 'Brutto-<br>preis');
define('TABLE_HEADING_UNIT_PRICE_TAXED', 'Netto-<br>preis');
define('TABLE_HEADING_TOTAL_PRICE', 'Netto-<br>summe');
define('TABLE_HEADING_TOTAL_PRICE_TAXED', 'Brutto-<br>summe');
define('TABLE_HEADING_OT_TOTALS', 'Bestellsummen:');
define('TABLE_HEADING_OT_VALUES', 'Betrag:');
define('TABLE_HEADING_SHIPPING_QUOTES', 'Versandkosten:');
define('TABLE_HEADING_NO_SHIPPING_QUOTES', 'Es fallen keine Versandkosten an!');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Kunde<br>benachrichtigt');
define('TABLE_HEADING_DATE_ADDED', 'Hinzugefügt am');

define('ENTRY_CUSTOMER', 'Kunde');
define('ENTRY_NAME', 'Name:');
define('ENTRY_CITY_STATE', 'Ort, Land:');
define('ENTRY_SHIPPING_ADDRESS', 'Versandaddresse');
define('ENTRY_BILLING_ADDRESS', 'Rechnungsaddresse');
define('ENTRY_PAYMENT_METHOD', 'Zahlungsmethode');
define('ENTRY_CREDIT_CARD_TYPE', 'Kartentyp:');
define('ENTRY_CREDIT_CARD_OWNER', 'Karteneigentümer:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Kartennummer:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Karte gültig bis:');
define('ENTRY_SUB_TOTAL', 'Zwischensumme:');
define('ENTRY_TYPE_BELOW', 'Geben Sie unten ein');

//Die Definition von ENTRY_TAX ist wichtig, wenn mit unterschiedlichen Steuerarten gearbeitet wird!
define('ENTRY_TAX', 'MwSt.');
//Es darf kein Doppelpunkt (:) in der Definition verwendet werden! z. B. 'MwSt.' ist in Ordnung, aber nicht 'MwSt.:'

define('ENTRY_SHIPPING', 'Versandkosten:');
define('ENTRY_TOTAL', 'Summe:');
define('ENTRY_STATUS', 'Status:');
define('ENTRY_NOTIFY_CUSTOMER', 'Kunde benachrichtigen:');
define('ENTRY_NOTIFY_COMMENTS', 'Kommentare mitsenden:');
define('ENTRY_CURRENCY_TYPE', 'Währung');
define('ENTRY_CURRENCY_VALUE', 'Wert');

define('TEXT_INFO_PAYMENT_METHOD', 'Zahlungsmethode:');
define('TEXT_NO_ORDER_PRODUCTS', 'Diese Bestellung enthält keine Artikel!');
define('TEXT_ADD_NEW_PRODUCT', 'Artikel hinzufügen');
define('TEXT_PACKAGE_WEIGHT_COUNT', 'Verpackungsgewicht: %s  |  Artikelanzahl: %s');

define('TEXT_STEP_1', '<b>Schritt 1:</b>');
define('TEXT_STEP_2', '<b>Schritt 2:</b>');
define('TEXT_STEP_3', '<b>Schritt 3:</b>');
define('TEXT_STEP_4', '<b>Schritt 4:</b>');
define('TEXT_SELECT_CATEGORY', '- Wählen Sie eine Kategorie aus der Liste -');
define('TEXT_PRODUCT_SEARCH', '<b>- ODER geben Sie einen Suchbegriff in das Suchfeld ein, um potentielle Treffer anzuzeigen -</b>');
define('TEXT_ALL_CATEGORIES', 'Alle Kategorien/Artikel');
define('TEXT_SELECT_PRODUCT', '- Wählen Sie einen Artikel -');
define('TEXT_BUTTON_SELECT_OPTIONS', 'Optionen auswählen');
define('TEXT_BUTTON_SELECT_CATEGORY', 'Diese Kategorie auswählen');
define('TEXT_BUTTON_SELECT_PRODUCT', 'Diesen Artikel auswählen');
define('TEXT_SKIP_NO_OPTIONS', '<em>Keine Varianten - übersprungen...</em>');
define('TEXT_QUANTITY', 'Menge:');
define('TEXT_BUTTON_ADD_PRODUCT', 'Zur Bestellung hinzufügen');
define('TEXT_CLOSE_POPUP', '<u>Schließen</u> [x]');
define('TEXT_ADD_PRODUCT_INSTRUCTIONS', 'Fügen Sie Artikel hinzu, bis Sie fertig sind.<br>Schließen Sie dann dieses Fenster/diesen TAB, kehren Sie zum Hauptfenster/-TAB zurück und klicken Sie auf "Update".');
define('TEXT_PRODUCT_NOT_FOUND', '<b>Artikel nicht gefunden<b>');
define('TEXT_SHIPPING_SAME_AS_BILLING', 'Versandadresse entspricht Rechnungsanschrift');
define('TEXT_BILLING_SAME_AS_CUSTOMER', 'Rechnungsanschrift entspricht Kundenanschrift');

define('IMAGE_ADD_NEW_OT', 'Fügen Sie nach dieser Position eine weitere ein.');
define('IMAGE_REMOVE_NEW_OT', 'Diese Position entfernen');
define('IMAGE_NEW_ORDER_EMAIL', 'Neue Bestellbestätigungs-Email senden');

define('TEXT_NO_ORDER_HISTORY', 'Keine Bestellhistorie verfügbar');

define('PLEASE_SELECT', 'Bitte wählen Sie');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Ihre Bestellung wurde aktualisiert');
define('EMAIL_TEXT_ORDER_NUMBER', 'Bestellung Nr.:');
define('EMAIL_TEXT_INVOICE_URL', 'Detailierte Rechnung:');
define('EMAIL_TEXT_DATE_ORDERED', 'Bestelldatum:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Vielen Dank für Ihre Bestellung bei uns!' . "\n\n" . 'Der Status Ihrer Bestellung wurde aktualisiert.' . "\n\n" . 'Neuer Status: %s' . "\n\n");
define('EMAIL_TEXT_STATUS_UPDATE2', 'Für Rückfragen antworten Sie bitte auf diese Email.' . "\n\n" . 'Mit freundlichen Grüßen von ' . STORE_NAME . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Hinweise zu Ihrer Bestellung:' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Fehler: Bestellung %s existiert nicht.');
define('ERROR_NO_ORDER_SELECTED', 'Sie haben keine Bestellung zur Bearbeitung ausgewählt oder die Variable "order ID" wurde nicht eingestellt!');
define('SUCCESS_ORDER_UPDATED', 'Bestellung wurde erfolgreich aktualisiert!');
define('SUCCESS_EMAIL_SENT', 'Die Bestellung wurde aktualisiert und eine neue Bestellbestätigung wurde per Email verschickt.');

//Hilfetexte
define('HINT_UPDATE_TO_CC', 'Zahlungsmethode auf ' . ORDER_EDITOR_CREDIT_CARD . ' ändern und die weiteren Eingabefelder werden automatisch angezeigt. Kreditkartenfelder werden unterdrückt, wenn eine andere Zahlungsmethode ausgewählt wird. Der Name der Zahlungsmethode, die bei Auswahl die Kreditkartenfelder anzeigt, kann im Konfigurationsbereich "Order Editor" im Administratorbereich konfiguriert werden.');
define('HINT_UPDATE_CURRENCY', 'Die Änderung der Währung bewirkt eine Neuberechnung und -anzeige der Versandkosten und Endsumme.');
define('HINT_SHIPPING_ADDRESS', 'Wenn Sie in der Versandadresse das Land oder die Postleitzahl ändern, haben Sie die Möglichkeit, die Versandkosten neu zu berechnen und anzuzeigen.');
define('HINT_TOTALS', 'Sie haben die Möglichkeit Rabatte zu gewähren, indem Sie negative Werte eintragen. Zwischensumme, Steuer und die Endsumme können nicht geändert werden. Beim Hinzufügen von kundenspezifischen Gesamtkomponenten via AJAX stellen Sie sicher, dass zuerst die Bezeichnung eingegeben wird, da das Programm die Eingabe sonst nicht erkennt und aus der Bestellung löscht.');

define('HINT_PRESS_UPDATE', 'Bitte klicken Sie auf "Update" um alle Änderungen zu speichern.');

define('HINT_BASE_PRICE', 'Grundpreis ist der Preis vor der Auswahl von Varianten (z. B. Katalogpreis des Artikels)');
define('HINT_PRICE_EXCL', 'Nettopreis ist der Grundpreis zuzüglich evtl. existierender Varianten');
define('HINT_PRICE_INCL', 'Bruttopreis ist der Nettopreis zuzüglich Steuer');
define('HINT_TOTAL_EXCL', 'Nettosumme ist der Nettopreis mal Anzahl');
define('HINT_TOTAL_INCL', 'Bruttosumme ist die Nettosumme zuzüglich Steuer mal Anzahl');
//Ende der Hilfetexte

//Bestätigungs-Email für neue Bestellbestätigungs-Email - Diese Email ist unabhängig von der Nachricht über den Status der Bestellung!
define('ENTRY_SEND_NEW_ORDER_CONFIRMATION', 'Neue Bestellbestägigung:');
define('EMAIL_TEXT_DATE_MODIFIED', 'Datum letzte Änderung:');
define('EMAIL_TEXT_PRODUCTS', 'Artikel');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Versandadresse');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Rechnungsanschrift');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Zahlungsmethode');

// Für weitere Zahlungsinformationen geben Sie bitte in der folgenden Variable Ihren Text ein. Benutzen Sie <br> für Zeilenumbrüche:
//define('EMAIL_TEXT_PAYMENT_INFO', ''); //Wozu wird das benötigt?
// Wenn Sie einen Footer-Text anhängen möchten, geben Sie ihn bitte hier ein. Benutzen Sie <br> für Zeilenumbrüche:
define('EMAIL_TEXT_FOOTER', '');
//end email

//add-on für downloads
define('ENTRY_DOWNLOAD_COUNT', 'Download #');
define('ENTRY_DOWNLOAD_FILENAME', 'Dateiname');
define('ENTRY_DOWNLOAD_MAXDAYS', 'Tage bis zum Ablauf');
define('ENTRY_DOWNLOAD_MAXCOUNT', 'Downloads übrig');

//add-on für Ajax
define('AJAX_CONFIRM_PRODUCT_DELETE', 'Sind Sie sicher, dass Sie den Artikel aus der Bestellung entfernen möchten?');
define('AJAX_CONFIRM_COMMENT_DELETE', 'Sind Sie sicher, dass Sie diesen Kommentar aus dem Bestellverlauf entfernen möchten?');
define('AJAX_MESSAGE_STACK_SUCCESS', 'Erfolg!! \' + %s + \' wurde aktualisiert');
define('AJAX_CONFIRM_RELOAD_TOTALS', 'Sie haben die Versandinformationen geändert. Möchten Sie die Versandkosten und den Gesamtbetrag neu berechnen?');
define('AJAX_CANNOT_CREATE_XMLHTTP', 'Kann XMLHTTP Instanz nicht erstellen');
define('AJAX_SUBMIT_COMMENT', 'Statusänderung oder Kommentar speichern und/oder an den Kunden senden');
define('AJAX_NO_QUOTES', 'Keine Versandkosten zum anzeigen vorhanden.');
define('AJAX_SELECTED_NO_SHIPPING', 'Sie haben eine Versandmethode für diese Bestellung ausgewählt, die noch nicht in der Datenbank vorhanden ist. Möchten Sie diese Versandmethode trotzdem zur Bestellung hinzufügen?');
define('AJAX_RELOAD_TOTALS', 'Die neue Versandmethode wurde zur Datenbank hinzugefügt, aber die Summen wurden noch nicht neu berechnet. Klicken Sie auf OK, um die Summen neu zu berechnen. Wenn Ihre Internetverbindung langsam ist, waren Sie bitte bis die Seite vollständig neu geladen wurde, bevor Sie OK anklicken!');
define('AJAX_NEW_ORDER_EMAIL', 'Sind Sie sicher, dass Sie eine neue Bestätigungs-Email zu dieser Bestellung versenden möchten?');
define('AJAX_INPUT_NEW_EMAIL_COMMENTS', 'Bitte tragen Sie hier alle Ihre Anmerkungen ein. Wenn Sie keine Anmerkungen eintragen möchten, können Sie das Eingabefeld leer lassen. Bitte bedenken Sie, dass Ihre Anmerkungen durch drücken der ENTER-Taste so übertragen werden, wie sie angezeigt werden. Es ist nicht möglich, Zeilenumbrüche zu erfassen!');
define('AJAX_SUCCESS_EMAIL_SENT', 'Erfolg! Eine neue Bestellbestätigung wurde an %s verschickt');
define('AJAX_WORKING', 'arbeite, bitte warten....');

if (!defined('ICON_SUCCESS')) define('ICON_SUCCESS', 'Erfolg');
if (!defined('ICON_TICK')) define('ICON_TICK', 'OK');
if (!defined('ENTRY_TELEPHONE')) define('ENTRY_TELEPHONE', 'Telefon');
