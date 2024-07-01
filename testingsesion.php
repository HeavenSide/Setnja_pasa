<?php 
session_start();
if(!isset($_SESSION['name'])):?>
                        <button id="Vi">ID</button>
                    <?php else: ?>
                        <button id="in">bid</button>
                    <?php endif; ?>