<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    *{
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }
</style>

<?php
include "class/campaign_class.php";

$campaign = new campaign;

if(!isset($_GET['campaign_id']) || $_GET['campaign_id'] == NULL || !isset($_GET['user_id']) || $_GET['user_id'] == NULL){
    echo "<script>window.location = 'login.php.php'</script>";
}
else{
    $campaign_id = $_GET['campaign_id'];
    $user_id = $_GET['user_id'];
}
    $delete_campaign = $campaign -> delete_campaign($campaign_id, $user_id);
    
?>