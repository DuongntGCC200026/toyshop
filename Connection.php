<?php
   $db = pg_connect("postgres://surqxdzqgpwivg:f5aea379bc16d2eea0b9cb73219b072a1e3f2df8dbdeff3c470fc4c7cac69577@ec2-3-208-79-113.compute-1.amazonaws.com:5432/d32ii5i5jnevim
   ");
   if(!$db) {
      echo "Error : Unable to open database\n";
   } else {
      echo "Opened database successfully\n";
   }