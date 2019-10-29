<?php 
require_once('../../../private/initialize.php');

require_login();

$errors = [];

if(!isset($_GET['id'])) {
    $message = 'Inget evenemang valt.';
} else if (isset($_GET['id'])) {
    $message = 'Det finns inga reservationer för det angivna evenemanget.';
    $event_name = $_GET['id'];
    $reservations = find_reservations_by_event_name($event_name);
    $find_event = find_event($event_name);
} else if (isset($_GET['rid']) && isset($_GET['delete'])) {
    $rid = $_GET['rid'];
    $action = 'delete';
}

if (is_post_request()) {
    if ($_POST['action'] == 'delete') {
        $reservation_id = $_POST['rid'] ?? '';
        $result = delete_reservation($reservation_id);
        if ($result === true) {
            $error[] = 'Reservationen har tagits bort.';
        } else if ($result === false) {
            $error[] = 'Oväntant fel. Reservationen togs inte bort.';
    }
}
}

$events = get_all_events();

?>
<?php $page_title = "Evenemang | Reservationer"; ?>
<?php include( SHARED_PATH . '/staff_header.php');?>
<div class="staff-wrapper">
    <?php include( SHARED_PATH . '/staff_nav.php'); ?>
    <div class="staff-content">
        <div class="message-container">
            <?php if (!empty($errors)) { ?>
            <div class="alert alert-warning alert-dismissible <?php echo 'show fade';?>" role="alert">
                <?php foreach($errors as $error) { echo $error;}?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php } ?>
        </div>
        <div class="block-full mb-5">
            <h1 class="brand-title">Evenemang & Reservationer</h1>
        </div>
        <div class="block-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>Namn</th>
                        <th>Antal platser</th>
                        <th class="empty"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($events as $event) { ?>
                    <tr>
                        <td><?php echo h($event['event_name']);?></td>
                        <td><?php echo h($event['number_of_seats']);?></td>
                        <td class="empty"><a class="action"
                                href="<?php echo url_for('/staff/evenemang/index.php?id=' . h(u($event['event_name']))); ?>">View</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="block-full">
            <?php if (empty($reservations) && !is_blank($find_event['event_name'])) { ?> <h2 class="mt-2">
                <?php echo $message; ?></h2><?php }
            else if (!empty($reservations)) { ?>
            <h3 class="mt-2"><?php echo $find_event['event_name'];?></h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Namn</th>
                        <th>Bokade platser</th>
                        <th class="empty"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($reservations as $reservation) { ?>
                    <tr>
                        <td><?php echo h($reservation['reservation_id']);?></td>
                        <td><?php echo h($reservation['reservation_name']);?></td>
                        <td><?php echo h($reservation['number_of_reserved_seats']);?></td>
                        <td class="empty">
                            <form action="<?php echo h($_SERVER['PHP_SELF']); ?>" method="post">
                                <input type="hidden" value="<?php echo h($reservation['reservation_id']);?>" name="rid">
                                <input type="hidden" value="delete" name="action">
                                <input type="submit" value="Ta bort">
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else { ?> <h2 class="mt-2"><?php echo $message; ?></h2><?php } ?>
        </div>
    </div>
</div>