<?php
include "navigation.php";
?>

<div style="display: flex; justify-content: center; margin-top: 20px; padding: 80px 0 50px 0;">
    <div class="input-group" style="width: auto; display: flex;">
        <form class="d-flex" method="get" action="search_results.php" style="display: flex; align-items: center;">
            <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search" id="form1" style="flex-grow: 5; min-width: 300px; max-width: 800px; border: 2px solid gray; border-radius: 5px 0 0 5px; padding: 10px;">
            <button type="submit" class="btn btn-success" style="border-radius: 0 5px 5px 0; padding: 10px;">
                <i class="fas fa-search"></i> 
            </button>
        </form>
    </div>
</div>

<?php
include "cards.php";
?>

<!-- promotion and footer -->
<?php
include "promotion.php";
include "footer.php";
?>