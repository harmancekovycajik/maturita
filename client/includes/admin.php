<?php

if ($user->is_admin == 0) {
  header("Location: ./");
  exit();
}