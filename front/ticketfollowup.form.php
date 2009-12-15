<?php
/*
 * @version $Id: ticket.form.php 9633 2009-12-11 19:12:34Z yllen $
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2009 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 --------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file:
// Purpose of file:
// ----------------------------------------------------------------------


define('GLPI_ROOT', '..');
include (GLPI_ROOT . "/inc/includes.php");

checkCentralAccess();

$fup = new TicketFollowup();
$track = new Ticket();

if (!isset($_POST['id'])) {
   exit();
}

$fup = new TicketFollowup();

if (isset($_POST["update"])) {
   $fup->check($_POST['id'], 'w');
   $fup->update($_POST);

   Event::log($fup->getField('tickets_id'), "tracking", 4, "tracking",
              $_SESSION["glpiname"]."  ".$LANG['log'][21]." ".$_POST["id"].".");
   glpi_header(getItemTypeFormURL('Ticket')."?id=".$fup->getField('tickets_id'));

} else if (isset($_POST["delete"])) {
   $fup->check($_POST['id'], 'w');
   $fup->delete($_POST);

   Event::log($fup->getField('tickets_id'), "tracking", 4, "tracking",
              $_SESSION["glpiname"]." ".$LANG['log'][22]." ".$_POST["id"].".");
   glpi_header(getItemTypeFormURL('Ticket')."?id=".$fup->getField('tickets_id'));
}

displayErrorAndDie('Lost');

?>
