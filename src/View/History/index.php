<div class="container w-50">
    <ul class="list-group">
    <?php foreach ($history as $row): ?>
        <li class="list-group-item"><?= $row->title; ?></li>
    <?php endforeach;?>
    </ul>
</div>